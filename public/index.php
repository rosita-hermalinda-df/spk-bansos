<!DOCTYPE html>

<?php
$currentPage = basename($_SERVER['PHP_SELF']);
include "../config/koneksi.php";

$currentPage = basename($_SERVER['PHP_SELF']);

$informasi = mysqli_query($conn,"
SELECT *
FROM tb_informasi
ORDER BY tanggal DESC
LIMIT 3
");
?>

<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SPK Bansos | Desa Semampirejo</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        
        <style>
        
        body{
            font-family:'Segoe UI',sans-serif;
            background:#f8f9fa;
        }

        .navbar{
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }

        .hero{
            padding:100px 0;
            background:linear-gradient(135deg,#0d6efd,#4dabf7);
            color:white;
        }

        .hero h1{
            font-weight:700;
            font-size:48px;
        }

        .hero p{
            font-size:18px;
        }

        .section{
            padding:70px 0;
        }

        .icon-box{
            width:70px;
            height:70px;
            border-radius:50%;
            background:#0d6efd;
            color:white;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
            font-size:30px;
        }

        footer{
            background:#0d6efd;
            color:white;
            padding:20px;
        }
        </style>
    </head>
    
    <body>
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <img src="../assets/img/logo.png"
                        style="height:45px; width:auto;">
                        
                        <div class="lh-1">
                            <span class="fw-bold fs-5">
                                SPK BANSOS
                            </span>
                            
                            <small class="d-block text-secondary"
                                style="font-size:10px;">
                                    Desa Semampirejo
                            </small>
                        </div>
                </a>
                
                <button class="navbar-toggler"
                    data-bs-toggle="collapse"
                    data-bs-target="#menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse"id="menu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage == 'index.php') ? 'active fw-bold text-primary' : ''; ?>"
                            href="index.php">
                                Beranda
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage == 'tentang.php') ? 'active fw-bold text-primary' : ''; ?>"
                            href="tentang.php">
                                Tentang
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage == 'tentang.php') ? 'active fw-bold text-primary' : ''; ?>"
                            href="informasi.php">
                                Informasi
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage == 'hasil.php') ? 'active fw-bold text-primary' : ''; ?>"
                            href="hasil.php">
                                Hasil Ranking
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="btn btn-primary ms-3"
                            href="../auth/login.php">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Login
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        
        <section class="hero">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1>Sistem Pendukung Keputusan Penerima Bantuan Sosial</h1>
                        <p class="mt-3">
                            Membantu Pemerintah Desa Semampirejo menentukan
                            calon penerima bantuan sosial secara objektif menggunakan
                            metode <strong>Weighted Product (WP)</strong>.
                        </p>
                        
                        <div class="mt-4">
                            <a href="hasil.php"class="btn btn-light btn-lg">
                                <i class="bi bi-trophy-fill"></i>
                                    Lihat Hasil Ranking
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 text-center">
                        <i class="bi bi-people-fill"style="font-size:180px;"></i>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="section">
            <div class="container">
                <div class="text-center mb-5">
                    <h2>Mengapa Menggunakan Sistem Ini?</h2>
                    <p class="text-muted">
                        Proses seleksi dilakukan berdasarkan beberapa kriteria
                        menggunakan metode Weighted Product.
                    </p>
                </div>
                
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <div class="icon-box">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <h5 class="mt-3">Objektif</h5>
                        <p>Penilaian dilakukan berdasarkan kriteria yang telah ditentukan.</p>
                    </div>
                    
                    <div class="col-md-4 text-center mb-4">
                        <div class="icon-box">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h5 class="mt-3">Cepat</h5>
                        <p>Perhitungan dilakukan otomatis sehingga menghemat waktu.</p>
                    </div>
                    
                    <div class="col-md-4 text-center mb-4">
                        <div class="icon-box">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>
                        <h5 class="mt-3">Akurat</h5>
                        <p>Menghasilkan rekomendasi berdasarkan metode Weighted Product.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- TENTANG DESA -->
        <section class="section bg-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <img src="../assets/img/desa.webp"
                            class="img-fluid rounded shadow"
                            alt="Desa Semampirejo">
                    </div>

                    <div class="col-lg-6">
                        <h2 class="fw-bold text-primary mb-4">
                            <i class="bi bi-geo-alt-fill"></i>
                            Tentang Desa Semampirejo
                        </h2>

                        <p align="justify">
                            Desa Semampirejo merupakan salah satu desa yang berkomitmen
                            meningkatkan kualitas pelayanan kepada masyarakat, termasuk
                            dalam proses penyaluran bantuan sosial agar tepat sasaran,
                            transparan, dan objektif.
                        </p>

                        <p align="justify">
                            Untuk mendukung proses tersebut, dikembangkan
                            <strong>Sistem Pendukung Keputusan Penentuan Penerima Bantuan Sosial</strong>
                            berbasis web menggunakan metode
                            <strong>Weighted Product (WP)</strong>.
                            Sistem ini membantu pemerintah desa dalam memberikan
                            rekomendasi calon penerima berdasarkan kriteria yang telah
                            ditentukan.
                        </p>

                        <a href="tentang.php" class="btn btn-primary">
                            <i class="bi bi-book-fill"></i>
                            Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- INFORMASI TERBARU -->

<section class="section bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">

                <i class="bi bi-megaphone-fill text-primary"></i>

                Informasi Terbaru

            </h2>

            <p class="text-muted">

                Pengumuman dan informasi terbaru dari Pemerintah Desa Semampirejo.

            </p>

        </div>

        <div class="row">

            <?php
            if(mysqli_num_rows($informasi)>0){

                while($info=mysqli_fetch_assoc($informasi)){
            ?>

            <div class="col-lg-4 mb-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <small class="text-muted">

                            <i class="bi bi-calendar-event"></i>

                            <?= date('d F Y',strtotime($info['tanggal'])); ?>

                        </small>

                        <h5 class="mt-3">

                            <?= htmlspecialchars($info['judul']); ?>

                        </h5>

                        <p>

                            <?= substr(strip_tags($info['isi']),0,100); ?>

                            <?= strlen(strip_tags($info['isi']))>100?'...':''; ?>

                        </p>

                        <a
                        href="detail-informasi.php?id=<?= $info['id_informasi']; ?>"
                        class="btn btn-outline-primary btn-sm">

                            <i class="bi bi-book"></i>

                            Baca Selengkapnya

                        </a>

                    </div>

                </div>

            </div>

            <?php
                }

            }else{
            ?>

            <div class="col-12">

                <div class="alert alert-info text-center">

                    Belum ada informasi yang dipublikasikan.

                </div>

            </div>

            <?php } ?>

        </div>

        <div class="text-center mt-4">

            <a
            href="informasi.php"
            class="btn btn-primary">

                <i class="bi bi-arrow-right-circle"></i>

                Lihat Semua Informasi

            </a>

        </div>

    </div>

</section>
        
        <footer>
            <div class="container text-center">
                © <?= date('Y'); ?>
                Sistem Pendukung Keputusan Penerima Bantuan Sosial
                <br>
                Desa Semampirejo
            </div>
        </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>