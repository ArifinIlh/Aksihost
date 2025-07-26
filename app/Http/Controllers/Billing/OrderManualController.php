<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;

class OrderManualController extends Controller
{
    public function index()
    {
        return view('billing.orders.manual');
    }
}
