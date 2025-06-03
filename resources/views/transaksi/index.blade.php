@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Card Header + Tombol --}}
    <div class="card shadow-sm rounded-4 p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-0">
            <h4 class="mb-0">📊 Data Transaksi</h4>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Transaksi
            </a>
        </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Card Tabel --}}
    <div class="card shadow-sm rounded-4 p-4">
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle mb-0">
                <thead class="table-dark text-center">
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
                    @forelse ($transaksi as $t)
                        <tr>
                            <td>{{ $t->barang->nama ?? '-' }}</td>
                            <td>{{ $t->supplier->nama ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $t->jenis == 'masuk' ? 'success' : 'danger' }}">
                                    <i class="bi {{ $t->jenis == 'masuk' ? 'bi-box-arrow-in-down' : 'bi-box-arrow-up' }}"></i>
                                    {{ ucfirst($t->jenis) }}
                                </span>
                            </td>
                            <td>{{ $t->jumlah }}</td>
                            <td>{{ $t->keterangan }}</td>
                            <td>{{ $t->created_at->translatedFormat('d F Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
