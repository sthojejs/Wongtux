@extends('layouts.app')

@section('content')
    <h4>Laporan Transaksi</h4>

    <form method="GET" class="row g-3 mb-3">
        <div class="col-auto">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-auto">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Supplier</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $t)
                <tr>
                    <td>{{ $t->created_at->format('d-m-Y') }}</td>
                    <td>{{ $t->barang->nama ?? '-' }}</td>
                    <td>{{ $t->supplier->nama ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $t->jenis == 'masuk' ? 'success' : 'danger' }}">
                            {{ ucfirst($t->jenis) }}
                        </span>
                    </td>
                    <td>{{ $t->jumlah }}</td>
                    <td>{{ $t->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <a href="{{ route('laporan.transaksi.pdf', request()->query()) }}" class="btn btn-danger btn-sm">Export PDF</a>
        <a href="{{ route('laporan.transaksi.excel', request()->query()) }}" class="btn btn-success btn-sm">Export Excel</a>
    </div>
@endsection