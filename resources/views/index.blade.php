@extends('main')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* CSS Khusus untuk halaman Beranda */
    html {
        scroll-behavior: smooth; /* 🔥 Scroll halus */
    }

    body {
        margin: 0;
        background-color: #f5f5f5;
    }

    /* Hero section */
    .hero {
        position: relative;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        overflow: hidden;
        margin-top: -70px; /* Penyesuaian agar hero tertutup navbar fixed */
    }

    .hero-image {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -2;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }

    .hero-content {
        backdrop-filter: blur(4px);
        background: rgba(0, 0, 0, 0.3);
        padding: 24px 20px;
        border-radius: 12px;
    }

    .hero-content h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }
    @media (min-width: 768px) {
        .hero-content h1 {
            font-size: 38px;
        }
    }

    .hero-content p {
        font-size: 16px;
        margin: 10px 0;
    }
    @media (min-width: 768px) {
        .hero-content p {
            font-size: 20px;
        }
    }

    .btn {
        display: inline-block;
        margin: 15px 10px 0 10px;
        padding: 10px 22px;
        background-color: #007bff;
        color: white;
        font-size: 14px;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
        font-weight: bold;
    }
    @media (min-width: 768px) {
        .btn {
            font-size: 16px;
            padding: 10px 24px;
        }
    }

    .btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .btn-green {
        background-color: #28a745;
    }

    .btn-green:hover {
        background-color: #1e7e34;
    }

    /* Tentang Kami section */
    #tentang {
        padding: 40px 16px;
        text-align: center;
        background-color: #fff;
    }
    @media (min-width: 768px) {
        #tentang {
            padding: 60px 20px;
        }
    }

    #tentang h2 {
        color: #333;
        font-size: 24px;
    }
    @media (min-width: 768px) {
        #tentang h2 {
            font-size: 28px;
        }
    }

    #tentang p {
        max-width: 700px;
        margin: 20px auto;
        color: #555;
        font-size: 14px;
        line-height: 1.6;
    }
    @media (min-width: 768px) {
        #tentang p {
            font-size: 16px;
        }
    }
</style>

<section class="hero" id="home">
    <div class="hero-overlay"></div>
    <img src="{{ asset('assets/image/kopitiam.jpg') }}" alt="Warehouse" class="hero-image">

    <div class="hero-content">
        <h1 data-aos="fade-up" data-aos-duration="1000">
            Selamat Datang di 1/2 Kopi Tiam
        </h1>
        <p data-aos="fade-up" data-aos-delay="200">
            因为幸福不一定是完美的
        </p>
        <p data-aos="fade-up" data-aos-delay="400">
            "karena bahagia tak harus sempurna"
        </p>
        <p data-aos="fade-up" data-aos-delay="600">
            Kelola stok barang dengan mudah dan efisien
        </p>

        <div data-aos="zoom-in" data-aos-delay="800">
            <a href="{{ url('/login') }}" class="btn">Masuk Sekarang</a>
            <a href="#tentang" class="btn btn-green">Tentang Kami</a>
        </div>
    </div>
</section>

<section id="tentang">
    <h2 data-aos="fade-up">Tentang Kami</h2>
    <p data-aos="fade-up" data-aos-delay="200">
        PT Paraprenuer Indonesia Bahagia berkomitmen untuk menyediakan sistem manajemen stok barang yang efisien,
        sederhana, dan mudah digunakan. Kami percaya bahwa kebahagiaan berasal dari keteraturan dan kemudahan dalam bekerja.
    </p>
    <p data-aos="fade-up" data-aos-delay="400">
        Dengan semangat “Satu Per Dua”, kami percaya bahwa kebahagiaan tak harus sempurna, namun cukup berarti bagi semua.
    </p>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
@endsection