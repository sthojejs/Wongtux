@extends('layouts.app')

@section('content')
<h4>Data Supplier</h4>
<a href="{{ route('supplier.create') }}" class="btn btn-success mb-3">+ Tambah Supplier</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Nama</th>
            <th>Kontak</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($supplier as $s)
        <tr>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->kontak }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->alamat }}</td>
            <td>
                <a href="{{ route('supplier.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('supplier.destroy', $s->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus supplier?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
