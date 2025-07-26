@extends('layouts.billing')

@section('content')
<div class="container">
    <h2>Daftar Tiket Bantuan Billing</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subjek</th>
                <th>Pengguna</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ ucfirst($ticket->status) }}</td>
                    <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('billing.support.show', $ticket->id) }}" class="btn btn-sm btn-info">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
