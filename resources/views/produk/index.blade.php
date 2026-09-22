@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h1 class="h4 fw-semibold mb-0">Halaman Produk</h1>
            <small class="text-muted">{{ $products->total() }} produk</small>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('admin.produk.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-control" placeholder="Cari nama produk" style="width:220px;">
                <button class="btn btn-outline-secondary">Cari</button>
            </form>
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
                + Tambah Produk
            </a>
        </div>
    </div>

    {{-- Grid produk --}}
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
        @forelse ($products as $item)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 product-card">

                    {{-- Foto + badge stok --}}
                    <div class="position-relative bg-light" style="aspect-ratio:1/1; overflow:hidden;">
                        <img src="{{ $item->foto ? asset('storage/'.$item->foto) : asset('images/no-image.png') }}"
                             alt="{{ $item->nama }}"
                             class="w-100 h-100"
                             style="object-fit:cover;">

                        @if ($item->stok <= 0)
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                Habis
                            </span>
                        @elseif ($item->stok < 5)
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                Stok {{ $item->stok }}
                            </span>
                        @elseif ($item->stok < 10)
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">
                                Stok {{ $item->stok }}
                            </span>
                        @else
                            <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                Stok {{ $item->stok }}
                            </span>
                        @endif
                    </div>

                    {{-- Info produk --}}
                    <div class="card-body p-2">
                        <p class="mb-1 small text-truncate" title="{{ $item->nama }}">
                            {{ $item->nama }}
                        </p>

                        <span class="badge bg-secondary mb-1">
                            {{ $item->jenis->nama_jenis ?? '-' }}
                        </span>

                        <p class="mb-0 fw-semibold text-rupiah">
                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                        </p>
                        <p class="mb-2 small text-rupiah text-decoration-line-through">
                            Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                        </p>
                         @if(auth()->check() && auth()->user()->role?->name === 'admin')
                        {{-- Aksi --}}
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.produk.edit', ['produk' => $item->id, 'page' => request('page', 1), 'search' => request('search')]) }}"
                               class="btn btn-sm btn-warning flex-fill">
                                Edit
                            </a>
                            <form action="{{ route('admin.produk.destroy', $item->id) }}"
                                  method="POST" class="flex-fill"
                                  onsubmit="return confirm('Hapus produk {{ $item->nama }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100">
                                    Hapus
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                Belum ada produk.
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>

<style>
    .product-card {
        transition: transform .15s ease, box-shadow .15s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,.08) !important;
    }
    .product-card .card-body {
        font-size: 0.8rem;
    }
    .product-card .btn-sm {
        font-size: 0.7rem;
        padding: 0.25rem 0.3rem;
    }
    .text-rupiah {
        color: #16a34a !important;
    }
</style>
@endsection