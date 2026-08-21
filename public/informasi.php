<?php
include "../config/koneksi.php";

$currentPage = basename($_SERVER['PHP_SELF']);

$data = mysqli_query($conn,"
SELECT
    i.*,
    u.username
FROM tb_informasi i
LEFT JOIN tb_user u
ON i.id_user = u.id_user
ORDER BY i.tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Informasi | SPK Bansos</title>

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
            background:linear-gradient(135deg,#0d6efd,#4dabf7);
            color:white;
            padding:70px 0;
        }

        .card{
            border:none;
            border-radius:15px;
            transition:.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .card-title{
            font-weight:600;
        }

        .nav-link{
            color:#555 !important;
            font-weight:500;
            transition:.3s;
        }

        .nav-link:hover{
            color:#0d6efd !important;
        }

        .nav-link.active{
            color:#0d6efd !important;
            font-weight:700;
            border-bottom:3px solid #0d6efd;
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

        <div class="collapse navbar-collapse"
            id="menu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">

                    <a class="nav-link <?= ($currentPage=='index.php') ? 'active' : ''; ?>"
                        href="index.php">

                        Beranda

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link <?= ($currentPage=='tentang.php') ? 'active' : ''; ?>"
                        href="tentang.php">

                        Tentang

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link <?= ($currentPage=='informasi.php') ? 'active' : ''; ?>"
                        href="informasi.php">

                        Informasi

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link <?= ($currentPage=='hasil.php') ? 'active' : ''; ?>"
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

            <i class="bi bi-megaphone-fill"></i>

            Informasi Desa

        </h2>

        <p>

            Informasi dan pengumuman terbaru mengenai
            bantuan sosial di Desa Semampirejo.

        </p>

    </div>

</section>

<div class="container my-5">

    <div class="row">
        <?php if(mysqli_num_rows($data) > 0){ ?>

    <?php while($row = mysqli_fetch_assoc($data)){ ?>

        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">

                        <i class="bi bi-calendar-event"></i>

                        <?= date('d F Y', strtotime($row['tanggal'])); ?>

                    </small>

                    <h4 class="card-title mt-3">

                        <?= htmlspecialchars($row['judul']); ?>

                    </h4>

                    <p class="text-secondary">

                        <?= substr(strip_tags($row['isi']),0,180); ?>

                        <?= strlen(strip_tags($row['isi'])) > 180 ? '...' : ''; ?>

                    </p>

                    <div class="d-flex justify-content-between align-items-center mt-4">

                        <small class="text-muted">

                            <i class="bi bi-person-circle"></i>

                            <?= htmlspecialchars($row['username']); ?>

                        </small>

                        <a
                            href="detail-informasi.php?id=<?= $row['id_informasi']; ?>"
                            class="btn btn-primary btn-sm">

                            <i class="bi bi-book"></i>

                            Baca Selengkapnya

                        </a>

                    </div>

                </div>

            </div>

        </div>

    <?php } ?>

<?php }else{ ?>

<div class="col-12">

    <div class="alert alert-warning text-center">

        <i class="bi bi-exclamation-circle-fill"></i>

        Belum ada informasi yang dipublikasikan.

    </div>

</div>

<?php } ?>

    </div>

</div>

<footer>

    <div class="container text-center">

        © <?= date('Y'); ?>

        Sistem Pendukung Keputusan Penentuan Penerima Bantuan Sosial

        <br>

        Desa Semampirejo

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>