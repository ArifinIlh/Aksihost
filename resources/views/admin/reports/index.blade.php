@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Sistem</h1>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Jenis Laporan</label>
            <select name="type" class="form-select">
                <option value="penjualan" {{ request('type') == 'penjualan' ? 'selected' : '' }}>Penjualan</option>
                <option value="user" {{ request('type') == 'user' ? 'selected' : '' }}>User</option>
                <option value="performa" {{ request('type') == 'performa' ? 'selected' : '' }}>Performa</option>
                <option value="keuangan" {{ request('type') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>

        <div class="col-md-3">
            <label class="form-label">Tanggal Akhir</label>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>

        <div class="col-md-3 align-self-end">
            <button class="btn btn-primary w-100">Tampilkan</button>
        </div>
    </form>

    @if($data->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    @foreach(array_keys((array) $data->first()) as $key)
                        @if($key !== 'date')
                            <th>{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->date }}</td>
                        @foreach($row->toArray() as $key => $value)
                            @if($key !== 'date')
                                <td>{{ is_numeric($value) ? number_format($value, 2, ',', '.') : $value }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">Data tidak ditemukan untuk periode ini.</div>
    @endif
</div>
@endsection
