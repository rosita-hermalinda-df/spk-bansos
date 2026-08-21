<?php
session_start();
include "../config/koneksi.php";

if (!$conn) {
    die("Koneksi database gagal!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['pesan'] = "Username dan password tidak boleh kosong!";
        header("Location: login.php");
        exit;
    }

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id_user, username, password, role
            FROM tb_user
            WHERE username='$username'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query Error : " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // CEK ROLE
            if ($user['role'] == "Admin") {

                header("Location: ../admin/dashboard.php");

            } elseif ($user['role'] == "Kepala Desa") {

                header("Location: ../kepaladesa/dashboard.php");

            } else {

                session_destroy();
                $_SESSION['pesan'] = "Role tidak dikenali!";
                header("Location: login.php");

            }

            exit;

        } else {

            $_SESSION['pesan'] = "Password salah!";
        }

    } else {

        $_SESSION['pesan'] = "Username tidak ditemukan!";

    }

    header("Location: login.php");
    exit;
}

header("Location: login.php");
exit;
?>