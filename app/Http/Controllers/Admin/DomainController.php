<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\DomainPrice;
use App\Models\OrderItem;
use Illuminate\Http\Request;



class DomainController extends Controller
{
public function index(Request $request)
{
    $query = OrderItem::where('product_type', 'domain')
        ->whereHas('order', fn($q) => $q->whereNotNull('user_id'))
        ->with(['order.user']);

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('product_name', 'like', "%$search%")
              ->orWhereHas('order.user', function ($q2) use ($search) {
                  $q2->where('name', 'like', "%$search%");
              });
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $domains = $query->latest()->paginate(10)->withQueryString();

    return view('admin.domain.index', compact('domains'));
}




// Tampilkan form perpanjangan
public function showRenewForm($id)
{
    $domain = OrderItem::findOrFail($id);
    return view('admin.domain.renew', compact('domain'));
}

// Proses perpanjangan domain
public function processRenewal(Request $request, $id)
{
    $request->validate([
        'duration' => 'required|integer|min:1|max:5',
    ]);

    $domain = OrderItem::findOrFail($id);

    $domain->expired_at = $domain->expired_at
        ? $domain->expired_at->addYears($request->duration)
        : now()->addYears($request->duration);

    $domain->save();

   return redirect()->route('admin.domain.index')->with('success', 'Domain berhasil diperpanjang.');

}
public function invoice($id)
{
    $domain = OrderItem::with('order.user')->findOrFail($id);

    return view('admin.domain.invoice', compact('domain'));
}


}
