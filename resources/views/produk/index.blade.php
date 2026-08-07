@extends('layouts.app')
@section('title','produk')
@section('content')

<style>
    h1 {
        color: #2c3e50;
    }

    .table thead th {
        background-color: #4e73df !important;
        color: #ffffff !important;
    }

    .table > tbody > tr:nth-child(even) > td {
        background-color: #f2f6fc !important;
    }

    .table > tbody > tr:hover > td {
        background-color: #dce6f7 !important;
    }
</style>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h1>Halaman Produk</h1>

@can('create', App\Models\Produk::class)
<a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Create</a>
@endcan

<form action="{{ route('admin.produk.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search nama produk">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
</form>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <td>{{ $products->firstItem() + $loop->index }}</td>
            <td>
                @if($product->foto)
                    <img src="{{ asset('storage/'.$product->foto) }}"
                         width="60"
                         class="img-thumbnail">
                @else
                    <img src="https://via.placeholder.com/60x60?text=No+Image"
                         width="60"
                         class="img-thumbnail">
                @endif
            </td>
            <td>{{ $product->nama }}</td>
            <td>Rp {{ number_format($product->harga_beli) }}</td>
            <td>Rp {{ number_format($product->harga_jual) }}</td>
            <td>{{ $product->stok }}</td>
            <td class="d-flex gap-1">
                @can('update', $product)
                <a href="{{ route('admin.produk.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                @endcan

                @can('delete', $product)
                <form action="{{ route('admin.produk.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                        Hapus
                    </button>
                </form>
                @endcan
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Data tidak tersedia.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links() }}

@endsection