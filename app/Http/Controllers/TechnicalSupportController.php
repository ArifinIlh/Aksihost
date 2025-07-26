<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TechnicalSupport;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SupportRequestNotification;


class TechnicalSupportController extends Controller
{
        public function index()
    {
        $supports = TechnicalSupport::where('user_id', Auth::id())->latest()->get();
        return view('user.support.index', compact('supports'));
    }

    public function create()
    {
        return view('user.support.create');
    }

public function store(Request $request)
{
    $request->validate([
        'subject' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|in:teknikal,billing',
        'attachment' => 'nullable|file|mimes:jpg,png,pdf,zip,docx|max:5120',
    ]);

    $path = $request->file('attachment')?->store('support_attachments', 'public');

    $support = TechnicalSupport::create([
        'user_id' => Auth::id(),
        'subject' => $request->subject,
        'description' => $request->description,
        'attachment' => $path,
        'category' => $request->category,
        'message' => '',
    ]);

if ($request->category === 'teknikal') {
    $admins = User::where('role', 'admin')->get();
    Notification::send($admins, new SupportRequestNotification($support));
} elseif ($request->category === 'billing') {
    $staffs = User::where('role', 'billing')->get();
    Notification::send($staffs, new SupportRequestNotification($support));
}


    return redirect()->route('user.support.index')->with('success', 'Permintaan bantuan telah dikirim.');
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
