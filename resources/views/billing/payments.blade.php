@extends('layouts.billing')

@section('content')
<div class="container">
    <h1>Daftar Pembayaran</h1>

    {{-- Contoh konten --}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop data pembayaran di sini --}}
        </tbody>
    </table>
</div>
@endsection
