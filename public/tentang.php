<!DOCTYPE html>

<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<html lang="id">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tentang | SPK Bansos</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

        <style>
            body{
                background:#f8f9fa;
                font-family:'Segoe UI',sans-serif;
            }

            .navbar{
                box-shadow:0 2px 10px rgba(0,0,0,.08);
            }

            .hero{
                background:linear-gradient(135deg,#0d6efd,#4dabf7);
                color:white;
                padding:70px 0;
            }

            .card{
                border:none;
                border-radius:15px;
            }

            footer{
                background:#0d6efd;
                color:white;
                padding:20px;
                margin-top:60px;
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
                        <a class="nav-link <?= ($currentPage == 'hasil.php') ? 'active fw-bold text-primary' : ''; ?>"
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
        <div class="container text-center">
            <h2 class="fw-bold">
                Tentang Sistem
            </h2>
            <p>
                Sistem Pendukung Keputusan Penentuan Penerima Bantuan Sosial
                Menggunakan Metode Weighted Product (WP)
            </p>
        </div>
    </section>
    
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="text-primary">
                            <i class="bi bi-info-circle-fill"></i>
                            Tentang Sistem
                        </h4>
                        
                        <hr>
                        <p align="justify">
                            Sistem Pendukung Keputusan (SPK) ini dirancang untuk membantu Pemerintah Desa Semampirejo dalam menentukan calon penerima bantuan sosial secara objektif, transparan, dan terstruktur menggunakan metode <strong>Weighted Product (WP)</strong>. Sistem ini mempermudah proses seleksi berdasarkan beberapa kriteria yang telah ditetapkan sehingga keputusan yang dihasilkan lebih tepat sasaran.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="text-success">
                            <i class="bi bi-bullseye"></i>
                            Tujuan Sistem
                        </h4>
                        <hr>
                        <ul>
                            <li>Membantu proses seleksi penerima bantuan sosial.</li>
                            <li>Meningkatkan objektivitas dalam pengambilan keputusan.</li>
                            <li>Mengurangi kesalahan pada proses seleksi manual.</li>
                            <li>Menghasilkan rekomendasi penerima bantuan sosial secara lebih efektif.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="text-danger">
                    <i class="bi bi-diagram-3-fill"></i>
                    Alur Sistem
                </h4>
                <hr>
                
                <div class="row text-center">
                    <div class="col-md-3">
                        <i class="bi bi-person-lines-fill display-5 text-primary"></i>
                        <h6 class="mt-3">
                            Input Data
                        </h6>
                    </div>
                    
                    <div class="col-md-3">
                        <i class="bi bi-list-check display-5 text-success"></i>
                        <h6 class="mt-3">
                            Penilaian
                        </h6>
                    </div>
                    
                    <div class="col-md-3">
                        <i class="bi bi-calculator-fill display-5 text-warning"></i>
                        <h6 class="mt-3">
                            Perhitungan WP
                        </h6>
                    </div>
                    
                    <div class="col-md-3">
                        <i class="bi bi-trophy-fill display-5 text-danger"></i>
                        <h6 class="mt-3">
                            Hasil Ranking
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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