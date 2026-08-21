<?php
include "../config/koneksi.php";

    $id=$_GET['id'];
    $query=mysqli_query($conn,
        "DELETE FROM tb_kriteria 
        WHERE id_kriteria='$id'");

    if($query){
        echo "
            <script>
                alert('Data berhasil dihapus');
                window.location='kriteria.php';
            </script>";
    }
?>