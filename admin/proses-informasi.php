<?php
session_start();
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal = date('Y-m-d');
    $id_user = $_SESSION['id_user'];

    $simpan = mysqli_query($conn,"
        INSERT INTO tb_informasi
        (
            judul,
            isi,
            tanggal,
            id_user
        )
        VALUES
        (
            '$judul',
            '$isi',
            '$tanggal',
            '$id_user'
        )
    ");

    if($simpan){

        echo "
        <script>
            alert('Informasi berhasil ditambahkan!');
            window.location='informasi.php';
        </script>";

    }else{

        echo "
        <script>
            alert('Gagal menambahkan informasi!');
            window.location='informasi.php';
        </script>";

    }

}else{

    header("Location: informasi.php");

}
?>