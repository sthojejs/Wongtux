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

<form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Nama Supplier</label>
        <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}" required>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
