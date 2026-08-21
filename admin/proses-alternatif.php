<?php

session_start();
include "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $nama = trim($_POST['nama_penerima']);
    $id_user = (int) $_SESSION['id_user'];


    /* =========================================
       VALIDASI
    ========================================= */

    if ($nama === '') {

        echo "<script>
            alert('Nama penerima wajib diisi.');
            window.location='alternatif.php';
        </script>";

        exit;
    }


    /* =========================================
       INSERT DATA
    ========================================= */

    $stmt = mysqli_prepare($conn, "
        INSERT INTO tb_alternatif
        (
            nama_penerima,
            id_user
        )
        VALUES
        (?, ?)
    ");


    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $nama,
        $id_user
    );


    /* =========================================
       EKSEKUSI
    ========================================= */

    if (mysqli_stmt_execute($stmt)) {

        echo "<script>
            alert('Data berhasil disimpan.');
            window.location='alternatif.php';
        </script>";

    } else {

        echo "<script>
            alert('Data gagal disimpan.');
            window.location='alternatif.php';
        </script>";

    }


    mysqli_stmt_close($stmt);

}

?>