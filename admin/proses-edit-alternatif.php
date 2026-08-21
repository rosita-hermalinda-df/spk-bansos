<?php

include "../config/koneksi.php";

if(isset($_POST['update'])){

    $id = $_POST['id_alternatif'];
    $nama = mysqli_real_escape_string($conn,$_POST['nama_penerima']);

    mysqli_query($conn,"
        UPDATE tb_alternatif
        SET nama_penerima='$nama'
        WHERE id_alternatif='$id'
    ");

    header("Location: alternatif.php");
    exit;
}