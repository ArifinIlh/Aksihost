@extends('layouts.user')

@section('title', 'Konfirmasi & Pembayaran')

@section('content')
@include('components.checkout-steps', ['step' => 2])

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-center fw-bold mb-4">Konfirmasi & Pembayaran</h2>

            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card border-0 shadow rounded-4">
                <div class="card-body px-4 py-5">

                    <h5 class="fw-semibold mb-3">Detail Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>
                                            <strong>{{ ucfirst($item->product_type) }}</strong>: {{ $item->product_name }}<br>
                                            @if ($item->product_type === 'hosting')
                                                <small class="text-muted">Durasi: {{ json_decode($item->meta, true)['duration'] ?? '-' }} bulan</small>
                                            @endif
                                        </td>
                                        <td class="text-end fw-semibold text-primary">
                                            Rp{{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="table-light">
                                    <td><strong>Total Pembayaran</strong></td>
                                    <td class="text-end text-success fw-bold">
                                        Rp{{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr class="my-4">

                    <form action="{{ route('user.hosting.payment.process', $order->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="payment_method" class="form-label fw-semibold">Pilih Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-select rounded-3" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="bank_transfer">Transfer Bank (Virtual Account)</option>
                                <option value="qris">QRIS (Scan QR dari e-Wallet)</option>
                                <option value="ewallet">E-Wallet (OVO, DANA, ShopeePay)</option>
                                <option value="cod">Bayar di Tempat (COD)</option>
                            </select>
                        </div>

                        <!-- Form tambahan berdasarkan metode pembayaran -->
                        <div id="bank_fields" class="payment-method-fields" style="display:none;">
                            <div class="mb-3">
                                <label for="bank_name" class="form-label">Nama Bank</label>
                                <select name="bank_name" id="bank_name" class="form-select">
                                    <option value="">Pilih Bank</option>
                                    <option value="bca">BCA</option>
                                    <option value="bni">BNI</option>
                                    <option value="bri">BRI</option>
                                    <option value="mandiri">Mandiri</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="account_number" class="form-label">Nomor Rekening</label>
                                <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Contoh: 1234567890">
                            </div>
                        </div>

                        <div id="ewallet_fields" class="payment-method-fields" style="display:none;">
                            <div class="mb-3">
                                <label for="ewallet_type" class="form-label">Jenis E-Wallet</label>
                                <select name="ewallet_type" id="ewallet_type" class="form-select">
                                    <option value="ovo">OVO</option>
                                    <option value="dana">DANA</option>
                                    <option value="shopeepay">ShopeePay</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Nomor HP</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Contoh: 081234567890">
                            </div>
                        </div>

                        <div id="qris_fields" class="payment-method-fields" style="display:none;">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Anda akan mendapatkan QR code untuk pembayaran setelah mengkonfirmasi pesanan
                            </div>
                        </div>

                        <div id="cod_fields" class="payment-method-fields" style="display:none;">
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle"></i> Petugas kami akan menghubungi Anda untuk konfirmasi alamat dan waktu pengiriman
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 rounded-pill fw-bold py-2 mt-3">
                            Lanjutkan Pembayaran
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('payment_method').addEventListener('change', function() {
    // Sembunyikan semua form tambahan
    document.querySelectorAll('.payment-method-fields').forEach(function(el) {
        el.style.display = 'none';
    });
    
    // Tampilkan form yang sesuai
    if (this.value === 'bank_transfer') {
        document.getElementById('bank_fields').style.display = 'block';
    } else if (this.value === 'ewallet') {
        document.getElementById('ewallet_fields').style.display = 'block';
    } else if (this.value === 'qris') {
        document.getElementById('qris_fields').style.display = 'block';
    } else if (this.value === 'cod') {
        document.getElementById('cod_fields').style.display = 'block';
    }
});
</script>
@endpush

@endsection