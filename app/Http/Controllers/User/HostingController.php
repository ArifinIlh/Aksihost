<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HostingPackage;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use Illuminate\Support\Str;

class HostingController extends Controller
{
    public function index()
    {
        $hostings = HostingPackage::latest()->get();
        return view('user.hosting.index', compact('hostings'));
    }

    public function addToCart(Request $request, $id)
    {
        $request->validate([
            'duration' => 'required|integer|min:1',
        ]);

        $hosting = HostingPackage::findOrFail($id);

        $cart = Session::get('hosting_cart', []);

        // Key berdasarkan ID + durasi
        $key = $id . '-' . $request->duration;

        $cart[$key] = [
            'hosting_id' => $hosting->id,
            'name' => $hosting->name,
            'duration' => $request->duration,
            'price' => $hosting->promo_price ?? $hosting->price_monthly,
        ];

        Session::put('hosting_cart', $cart);

        return redirect()->route('user.hosting.cart')->with('success', 'Paket hosting ditambahkan ke keranjang!');
    }
public function cart()
{
    $cart = Session::get('hosting_cart', []);
    $domainCart = Session::get('domain_cart', []);
    $extensions = \App\Models\DomainPrice::all(); // pastikan model ini di-import jika belum

    return view('user.hosting.cart', compact('cart', 'domainCart', 'extensions'));
}


    public function removeFromCart(Request $request)
    {
        $cart = Session::get('hosting_cart', []);
        unset($cart[$request->key]);
        Session::put('hosting_cart', $cart);

        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('hosting_cart', []);

        if (empty($cart)) {
            return redirect()->route('user.hosting.cart')->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();
        try {
            $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['duration']);

            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'unpaid',
                'total' => $total,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_type' => 'hosting',
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'status' => 'unpaid',
                    'meta' => json_encode([
                        'duration' => $item['duration'],
                        'hosting_id' => $item['hosting_id'],
                    ]),
                ]);
            }

            Session::forget('hosting_cart');
            DB::commit();

            return redirect()->route('user.hosting.payment', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    public function payment($id)
    {
        $order = Order::with('items')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.hosting.payment-method', compact('order'));
    }


    public function processPayment(Request $request, $id)
{
    $request->validate([
        'payment_method' => 'required|string'
    ]);

    $order = Order::with('items')->where('user_id', auth()->id())->findOrFail($id);

    DB::beginTransaction();
    try {
        // 1. Simpan ke tabel payments
        Payment::create([
            'user_id' => auth()->id(),
            'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
            'method' => $request->payment_method,
            'total' => $order->total,
            'status' => 'pending', // Tunggu admin verifikasi
        ]);

        // 2. Update order
        $order->update([
            'status' => 'paid', // atau 'waiting_verification' jika mau validasi manual
            'payment_method' => $request->payment_method,
        ]);

        // 3. Update order items
        foreach ($order->items as $item) {
            $item->update(['status' => 'active']);
        }

        DB::commit();
        return redirect()->route('user.orders.invoice', $order->id)
            ->with('success', 'Pembayaran berhasil. Menunggu verifikasi admin.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Pembayaran gagal: ' . $e->getMessage());
    }
}

}
