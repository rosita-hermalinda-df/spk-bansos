<?php

session_start();

include "../config/koneksi.php";


if(isset($_POST['update'])){


    $id_subkriteria = $_POST['id_subkriteria'];
    $id_kriteria = $_POST['id_kriteria'];

    $nama = $_POST['nama_subkriteria'];
    $nilai = $_POST['nilai'];



    $query = mysqli_query($conn,

    "UPDATE tb_subkriteria SET

        nama_subkriteria='$nama',
        nilai='$nilai'

    WHERE id_subkriteria='$id_subkriteria'

    ");



    if($query){

        echo "
        <script>
        alert('Sub kriteria berhasil diubah');
        window.location='subkriteria.php?id=$id_kriteria';
        </script>
        ";

    }else{


        echo "
        <script>
        alert('Sub kriteria gagal diubah');
        window.location='subkriteria.php?id=$id_kriteria';
        </script>
        ";

    }


}


?>