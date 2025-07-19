<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class BillingController extends Controller
{
    public function index()
    {
        $payments = Payment::where('user_id', Auth::id())
                            ->latest()
                            ->get();

        return view('user.billing.index', compact('payments'));
    }
}
