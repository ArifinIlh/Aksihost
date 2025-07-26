<?php

namespace App\Http\Controllers;
use App\Models\Payment;

use Illuminate\Http\Request;

class BillingController extends Controller
{



public function dashboard()
{
    $pendingPayments = Payment::where('status', 'pending')->count();
    $verifiedPayments = Payment::where('status', 'verified')->count();

    return view('billing.dashboard', compact('pendingPayments', 'verifiedPayments'));
}

    public function invoices()
    {
        return view('billing.invoices'); 
    }

    public function payments()
    {
        return view('billing.payments'); 
    }
}
