<?php
include "../includes/session.php";
include "../config/koneksi.php";

if(isset($_POST['simpan'])){

    $id_kriteria = mysqli_real_escape_string($conn, $_POST['id_kriteria']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_subkriteria']);
    $nilai = mysqli_real_escape_string($conn, $_POST['nilai']);
    $id_user = $_SESSION['id_user'];

    mysqli_query($conn,"
        INSERT INTO tb_subkriteria
        (id_kriteria, nama_subkriteria, nilai, id_user)
        VALUES
        ('$id_kriteria', '$nama', '$nilai', '$id_user')
    ") or die(mysqli_error($conn));

    header("Location: subkriteria.php?id=$id_kriteria");
    exit;
}

if(isset($_POST['update'])){

    $id_sub = mysqli_real_escape_string($conn, $_POST['id_subkriteria']);
    $id_kriteria = mysqli_real_escape_string($conn, $_POST['id_kriteria']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_subkriteria']);
    $nilai = mysqli_real_escape_string($conn, $_POST['nilai']);

    mysqli_query($conn,"
        UPDATE tb_subkriteria
        SET
            nama_subkriteria='$nama',
            nilai='$nilai'
        WHERE id_subkriteria='$id_sub'
    ") or die(mysqli_error($conn));

    header("Location: subkriteria.php?id=$id_kriteria");
    exit;
}
?>