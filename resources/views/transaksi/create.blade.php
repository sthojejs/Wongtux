@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">➕ Tambah Transaksi Baru</h4>

    {{-- Notifikasi Error --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ups!</strong> Ada kesalahan saat mengisi form:
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST" class="card shadow-sm p-4 rounded-4">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Supplier (Opsional)</label>
            <select name="supplier_id" class="form-select">
                <option value="">-- Pilih Supplier --</option>
                @foreach($supplier as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Barang</label>
            <select name="barang_id" id="barangSelect" class="form-select" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                @endforeach
            </select>
        </div>

        <div id="stokInfo" class="mb-3 d-none">
            <div class="alert alert-info py-2 px-3 mb-0 small">
                <i class="bi bi-info-circle me-1"></i> <span id="stokText">Stok tersedia: 0</span>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jenis Transaksi</label>
            <select name="jenis" id="jenis" class="form-select" required>
                <option value="masuk">Barang Masuk</option>
                <option value="keluar">Barang Keluar</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required placeholder="Masukkan jumlah transaksi">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Opsional">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const barangSelect = document.getElementById('barangSelect');
    const stokInfo = document.getElementById('stokInfo');
    const stokText = document.getElementById('stokText');
    const jumlahInput = document.getElementById('jumlah');
    const jenisSelect = document.getElementById('jenis');
    const form = document.querySelector('form');

    barangSelect.addEventListener('change', function () {
        const barangId = this.value;
        if (barangId) {
            fetch(`/barang/${barangId}/stok`)
                .then(res => res.json())
                .then(data => {
                    stokInfo.classList.remove('d-none');
                    stokInfo.dataset.stok = data.stok;
                    stokText.textContent = `Stok tersedia: ${data.stok}`;
                });
        } else {
            stokInfo.classList.add('d-none');
            stokInfo.dataset.stok = 0;
        }
    });

    form.addEventListener('submit', function (e) {
        const jenis = jenisSelect.value;
        const jumlah = parseInt(jumlahInput.value);
        const stok = parseInt(stokInfo.dataset.stok);

        if (jenis === 'keluar' && jumlah > stok) {
            e.preventDefault();
            alert(`Jumlah melebihi stok tersedia (${stok}). Harap periksa kembali.`);
        }
    });
});
</script>
@endpush
