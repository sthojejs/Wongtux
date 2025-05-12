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
        <label>Barang</label>
        <select name="barang_id" class="form-select" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barang as $b)
                <option value="{{ $b->id }}">{{ $b->nama }}</option>
            @endforeach
        </select>
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
