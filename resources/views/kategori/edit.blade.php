@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded-4 p-4">
        <h4 class="mb-4">Edit Supplier</h4>

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
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Supplier</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $kategori->nama }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
