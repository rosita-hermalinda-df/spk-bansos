<?php
include "../config/koneksi.php";

if(isset($_POST['update'])){

    $id     = $_POST['id_kriteria'];
    $kode   = $_POST['kode_kriteria'];
    $nama   = $_POST['nama_kriteria'];
    $bobot  = $_POST['bobot'];
    $jenis  = $_POST['jenis'];

    $query = mysqli_query($conn,"
        UPDATE tb_kriteria
        SET
            kode_kriteria = '$kode',
            nama_kriteria = '$nama',
            bobot = '$bobot',
            jenis = '$jenis'
        WHERE id_kriteria = '$id'
    ");

    if($query){
        echo "<script>
                alert('Data berhasil diubah');
                window.location='kriteria.php';
              </script>";
    }else{
        echo "<script>
                alert('Data gagal diubah');
                window.location='kriteria.php';
              </script>";
    }

}
?>