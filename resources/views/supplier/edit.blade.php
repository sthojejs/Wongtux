@extends('layouts.app')

@section('content')
<h4>Edit Supplier</h4>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Nama Supplier</label>
        <input type="text" name="nama" class="form-control" value="{{ $supplier->nama }}" required>
    </div>

    <div class="mb-3">
        <label>Kontak</label>
        <input type="text" name="kontak" class="form-control" value="{{ $supplier->kontak }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $supplier->email }}">
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control">{{ $supplier->alamat }}</textarea>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection
