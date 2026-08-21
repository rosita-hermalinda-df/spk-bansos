<?php
include "../config/koneksi.php";

$id=$_GET['id'];

mysqli_query($conn,"
DELETE FROM tb_alternatif
WHERE id_alternatif='$id'
");

echo "<script>
    alert('Data berhasil dihapus');
    window.location='alternatif.php';
</script>";
?>