<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DomainExtension;
use App\Models\DomainPrice;

class DomainCheckController extends Controller
{
public function check(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'extension_id' => 'required|exists:domain_extensions,id',
    ]);

    $extension = DomainExtension::find($request->extension_id);
    $domain = strtolower($request->name) . $extension->extension;

    // Simulasi: domain tersedia kalau mengandung 'test'
    $available = !str_contains($request->name, 'taken');

    $results = [[
        'domain' => $domain,
        'available' => $available,
        'price' => $extension->price,
    ]];

    // Kembali ke halaman welcome.blade.php
    return view('welcome', [
        'extensions' => DomainExtension::all(),
        'results' => $results,
        'searchedName' => $request->name,
    ]);
}

}
