<?php
include "../config/koneksi.php";

$id = $_GET['id'];

$hapus = mysqli_query($conn,"
DELETE FROM tb_informasi
WHERE id_informasi='$id'
");

if($hapus){

    echo "
    <script>
        alert('Informasi berhasil dihapus!');
        window.location='informasi.php';
    </script>";

}else{

    echo "
    <script>
        alert('Informasi gagal dihapus!');
        window.location='informasi.php';
    </script>";

}
?>