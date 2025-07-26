+@extends('layouts.admin')

@section('title',)

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Daftar User</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Tambah User</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Login Terakhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                @if($user->role === 'user')
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->status === 'active')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Suspend</span>
                            @endif
                        </td>
                        <td>
                            {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : '-' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.users.toggle', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ubah status user ini?')">
                                @csrf
                                @method('PATCH')
                                @if($user->status === 'active')
                                    <button class="btn btn-secondary btn-sm">Suspend</button>
                                @else
                                    <button class="btn btn-success btn-sm">Aktifkan</button>
                                @endif
                            </form>

                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @empty
                <tr><td colspan="5" class="text-center">Belum ada user.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
