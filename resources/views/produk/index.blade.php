@extends('layouts.app')
@section('title','produk')
@section('content')

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h1>Halaman Produk</h1>

{{-- ✅ Fix: route produk.create → admin.produk.create --}}
@can('create', App\Models\Produk::class)
<a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Create</a>
@endcan

{{-- ✅ Fix: route produk.index → admin.produk.index --}}
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

<table class="table">
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
                <img src="{{ asset('storage/'.$product->foto) }}"
                     width="60"
                     class="img-thumbnail">
            </td>
            <td>{{ $product->nama }}</td>
            <td>Rp {{ number_format($product->harga_beli) }}</td>
            <td>Rp {{ number_format($product->harga_jual) }}</td>
            <td>{{ $product->stok }}</td>
            <td class="d-flex gap-1">
                {{-- ✅ Fix: route produk.edit → admin.produk.edit --}}
                @can('update', $product)
                <a href="{{ route('admin.produk.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                @endcan

                {{-- ✅ Fix: route produk.destroy → admin.produk.destroy --}}
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
            {{-- ✅ Fix: typo collspan → colspan, nilai 8 → 7 --}}
            <td colspan="7" class="text-center">Data tidak tersedia.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links() }}

@endsection