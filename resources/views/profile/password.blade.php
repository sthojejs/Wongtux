@extends('layouts.app')

@section('content')
<h4>Ubah Password</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Password Lama</label>
        <input type="password" name="current_password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password Baru</label>
        <input type="password" name="password" class="form-control" required minlength="6">
    </div>
    <div class="mb-3">
        <label>Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button class="btn btn-primary">Update Password</button>
</form>
@endsection
