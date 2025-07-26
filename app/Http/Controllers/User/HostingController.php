<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{HostingPackage, HostingPackagePrice, Order, OrderItem, Payment, DomainPrice};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Session};
use Illuminate\Support\Str;

class HostingController extends Controller
{
    public function index()
    {
        $hostings = HostingPackage::with('prices')->latest()->get();

        // Format durasi dari harga menjadi array yang bisa dipilih user
        foreach ($hostings as $item) {
            $item->durations = $item->prices->map(function ($price) {
                return [
                    'duration_days' => $price->duration_days,
                    'original_price' => $price->original_price,
                    'discounted_price' => $price->discounted_price,
                ];
            });
        }

        return view('user.hosting.index', compact('hostings'));
    }

    public function addToCart(Request $request, $id)
    {
        $request->validate([
            'duration' => 'required|integer|min:1', // durasi dalam hari
        ]);

        $hosting = HostingPackage::with('prices')->findOrFail($id);
        $cart = Session::get('hosting_cart', []);
        $key = $id . '-' . $request->duration;

        $priceModel = $hosting->prices->firstWhere('duration_days', $request->duration);

        if (!$priceModel) {
            return back()->with('error', 'Durasi tidak tersedia untuk paket ini.');
        }

        $price = $priceModel->discounted_price ?? $priceModel->original_price;

        $cart[$key] = [
            'hosting_id' => $hosting->id,
            'name' => $hosting->name,
            'duration' => $request->duration, // in days
            'price' => $price,
        ];

        Session::put('hosting_cart', $cart);

        return redirect()->route('user.hosting.cart')->with('success', 'Paket berhasil ditambahkan ke keranjang.');
    }

    public function removeFromCart(Request $request)
    {
        $cart = Session::get('hosting_cart', []);
        unset($cart[$request->key]);
        Session::put('hosting_cart', $cart);
        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    public function cart()
    {
        $extensions = DomainPrice::all();
        $hostingCart = session('hosting_cart', []);
        $domainCart = session('domain_cart', []);
        return view('user.hosting.cart', compact('extensions', 'hostingCart', 'domainCart'));
    }

    public function checkout(Request $request)
    {
        $hostingCart = Session::get('hosting_cart', []);
        $domainCart = Session::get('domain_cart', []);

        if (empty($hostingCart) && empty($domainCart)) {
            return redirect()->route('user.hosting.cart')->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();
        try {
            $total = 0;

            foreach ($hostingCart as $item) {
                $total += $item['price'];
            }

            foreach ($domainCart as $item) {
                $total += $item['price'];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'unpaid',
                'total' => $total,
            ]);

            foreach ($hostingCart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_type' => 'hosting',
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'status' => 'unpaid',
                    'meta' => json_encode([
                        'duration_days' => $item['duration'],
                        'hosting_id' => $item['hosting_id'],
                    ]),
                ]);
            }

            foreach ($domainCart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_type' => 'domain',
                    'product_name' => $item['domain'],
                    'price' => $item['price'],
                    'status' => 'unpaid',
                    'meta' => json_encode([
                        'extension_id' => $item['extension_id'],
                    ]),
                ]);
            }

            Session::forget('hosting_cart');
            Session::forget('domain_cart');

            DB::commit();
            return redirect()->route('user.hosting.payment', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    public function payment($id)
    {
        $order = Order::with('items')->where('user_id', auth()->id())->findOrFail($id);
        return view('user.hosting.payment-method', compact('order'));
    }

    public function processPayment(Request $request, $id)
    {
        $request->validate(['payment_method' => 'required|string']);
        $order = Order::with('items')->where('user_id', auth()->id())->findOrFail($id);

        DB::beginTransaction();
        try {
            Payment::create([
                'user_id' => auth()->id(),
                'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                'method' => $request->payment_method,
                'total' => $order->total,
                'status' => 'pending',
            ]);

            $order->update([
                'status' => 'paid',
                'payment_method' => $request->payment_method,
            ]);

            foreach ($order->items as $item) {
                $item->update(['status' => 'active']);
            }

            DB::commit();
            return redirect()->route('user.orders.invoice', $order->id)->with('success', 'Pembayaran berhasil. Menunggu verifikasi admin.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Pembayaran gagal: ' . $e->getMessage());
        }
    }

    public function checkDomainInCart(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'extension_id' => 'required|exists:domain_prices,id',
        ]);

        $extension = DomainPrice::findOrFail($request->extension_id);
        $fullDomain = strtolower($request->name) . $extension->extension;

        $isTaken = OrderItem::where('product_type', 'domain')
            ->where('product_name', $fullDomain)
            ->exists();

        $result = [
            'full' => $fullDomain,
            'available' => !$isTaken,
            'price' => $extension->price,
            'extension_id' => $extension->id,
        ];

        if (!$isTaken) {
            $domainCart = Session::get('domain_cart', []);
            $domainCart[$fullDomain] = [
                'domain' => $fullDomain,
                'price' => $extension->price,
                'extension_id' => $extension->id,
            ];
            Session::put('domain_cart', $domainCart);
        }

        $hostingCart = session('hosting_cart', []);
        $domainCart = session('domain_cart', []);
        $extensions = DomainPrice::all();

        return view('user.hosting.cart', compact('hostingCart', 'domainCart', 'extensions', 'result'));
    }
}
