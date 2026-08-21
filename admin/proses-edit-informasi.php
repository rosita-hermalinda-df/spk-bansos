<?php
include "../config/koneksi.php";

$id = $_POST['id_informasi'];
$judul = mysqli_real_escape_string($conn,$_POST['judul']);
$isi = mysqli_real_escape_string($conn,$_POST['isi']);

$update = mysqli_query($conn,"
UPDATE tb_informasi
SET
judul='$judul',
isi='$isi'
WHERE
id_informasi='$id'
");

if($update){

    echo "
    <script>
        alert('Informasi berhasil diubah!');
        window.location='informasi.php';
    </script>";

}else{

    echo "
    <script>
        alert('Informasi gagal diubah!');
        window.location='informasi.php';
    </script>";

}
?>