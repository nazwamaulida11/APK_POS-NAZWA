<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'About')

<!-- batas awal isi konten -->
@section('content')

<style>
    .about-banner{
        height: 240px;
        background-size: cover;
        background-position: center;
        border-radius: 0.75rem 0.75rem 0 0;
        position: relative;
    }
    .about-banner::after{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.15), rgba(0,0,0,0.55));
        border-radius: 0.75rem 0.75rem 0 0;
    }
    .about-logo{
        width: 96px;
        height: 96px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        position: absolute;
        left: 50%;
        bottom: -48px;
        transform: translateX(-50%);
        background: #fff;
    }
    .product-photo{
        width: 100%;
        height: 130px;
        object-fit: cover;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
    }
</style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Card Utama -->
                <div class="card shadow-sm border-0 ">

                    <!-- Banner + Logo -->
                    <div class="about-banner" style="background-image: url('{{ asset('images/about-banner.jpg') }}');">
                    </div>
                    <div class="text-center" style="position: relative;">
                        <img src="{{ asset('images/logo-nazwa-food.png') }}" alt="Logo nazwa's food" class="about-logo">
                    </div>

                    <div class="card-body m-4" style="margin-top: 3.5rem !important;">

                        <!-- Header -->
                        <section id="content1" class="jumbotron text-center bg-white p-4 rounded-3 mb-4">
                            <h1 class="h3 fw-bold text-dark mb-1">nazwa's food</h1>
                            <p class="lead text-primary fw-semibold mb-0">Kasir Digital untuk Usaha Makanan &amp; Minuman</p>
                        </section>
                        <hr class="my-4">

                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-2">
                                <i class="bi bi-info-circle-fill me-2 text-primary"></i>Tentang nazwa's food
                            </h5>
                            <p class="text-secondary lh-lg mb-0">
                                <strong>nazwa's food</strong> adalah usaha yang menjual berbagai macam
                                <strong>makanan dan minuman</strong>, mulai dari menu berat seperti nasi goreng dan
                                burger, hingga minuman kekinian seperti kopi latte dan matcha latte.
                                Untuk mendukung operasional sehari-hari, nazwa's food menggunakan sistem
                                <strong>Point of Sale (POS)</strong> sendiri yang memudahkan pencatatan transaksi,
                                pengelolaan stok produk, dan pemantauan penjualan secara praktis, cepat, dan akurat.
                            </p>
                        </div>

                        <!-- Foto Produk -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="bi bi-images me-2 text-primary"></i>Beberapa Menu Kami
                            </h6>
                            <div class="row g-3 text-center">
                                <div class="col-6 col-md-3">
                                    <img src="{{ asset('images/produk/nasgor.jpg') }}" alt="Nasi Goreng" class="product-photo">
                                    <small class="text-secondary d-block">Nasi Goreng</small>
                                </div>
                                <div class="col-6 col-md-3">
                                    <img src="{{ asset('images/produk/burger.jpg') }}" alt="Burger King" class="product-photo">
                                    <small class="text-secondary d-block">Burger King</small>
                                </div>
                                <div class="col-6 col-md-3">
                                    <img src="{{ asset('images/produk/kopilatte.jpg') }}" alt="Kopi Latte" class="product-photo">
                                    <small class="text-secondary d-block">Kopi Latte</small>
                                </div>
                                <div class="col-6 col-md-3">
                                    <img src="{{ asset('images/produk/matchalatte.jpg') }}" alt="Matcha Latte" class="product-photo">
                                    <small class="text-secondary d-block">Matcha Latte</small>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <h6 class="fw-bold text-dark mb-3">
                                        <i class="bi bi-card-heading me-2 text-primary"></i>Produk Kami
                                    </h6>
                                    <ul class="list-unstyled mb-0 text-secondary small lh-lg">
                                        <li><strong>Kategori:</strong> Makanan &amp; Minuman</li>
                                        <li><strong>Menu Makanan:</strong> Nasi Goreng, Burger, dll</li>
                                        <li><strong>Menu Minuman:</strong> Kopi Latte, Matcha Latte, dll</li>
                                        <li><strong>Metode Bayar:</strong> Cash &amp; QRIS</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Fitur Sistem -->
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <h6 class="fw-bold text-dark mb-3">
                                        <i class="bi bi-cpu-fill me-2 text-primary"></i>Fitur Sistem Kasir
                                    </h6>
                                    <ul class="list-unstyled mb-0 text-secondary small lh-lg">
                                        <li><i class="bi bi-box-seam me-1 text-primary"></i> <strong>Manajemen Produk</strong> &amp; Stok</li>
                                        <li><i class="bi bi-cart-check me-1 text-primary"></i> <strong>Pencatatan Transaksi</strong> Penjualan</li>
                                        <li><i class="bi bi-people me-1 text-primary"></i> <strong>Manajemen Users</strong> &amp; Kasir</li>
                                        <li><i class="bi bi-receipt me-1 text-primary"></i> <strong>Cetak Struk</strong> Otomatis</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 bg-primary bg-opacity-10 rounded-3 mb-4 border border-primary border-opacity-25">
                            <h6 class="fw-bold text-primary mb-2">
                                <i class="bi bi-bullseye me-2"></i>Tujuan Aplikasi
                            </h6>
                            <p class="text-secondary small mb-0">
                                Membantu operasional nazwa's food dalam pencatatan transaksi penjualan,
                                pengelolaan stok barang, dan pembuatan laporan keuangan harian secara otomatis dan akurat.
                            </p>
                        </div>

                        <!-- Kontak -->
                        <div class="text-center pt-2">
                            <h6 class="fw-bold text-dark mb-3">Hubungi Kami</h6>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="https://gmail.com/nazwaamaulidaaa@gmail.com" target="_blank" class="text-danger">
                                    <i class="bi bi-envelope me-1" style="font-size: 30px;"></i>
                                </a>
                                <a href="https://github.com/nazwamaulida11" target="_blank" class="text-dark">
                                    <i class="bi bi-github" style="font-size: 30px;"></i>
                                </a>
                               <a href="https://instagram.com/nzwmldaaa" target="_blank" class="text-primary">
                                    <i class="bi bi-instagram me-1" style="font-size: 30px;"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- Footer Card -->
                    <div class="card-footer bg-white text-center py-3 border-0 rounded-bottom-4">
                        <small class="text-muted">&copy; 2026 nazwa's food</small>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection