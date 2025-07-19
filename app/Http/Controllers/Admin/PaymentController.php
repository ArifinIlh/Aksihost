<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user')->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function verify(Payment $payment)
    {
        $payment->update([
            'status' => 'verified',
            'verified_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Pembayaran telah diverifikasi.');
    }

    public function reject(Payment $payment)
    {
        $payment->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Pembayaran telah ditolak.');
    }

    public function refund(Payment $payment)
    {
        $payment->update([
            'status' => 'refunded',
            'refunded_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Pembayaran telah direfund.');
    }

    public function show($id)
{
    $payment = \App\Models\Payment::with('user')->findOrFail($id);
    return view('admin.payments.show', compact('payment'));
}
public function invoice($id)
{
    $payment = \App\Models\Payment::with('user')->findOrFail($id);

    // Kamu bisa sesuaikan dengan tampilan invoice
    return view('admin.payments.invoice', compact('payment'));
}

}
