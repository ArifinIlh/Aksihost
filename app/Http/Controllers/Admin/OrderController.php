<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; // atau model terkait yang kamu gunakan
use App\Models\Extension;
use App\Models\User;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'domain_name' => 'required|string',
            'extension_id' => 'required|exists:extensions,id',
        ]);

        // Simpan ke database
        $order = Order::create([
            'user_id' => $validated['user_id'],
            'domain' => $validated['domain_name'],
            'extension_id' => $validated['extension_id'],
            // tambah field lain jika ada
        ]);

        return redirect()->route('admin.orders.index') // arahkan ke daftar pesanan
            ->with('success', 'Pembelian domain berhasil disimpan.');
    }
}

