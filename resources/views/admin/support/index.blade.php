@extends('layouts.admin')

@section('content')
<h2>Daftar Permintaan Bantuan</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>User</th>
            <th>Subjek</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($supports as $support)
        <tr>
            <td>{{ $support->user->name }}</td>
            <td>{{ $support->subject }}</td>
            <td>{{ ucfirst($support->category) }}</td>
            <td>{{ ucfirst($support->status) }}</td>
            <td>{{ $support->created_at->format('d-m-Y') }}</td>
            <td>
                <a href="{{ route('admin.support.show', $support->id) }}" class="btn btn-sm btn-info">Lihat</a>

                @if($support->status !== 'selesai')
                <form action="{{ route('admin.support.complete', $support->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Tandai sebagai selesai?')">Selesai</button>
                </form>
                @endif

                @if($support->status !== 'ditolak')
                <form action="{{ route('admin.support.reject', $support->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Tolak permintaan ini?')">Tolak</button>
                </form>
                @endif

                <form action="{{ route('admin.support.destroy', $support->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus permintaan ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
