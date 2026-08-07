@extends('layouts.app')

@section('title', 'login')

@section('content')

<style>
    .login-card {
        width: 20rem;
    }
    .login-card .card-header {
        background-color: #4a63c4;
        color: #ffffff;
        font-weight: bold;
    }
    .login-card .card-body {
        background-color: #ffffff;
    }
    .login-card .form-control {
        background-color: #eef1fa;
        border: 1px solid #c9d0e0;
    }
    .login-card .form-control:focus {
        background-color: #ffffff;
        border-color: #4a63c4;
        box-shadow: 0 0 0 0.2rem rgba(74, 99, 196, 0.25);
    }
    .login-card .btn-primary {
        background-color: #2f5bd7;
        border-color: #2f5bd7;
    }
    .login-card .btn-primary:hover {
        background-color: #1e46b8;
        border-color: #1e46b8;
    }
</style>

<div class="card text-center position-absolute top-50 start-50 translate-middle login-card">
    <h5 class="card-header">Login POS</h5>
    <div class="card-body">
        <form action="{{ route('auth') }}" method="POST">
            @csrf

        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">

            @error('email')
                <div class="badge text-bg-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">

            @error('password')
                <div class="badge text-bg-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


</div>

@endsection