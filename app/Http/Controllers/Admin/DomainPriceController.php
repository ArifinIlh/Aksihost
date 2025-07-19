<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DomainPrice;

class DomainPriceController extends Controller
{
    /**
     * Tampilkan daftar harga domain dengan fitur pencarian
     */
    public function index(Request $request)
    {
        $query = DomainPrice::query();

        if ($request->filled('search')) {
            $search = strtolower(trim($request->search));
            $query->where('extension', 'like', '%' . $search . '%');
        }

        $prices = $query->latest()->paginate(10);

        return view('admin.domain_prices.index', compact('prices'));
    }

    /**
     * Tampilkan form tambah ekstensi domain
     */
    public function create()
    {
        return view('admin.domain_prices.create');
    }

    /**
     * Simpan data ekstensi domain yang baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'extension' => 'required|string|unique:domain_prices,extension',
            'price' => 'required|numeric|min:0',
        ]);

        // Normalisasi ekstensi (huruf kecil dan hapus spasi)
        $validated['extension'] = strtolower(trim($validated['extension']));

        DomainPrice::create($validated);

        return redirect()->route('admin.domain-prices.index')
            ->with('success', 'Ekstensi domain berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit data ekstensi domain
     */
    public function edit(DomainPrice $domainPrice)
    {
        return view('admin.domain_prices.edit', compact('domainPrice'));
    }

    /**
     * Perbarui data ekstensi domain
     */
    public function update(Request $request, DomainPrice $domainPrice)
    {
        $validated = $request->validate([
            'extension' => 'required|string|unique:domain_prices,extension,' . $domainPrice->id,
            'price' => 'required|numeric|min:0',
        ]);

        // Normalisasi ekstensi
        $validated['extension'] = strtolower(trim($validated['extension']));

        $domainPrice->update($validated);

        return redirect()->route('admin.domain_prices.index')
            ->with('success', 'Ekstensi domain berhasil diperbarui.');
    }

    /**
     * Hapus data ekstensi domain
     */
    public function destroy(DomainPrice $domainPrice)
    {
        $domainPrice->delete();

        return redirect()->route('admin.domain_prices.index')
            ->with('success', 'Ekstensi domain berhasil dihapus.');
    }
}
