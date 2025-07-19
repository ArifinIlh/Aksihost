<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DomainPrice;
use App\Models\HostingPackage;
use App\Models\Domain;
use App\Models\Hosting;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function createOrder()
    {
        $users = User::all();
        $extensions = DomainPrice::all();
        $hostings = HostingPackage::all();

        return view('admin.orders.create', compact('users', 'extensions', 'hostings'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'domain_name' => 'required|string',
            'extension_id' => 'required|exists:domain_prices,id',
            'hosting_id' => 'nullable|exists:hosting_packages,id',
        ]);

        $extension = DomainPrice::findOrFail($request->extension_id);
        $fullDomain = strtolower($request->domain_name) . $extension->extension;

        // 🔍 Cek apakah domain sudah terdaftar
        $isTaken = Domain::whereRaw("LOWER(name) = ?", [$fullDomain])->exists();

        if ($isTaken) {
            return back()->withInput()->with('error', 'Domain sudah terdaftar. Silakan pilih nama lain.');
        }

        // Simpan domain
        $domain = Domain::create([
            'user_id' => $request->user_id,
            'name' => $fullDomain,
            'status' => 'active',
            'price' => $extension->price,
            'is_paid' => true,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil disimpan.');
    }

    public function checkDomain(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'domain_name' => 'required|string',
            'extension_id' => 'required|exists:domain_prices,id',
        ]);

        $extension = DomainPrice::findOrFail($request->extension_id);
        $domainFull = strtolower($request->domain_name) . $extension->extension;

        $exists = Domain::whereRaw("LOWER(name) = ?", [$domainFull])->exists();

        return view('admin.orders.create', [
            'users' => User::all(),
            'extensions' => DomainPrice::all(),
            'hostings' => HostingPackage::all(),
            'result' => [
                'full' => $domainFull,
                'available' => !$exists,
            ],
            'old' => [
                'user_id' => $request->user_id,
                'domain_name' => $request->domain_name,
                'extension_id' => $request->extension_id,
            ]
        ]);
    }
}
