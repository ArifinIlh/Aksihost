<div class="d-flex align-items-center justify-content-between mb-4 px-2">
  <div class="text-center flex-fill">
      <div class="step {{ $step >= 1 ? 'active' : '' }}">1</div>
      <div class="mt-2 {{ $step >= 1 ? 'fw-bold' : 'text-muted' }}">Pilih Produk</div>
  </div>
  <div class="flex-fill mx-1">
      <hr class="step-line">
  </div>
  <div class="text-center flex-fill">
      <div class="step {{ $step >= 2 ? 'active' : '' }}">2</div>
      <div class="mt-2 {{ $step >= 2 ? 'fw-bold' : 'text-muted' }}">Pilih Metode Pembayaran</div>
  </div>
  <div class="flex-fill mx-1">
      <hr class="step-line">
  </div>
  <div class="text-center flex-fill">
      <div class="step {{ $step >= 3 ? 'active' : '' }}">3</div>
      <div class="mt-2 {{ $step == 3 ? 'fw-bold' : 'text-muted' }}">Selesai</div>
  </div>
</div>

<style>
  .step {
      width: 28px;
      height: 28px;
      line-height: 28px;
      border-radius: 50%;
      text-align: center;
      background-color: #e0e0e0;
      color: #999;
      font-weight: 600;
      margin: 0 auto;
  }

  .step.active {
      background-color: #0073ff; /* Orange */
      color: white;
  }

  .step-line {
      border-top: 4px solid #e0e0e0;
      margin: 0;
  }
</style>
