<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TechnicalSupport;

class SupportController extends Controller
{
    // Tampilkan semua tiket billing
    public function index()
    {
        $tickets = TechnicalSupport::where('category', 'billing')->latest()->get();
        return view('billing.support.index', compact('tickets'));
    }

    // Tampilkan detail tiket
    public function show($id)
    {
        $ticket = TechnicalSupport::findOrFail($id);
        return view('billing.support.show', compact('ticket'));
    }

    // Ubah status tiket
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,selesai,ditolak',
            'response_note' => 'nullable|string|max:1000',
        ]);

        $ticket = TechnicalSupport::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->response_note = $request->response_note;
        $ticket->save();

        return redirect()->route('billing.support.show', $ticket->id)
                         ->with('success', 'Status tiket diperbarui.');
    }
}
