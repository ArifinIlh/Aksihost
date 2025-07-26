@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Daftar Permintaan Bantuan</h2>
    <a href="{{ route('user.support.create') }}" class="btn btn-primary mb-3">Buat Permintaan Baru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Lampiran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($supports as $item)
                <tr>
                    <td>{{ $item->subject }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        @if($item->attachment)
                            <a href="{{ asset('storage/' . $item->attachment) }}" target="_blank">Lihat File</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada permintaan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
