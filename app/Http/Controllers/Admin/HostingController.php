<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HostingPackage;
use Illuminate\Http\Request;
use App\Models\HostingPackagePrice;

class HostingController extends Controller
{
    public function index()
    {
        $hostings = HostingPackage::with('prices')->latest()->get();
        return view('admin.hosting.index', compact('hostings'));
    }

    public function create()
    {
        return view('admin.hosting.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'disk_space' => 'required|string',
            'bandwidth' => 'required|string',
            'email_accounts' => 'required|integer|min:0',
            'databases' => 'required|string|max:100',
            'has_ssl' => 'sometimes',
            'has_backup' => 'sometimes',
            'has_wordpress' => 'sometimes',
            'feature_1' => 'nullable|string',
            'feature_2' => 'nullable|string',
            'feature_3' => 'nullable|string',
            'feature_4' => 'nullable|string',
            'feature_5' => 'nullable|string',
            'durations' => 'required|array|min:1',
            'durations.*.duration_months' => 'required|integer|min:1',
            'durations.*.original_price' => 'required|numeric|min:0',
            'durations.*.discounted_price' => 'nullable|numeric|min:0',
        ]);

        $validated['has_ssl'] = $request->has('has_ssl');
        $validated['has_backup'] = $request->has('has_backup');
        $validated['has_wordpress'] = $request->has('has_wordpress');

        $durations = collect($request->durations)->sortBy('duration_months');
        $shortest = $durations->first();
        $yearly = $durations->firstWhere('duration_months', 12);

        $validated['price_monthly'] = $shortest['discounted_price'] ?? $shortest['original_price'];
        $validated['price_yearly'] = $yearly
            ? ($yearly['discounted_price'] ?? $yearly['original_price'])
            : $validated['price_monthly'];

        $hosting = HostingPackage::create($validated);

        foreach ($durations as $priceData) {
            $hosting->prices()->create([
                'duration_months' => $priceData['duration_months'],
                'original_price' => $priceData['original_price'],
                'discounted_price' => $priceData['discounted_price'] ?? null,
            ]);
        }

        return redirect()->route('admin.hosting.index')->with('success', 'Paket hosting berhasil ditambahkan.');
    }

    public function update(Request $request, HostingPackage $hosting)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'disk_space' => 'required|string',
            'bandwidth' => 'required|string',
            'email_accounts' => 'required|integer|min:0',
            'databases' => 'required|string|max:100',
            'has_ssl' => 'sometimes',
            'has_backup' => 'sometimes',
            'has_wordpress' => 'sometimes',
            'feature_1' => 'nullable|string',
            'feature_2' => 'nullable|string',
            'feature_3' => 'nullable|string',
            'feature_4' => 'nullable|string',
            'feature_5' => 'nullable|string',
            'durations' => 'required|array|min:1',
            'durations.*.duration_months' => 'required|integer|min:1',
            'durations.*.original_price' => 'required|numeric|min:0',
            'durations.*.discounted_price' => 'nullable|numeric|min:0',
        ]);

        $validated['has_ssl'] = $request->has('has_ssl');
        $validated['has_backup'] = $request->has('has_backup');
        $validated['has_wordpress'] = $request->has('has_wordpress');

        $durations = collect($request->durations)->sortBy('duration_months');
        $shortest = $durations->first();
        $yearly = $durations->firstWhere('duration_months', 12);

        $validated['price_monthly'] = $shortest['discounted_price'] ?? $shortest['original_price'];
        $validated['price_yearly'] = $yearly
            ? ($yearly['discounted_price'] ?? $yearly['original_price'])
            : $validated['price_monthly'];

        $hosting->update($validated);

        $hosting->prices()->delete();
        foreach ($durations as $priceData) {
            $hosting->prices()->create([
                'duration_months' => $priceData['duration_months'],
                'original_price' => $priceData['original_price'],
                'discounted_price' => $priceData['discounted_price'] ?? null,
            ]);
        }

        return redirect()->route('admin.hosting.index')->with('success', 'Paket hosting berhasil diperbarui.');
    }

    public function show(HostingPackage $hosting)
    {
        $hosting->load('prices');
        return view('admin.hosting.show', compact('hosting'));
    }

    public function edit(HostingPackage $hosting)
    {
        $hosting->load('prices');
        $hosting->durations = $hosting->prices->map(function ($price) {
            return [
                'duration_months' => $price->duration_months,
                'original_price' => $price->original_price,
                'discounted_price' => $price->discounted_price,
            ];
        })->toArray();

        return view('admin.hosting.edit', compact('hosting'));
    }

    public function destroy(HostingPackage $hosting)
    {
        $hosting->delete();
        return redirect()->route('admin.hosting.index')->with('success', 'Paket hosting berhasil dihapus.');
    }
}
