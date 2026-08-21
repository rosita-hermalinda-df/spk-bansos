<?php
include "../config/koneksi.php";

$currentPage = "informasi.php";

if(!isset($_GET['id'])){
    header("Location: informasi.php");
    exit;
}

$id = (int)$_GET['id'];

$query = mysqli_query($conn,"
SELECT
    i.*,
    u.username
FROM tb_informasi i
LEFT JOIN tb_user u
ON i.id_user=u.id_user
WHERE i.id_informasi='$id'
");

if(mysqli_num_rows($query)==0){
    header("Location: informasi.php");
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title><?= htmlspecialchars($data['judul']); ?></title>

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
    padding:60px 0;
}

.nav-link{
    color:#555!important;
    font-weight:500;
}

.nav-link.active{
    color:#0d6efd!important;
    font-weight:700;
    border-bottom:3px solid #0d6efd;
}

.card{
    border:none;
    border-radius:15px;
}

footer{
    margin-top:60px;
    background:#0d6efd;
    color:white;
    padding:20px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg bg-white">

<div class="container">

<a class="navbar-brand d-flex align-items-center"
href="index.php">

<img src="../assets/img/logo.png"
style="height:45px; width:auto;">

<div class="lh-1">

<span class="fw-bold fs-5">

SPK BANSOS

</span>

<small
class="d-block text-secondary"
style="font-size:10px;">

Desa Semampirejo

</small>

</div>

</a>

<button
class="navbar-toggler"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div
class="collapse navbar-collapse"
id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<a class="nav-link"
href="index.php">

Beranda

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="tentang.php">

Tentang

</a>

</li>

<li class="nav-item">

<a class="nav-link active"
href="informasi.php">

Informasi

</a>

</li>

<li class="nav-item">

<a class="nav-link"
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

<h2 class="fw-bold">

<?= htmlspecialchars($data['judul']); ?>

</h2>

<p class="mb-0">

<i class="bi bi-calendar-event"></i>

<?= date('d F Y',strtotime($data['tanggal'])); ?>

&nbsp;&nbsp;

<i class="bi bi-person-circle"></i>

<?= htmlspecialchars($data['username']); ?>

</p>

</div>

</section>

<div class="container my-5">

<div class="card shadow-sm">

<div class="card-body p-4">
    <div class="mb-4">

    <p class="text-justify" style="line-height:1.9; text-align:justify;">

        <?= nl2br(htmlspecialchars($data['isi'])); ?>

    </p>

</div>

<hr>

<div class="d-flex justify-content-between align-items-center">

    <small class="text-muted">

        <i class="bi bi-calendar-check"></i>

        Dipublikasikan pada

        <strong>

            <?= date('d F Y', strtotime($data['tanggal'])); ?>

        </strong>

    </small>

    <a href="informasi.php"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>

</div>

</div>

</div>

<footer>

    <div class="container text-center">

        <div class="mb-2">

            <strong>

                Sistem Pendukung Keputusan Penentuan Penerima Bantuan Sosial

            </strong>

        </div>

        Desa Semampirejo

        <br>

        © <?= date('Y'); ?> All Rights Reserved.

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>