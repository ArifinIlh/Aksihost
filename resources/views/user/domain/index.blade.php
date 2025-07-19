@extends('layouts.user')

@section('title',)

@section('content')

<div class="container">
    <h3 class="mb-4">Cek Domain</h3>

    {{-- Notifikasi --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Cek Domain --}}
    <form method="POST" action="{{ route('user.domain.check') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Nama domain" required>
            </div>
            <div class="col-md-4">
                <select name="extension_id" class="form-control" required>
                    <option value="">Pilih Ekstensi</option>
                    @foreach ($extensions as $ext)
                        <option value="{{ $ext->id }}">{{ $ext->extension }} - Rp{{ number_format($ext->price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Cek</button>
            </div>
        </div>
    </form>

    {{-- Hasil Pengecekan --}}
    @if (isset($result))
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>Hasil: <strong>{{ $result['full'] }}</strong></h5>
                @if ($result['available'])
                    <p class="text-success">Domain tersedia 🎉</p>
                    <form method="POST" action="{{ route('user.domain.addToCart') }}">
                        @csrf
                        <input type="hidden" name="domain" value="{{ $result['full'] }}">
                        <input type="hidden" name="extension_id" value="{{ $result['extension_id'] }}">
                        <input type="hidden" name="price" value="{{ $result['price'] }}">
                        <button class="btn btn-warning">Tambah ke Keranjang</button>
                    </form>
                @else
                    <p class="text-danger">Domain sudah digunakan ❌</p>
                @endif
            </div>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Ekstensi</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($extensions as $ext)
                    <tr>
                        <td>{{ $ext->extension }}</td>
                        <td>Rp{{ number_format($ext->price, 0, ',', '.') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success"
                                onclick="showDomainModal('{{ $ext->extension }}', {{ $ext->id }}, {{ $ext->price }})">
                                <i class="fas fa-shopping-cart me-1"></i> Pesan Sekarang
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Form Pesan Domain -->
<div class="modal fade" id="pesanDomainModal" tabindex="-1" aria-labelledby="pesanDomainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('user.domain.addToCart') }}" id="pesanDomainForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pesan Domain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="domainName" class="form-label">Nama Domain</label>
                        <div class="input-group">
                            <input type="text" name="domain_prefix" id="domainName" class="form-control" placeholder="namadomain" required>
                            <span class="input-group-text" id="domainExtension"></span>
                        </div>
                    </div>

                    <input type="hidden" name="domain" id="fullDomain">
                    <input type="hidden" name="extension_id" id="extensionId">
                    <input type="hidden" name="price" id="domainPrice">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Tambah ke Keranjang</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showDomainModal(extension, extensionId, price) {
        document.getElementById('domainName').value = '';
        document.getElementById('domainExtension').innerText = extension;
        document.getElementById('extensionId').value = extensionId;
        document.getElementById('domainPrice').value = price;

        document.getElementById('domainName').oninput = function () {
            const prefix = this.value;
            document.getElementById('fullDomain').value = prefix + extension;
        };

        var modal = new bootstrap.Modal(document.getElementById('pesanDomainModal'));
        modal.show();
    }
</script>

