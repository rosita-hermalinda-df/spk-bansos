<?php

include "../includes/session.php";
include "../config/koneksi.php";

if(isset($_POST['simpan'])){

    $id_alternatif = $_POST['id_alternatif'];
    $id_user = $_SESSION['id_user'];

    if(isset($_POST['subkriteria'])){

        foreach($_POST['subkriteria'] as $id_kriteria => $id_subkriteria){

            // cek apakah penilaian sudah ada
            $cek = mysqli_query($conn,"
                SELECT id_penilaian
                FROM tb_penilaian
                WHERE id_alternatif='$id_alternatif'
                AND id_kriteria='$id_kriteria'
            ");

            if(mysqli_num_rows($cek) > 0){

                $data = mysqli_fetch_assoc($cek);

                mysqli_query($conn,"
                    UPDATE tb_penilaian
                    SET
                        id_subkriteria='$id_subkriteria',
                        id_user='$id_user'
                    WHERE id_penilaian='".$data['id_penilaian']."'
                ");

            }else{

                mysqli_query($conn,"
                    INSERT INTO tb_penilaian
                    (
                        id_alternatif,
                        id_kriteria,
                        id_subkriteria,
                        id_user
                    )
                    VALUES
                    (
                        '$id_alternatif',
                        '$id_kriteria',
                        '$id_subkriteria',
                        '$id_user'
                    )
                ");

            }

        }

    }

    header("Location: penilaian.php");
    exit;
}
?>