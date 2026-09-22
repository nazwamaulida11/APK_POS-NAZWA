@extends('layouts.app')

@section('title', 'Jenis')

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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Daftar Jenis Produk</h1>
    <a href="{{ route('admin.jenis.create') }}" class="btn btn-primary">+ Tambah Jenis</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Jenis</th>
            <th scope="col">Dibuat Oleh (User)</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jenis as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->nama_jenis }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <!-- Lingkaran Avatar Inisial -->
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                            style="width: 32px; height: 32px; font-size: 0.8rem;">
                            {{ strtoupper(substr($item->user->name ?? 'K', 0, 1)) }}
                        </div>

                        <!-- Nama User Sejajar Samping -->
                        <span class="fw-semibold text-dark small">
                            {{ $item->user->name ?? 'Kasir' }}
                        </span>
                    </div>
                </td>
                <td>
                    <a href="{{ route('admin.jenis.edit', $item->id) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>
                    <form action="{{ route('admin.jenis.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Data jenis belum ada.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection