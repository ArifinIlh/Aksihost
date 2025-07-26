@extends('layouts.billing')

@section('content')
<div class="container">
    <h2>Detail Tiket Bantuan</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>User:</strong> {{ $ticket->user->name }}</p>
            <p><strong>Subjek:</strong> {{ $ticket->subject }}</p>
            <p><strong>Deskripsi:</strong><br>{{ $ticket->description }}</p>
            <p><strong>Status Saat Ini:</strong> {{ ucfirst($ticket->status) }}</p>

            @if($ticket->attachment)
                <p><strong>Lampiran:</strong> <a href="{{ Storage::url($ticket->attachment) }}" target="_blank">Lihat File</a></p>
            @endif

            @if($ticket->response_note)
                <p><strong>Catatan Tanggapan:</strong><br>{{ $ticket->response_note }}</p>
            @endif
        </div>
    </div>

    <h5>Perbarui Status Tiket</h5>
    <form action="{{ route('billing.support.updateStatus', $ticket->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="diproses" {{ $ticket->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ $ticket->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ $ticket->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="response_note">Catatan Tanggapan (Opsional)</label>
            <textarea name="response_note" id="response_note" class="form-control" rows="4">{{ old('response_note', $ticket->response_note) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('billing.support.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
