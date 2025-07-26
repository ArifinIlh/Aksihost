<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechnicalSupport;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $supports = TechnicalSupport::latest()->get(); // bisa difilter by category or status
        return view('admin.support.index', compact('supports'));
    }

    public function show($id)
    {
        $support = TechnicalSupport::findOrFail($id);
        return view('admin.support.show', compact('support'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string',
            'status' => 'required|in:in_progress,resolved',
        ]);

        $support = TechnicalSupport::findOrFail($id);
        $support->response = $request->response;
        $support->status = $request->status;
        $support->save();

        // Bisa juga kirim notifikasi ke user
        return redirect()->route('admin.support.show', $id)->with('success', 'Respon berhasil dikirim.');
    }

public function markAsCompleted($id)
{
    $support = TechnicalSupport::findOrFail($id);
    $support->status = 'selesai';
    $support->save();

    return back()->with('success', 'Permintaan ditandai sebagai selesai.');
}

public function reject($id)
{
    $support = TechnicalSupport::findOrFail($id);
    $support->status = 'ditolak';
    $support->save();

    return back()->with('warning', 'Permintaan ditolak.');
}

public function destroy($id)
{
    $support = TechnicalSupport::findOrFail($id);
    $support->delete();

    return back()->with('danger', 'Permintaan dihapus.');
}

}
