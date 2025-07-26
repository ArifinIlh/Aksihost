@extends('layouts.admin')

@section('title')

@section('content')
<div class="container">
    <h3>Edit Pembayaran: {{ $payment->invoice_number }}</h3>

    <form action="{{ route('admin.payments.update', $payment) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="pending" {{ $payment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="verified" {{ $payment->status === 'verified' ? 'selected' : '' }}>Verified</option>
                <option value="rejected" {{ $payment->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="refunded" {{ $payment->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
