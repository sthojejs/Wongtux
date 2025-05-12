@extends('layouts.app')

@section('content')
<h4>Edit Barang</h4>

<form action="{{ route('barang.update', $barang->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Kategori</label>
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
        <label>Nama Barang</label>
        <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" required>
    </div>

    <div class="mb-3">
        <label>Kode</label>
        <input type="text" name="kode" class="form-control" value="{{ $barang->kode }}" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $barang->deskripsi }}</textarea>
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection
