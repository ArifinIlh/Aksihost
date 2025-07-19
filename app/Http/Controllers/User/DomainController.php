<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DomainPrice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\HostingPackage;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    public function index()
    {
        $extensions = DomainPrice::all();
        return view('user.domain.index', compact('extensions'));
    }

    public function check(Request $request)
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

        $extensions = DomainPrice::all();

        return view('user.domain.index', [
            'extensions' => $extensions,
            'result' => [
                'full' => $fullDomain,
                'available' => !$isTaken,
                'price' => $extension->price,
                'extension_id' => $extension->id,
            ]
        ]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'domain' => 'required|string',
            'extension_id' => 'required|exists:domain_prices,id',
            'price' => 'required|numeric',
        ]);

        $cart = session()->get('domain_cart', []);

        if (!isset($cart[$request->domain])) {
            $cart[$request->domain] = [
                'domain' => $request->domain,
                'name' => $request->domain,
                'extension_id' => $request->extension_id,
                'price' => $request->price,
            ];
            session()->put('domain_cart', $cart);
        }

        return redirect()->route('user.domain.cart')->with('success', 'Domain ditambahkan ke keranjang.');
    }

    public function cart()
    {
        $domainCart = session()->get('domain_cart', []);
        $hostingCart = session()->get('hosting_cart', []);
        $hostingPackages = HostingPackage::with('prices')->get();

        return view('user.domain.cart', compact('domainCart', 'hostingCart', 'hostingPackages'));
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('domain_cart', []);
        unset($cart[$request->domain]);
        session()->put('domain_cart', $cart);

        return redirect()->route('user.domain.cart')->with('success', 'Domain dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $domainCart = session()->get('domain_cart', []);
        $hostingCart = session()->get('hosting_cart', []);

        if (empty($domainCart) && empty($hostingCart)) {
            return redirect()->route('user.domain.cart')->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();
        try {
            $domainTotal = collect($domainCart)->sum('price');
            $hostingTotal = collect($hostingCart)->sum(fn($item) => $item['price'] * $item['duration']);
            $total = $domainTotal + $hostingTotal;

            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'unpaid',
                'total' => $total,
            ]);

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

            foreach ($hostingCart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_type' => 'hosting',
                    'product_name' => $item['name'],
                    'price' => $item['price'] * $item['duration'],
                    'status' => 'unpaid',
                    'meta' => json_encode([
                        'duration' => $item['duration'],
                    ]),
                ]);
            }

            session()->forget(['domain_cart', 'hosting_cart']);
            DB::commit();

            return redirect()->route('user.domain.payment', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal checkout: ' . $e->getMessage());
        }
    }

    public function payment($id)
    {
        $order = Order::with('items')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.domain.payment-method', compact('order'));
    }

    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string'
        ]);

        $order = Order::with('items')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        DB::beginTransaction();
        try {
            $order->update([
                'status' => 'paid',
                'payment_method' => $request->payment_method,
            ]);

            foreach ($order->items as $item) {
                $item->update(['status' => 'active']);
            }

            DB::commit();
            return redirect()->route('user.domain.invoice', $order->id)
                ->with('success', 'Pembayaran berhasil.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Pembayaran gagal: ' . $e->getMessage());
        }
    }

    public function invoice($id)
    {
        $order = Order::with('items')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.orders.invoice', compact('order'));
    }
    public function addHosting(Request $request)
{
    $request->validate([
        'hosting_id' => 'required|exists:hosting_packages,id',
        'duration' => 'required|integer|min:1'
    ]);

    $package = HostingPackage::with('prices')->findOrFail($request->hosting_id);

    // Cari harga berdasarkan durasi yang admin udah buat
    $priceModel = $package->prices->firstWhere('duration_months', $request->duration);

    if (!$priceModel) {
        return back()->with('error', 'Durasi tidak tersedia untuk paket ini.');
    }

    $price = $priceModel->discounted_price ?? $priceModel->original_price;

    $hostingCart = session()->get('hosting_cart', []);

    $hostingCart[] = [
        'name' => $package->name,
        'price' => $price,
        'duration' => $request->duration,
        'package_id' => $package->id,
    ];

    session()->put('hosting_cart', $hostingCart);

    return back()->with('success', 'Paket hosting berhasil ditambahkan ke keranjang.');
}

}
