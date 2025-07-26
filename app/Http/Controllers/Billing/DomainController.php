<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domain;

class DomainController extends Controller
{
    public function index(Request $request)
    {
        $query = Domain::with(['order.user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('product_name', 'like', "%$search%")
                  ->orWhereHas('order.user', function ($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $domains = $query->latest()->paginate(10);

        return view('billing.domains.index', compact('domains'));
    }
}
