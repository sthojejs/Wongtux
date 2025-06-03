@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">✏️ Edit Data Barang</h4>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" class="card shadow-sm p-4 rounded-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select name="kategori_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}" {{ $barang->kategori_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Barang</label>
            <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kode</label>
            <input type="text" name="kode" class="form-control" value="{{ $barang->kode }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ $barang->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
