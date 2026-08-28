@extends('layouts.app') {{-- sesuaikan dengan layout admin kamu --}}

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
    <div class="row g-3">
        @forelse ($products as $item)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0 product-card">

                    {{-- Foto + badge stok --}}
                    <div class="position-relative bg-light" style="aspect-ratio:1/1; overflow:hidden;">
                        <img src="{{ $item->foto ? asset('storage/'.$item->foto) : asset('images/no-image.png') }}"
                             alt="{{ $item->nama }}"
                             class="w-100 h-100"
                             style="object-fit:cover;">

                        @if ($item->stok > 0)
                            <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                Stok {{ $item->stok }}
                            </span>
                        @else
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                Habis
                            </span>
                        @endif
                    </div>

                    {{-- Info produk --}}
                    <div class="card-body p-2">
                        <p class="mb-1 small text-truncate" title="{{ $item->nama }}">
                            {{ $item->nama }}
                        </p>

                        <p class="mb-0 fw-semibold text-danger">
                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                        </p>
                        <p class="mb-2 small text-muted text-decoration-line-through">
                            Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                        </p>

                        {{-- Aksi --}}
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.produk.edit', $item->id) }}"
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
</style>
@endsection