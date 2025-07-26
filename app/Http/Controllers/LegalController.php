<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function kebijakan() {
        return view('pages.kebijakan');
    }

    public function sla() {
        return view('pages.sla');
    }

    public function tos() {
        return view('pages.tos');
    }

    public function refund() {
        return view('pages.refund');
    }

    public function migrasi() {
        return view('pages.migrasi');
    }
}

