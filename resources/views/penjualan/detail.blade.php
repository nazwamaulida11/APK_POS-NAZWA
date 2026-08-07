@extends('layouts.app')

@section('title','Detail Penjualan')

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

    .info-label {
        font-weight: 600;
        color: #4e5d78;
        width: 180px;
    }
</style>

<h1>Detail Transaksi Penjualan</h1>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr>
                <td class="info-label">Tanggal Transaksi</td>
                <td>: {{ $penjualan->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
            </tr>
            <tr>
                <td class="info-label">Kasir</td>
                <td>: {{ $penjualan->user->name }}</td>
            </tr>
            <tr>
                <td class="info-label">Metode Pembayaran</td>
                <td>: {{ $penjualan->metode_pembayaran }}</td>
            </tr>
            <tr>
                <td class="info-label">Status</td>
                <td>:
                    @if($penjualan->status === 'COMPLETED')
                        <span class="badge bg-success">{{ $penjualan->status }}</span>
                    @else
                        <span class="badge bg-warning text-dark">{{ $penjualan->status }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="info-label">Total Pembayaran</td>
                <td>: <strong>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>
</div>

<h5 class="mb-3">Daftar Item</h5>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Produk</th>
            <th>Harga Satuan</th>
            <th>Kuantitas</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($penjualan->itemPenjualan as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->produk->nama }}</td>
            <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
            <td>{{ $item->kuantitas }}</td>
            <td>Rp {{ number_format($item->harga_satuan * $item->kuantitas, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada item pada transaksi ini</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" class="text-end">Total</th>
            <th>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>

<a href="{{ route('penjualan.index') }}" class="btn btn-secondary mb-3">
     Kembali
</a>

@endsection