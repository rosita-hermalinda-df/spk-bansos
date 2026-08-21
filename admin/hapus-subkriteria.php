<?php

include "../config/koneksi.php";

$id = $_GET['id'];

$hapus = mysqli_query($conn,
"DELETE FROM tb_subkriteria 
WHERE id_subkriteria='$id'");


if($hapus){
    echo "
    <script>
    alert('Sub kriteria berhasil dihapus');
    window.location='javascript:history.back()';
    </script>
    ";
}else{
    echo "
    <script>
    alert('Gagal menghapus data');
    window.history.back();
    </script>
    ";
}

?>