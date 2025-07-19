@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Edit Data User</h3>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <button class="btn btn-success">💾 Simpan</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection