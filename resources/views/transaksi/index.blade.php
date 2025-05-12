@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Transaksi</h4>
    <a href="{{ route('transaksi.create') }}" class="btn btn-success">+ Tambah Transaksi</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Barang</th>
            <th>Supplier</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksi as $t)
        <tr>
            <td>{{ $t->barang->nama ?? '-' }}</td>
            <td>{{ $t->supplier->nama ?? '-' }}</td>
            <td>
                <span class="badge bg-{{ $t->jenis == 'masuk' ? 'success' : 'danger' }}">
                    {{ ucfirst($t->jenis) }}
                </span>
            </td>
            <td>{{ $t->jumlah }}</td>
            <td>{{ $t->keterangan }}</td>
            <td>{{ $t->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
