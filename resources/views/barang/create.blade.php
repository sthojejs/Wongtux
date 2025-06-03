@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">➕ Tambah Barang Baru</h4>

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

    <form action="{{ route('barang.store') }}" method="POST" class="card shadow-sm p-4 rounded-4">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select name="kategori_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Barang</label>
            <input type="text" name="nama" class="form-control" placeholder="Contoh: Meja Lipat" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kode Barang</label>
            <input type="text" name="kode" class="form-control" placeholder="Contoh: BRG-001" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Contoh: Barang dari kayu jati..."></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Stok</label>
            <input type="number" name="stok" class="form-control" placeholder="Contoh: 25" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
