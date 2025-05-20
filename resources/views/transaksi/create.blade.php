@extends('layouts.app')

@section('content')
<h4>Tambah Transaksi</h4>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Supplier</label>
        <select name="supplier_id" class="form-select">
            <option value="">-- Pilih Supplier (Opsional) --</option>
            @foreach($supplier as $s)
                <option value="{{ $s->id }}">{{ $s->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="barang_id" class="form-label">Barang</label>
        <select name="barang_id" id="barangSelect" class="form-select" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barang as $b)
                <option value="{{ $b->id }}">{{ $b->nama }}</option>
            @endforeach
        </select>
    </div>

    <div id="stokInfo" class="mb-3 text-muted small d-none" data-stok="0">
        <span id="stokText">Stok tersedia: 0</span>
    </div>

    <div class="mb-3">
        <label>Jenis</label>
        <select name="jenis" class="form-select" required>
            <option value="masuk">Barang Masuk</option>
            <option value="keluar">Barang Keluar</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const barangSelect = document.getElementById('barangSelect');
    const stokInfo = document.getElementById('stokInfo');
    const stokText = document.getElementById('stokText');
    const jumlahInput = document.querySelector('input[name="jumlah"]');
    const jenisSelect = document.querySelector('select[name="jenis"]');
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
