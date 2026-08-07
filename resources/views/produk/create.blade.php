@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<style>
    h4 {
        color: #2c3e50;
    }

    label {
        color: #4e73df;
        font-weight: 600;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }

    .btn-success {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-success:hover {
        background-color: #3d5fc4;
        border-color: #3d5fc4;
    }
</style>

<h4>Tambah Produk</h4>

<form action="{{ route('admin.produk.store') }}"
      method="POST"
      enctype="multipart/form-data">
   @include('produk._form')
</form>
@endsection