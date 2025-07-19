<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    public function invoice(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this invoice.');
        }
        $order->load('items', 'user'); 
        return view('user.orders.invoice', compact('order'));
    }
    public function downloadInvoice(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $pdf = Pdf::loadView('user.orders.invoice-pdf', compact('order'));
        return $pdf->download('Invoice-Order-' . $order->id . '.pdf');
    }
}
