<?php
session_start();
include "../config/koneksi.php";

if(isset($_POST['simpan'])){

    $kode     = $_POST['kode_kriteria'];
    $nama     = $_POST['nama_kriteria'];
    $bobot    = $_POST['bobot'];
    $jenis    = $_POST['jenis'];
    $id_user  = $_SESSION['id_user'];

    $query = mysqli_query($conn,"
        INSERT INTO tb_kriteria
        (kode_kriteria,nama_kriteria,bobot,jenis,id_user)
        VALUES
        ('$kode','$nama','$bobot','$jenis','$id_user')
    ");

    if($query){
        echo "<script>
                alert('Data kriteria berhasil ditambahkan');
                window.location='kriteria.php';
              </script>";
    }else{
        echo "<script>
                alert('Data gagal ditambahkan');
                window.location='kriteria.php';
              </script>";
    }
}
?>