<?php
include_once 'session.php';
?>

<nav class="navbar navbar-expand-lg bg-white shadow-sm top-navbar">
    <div class="w-100 d-flex align-items-center px-3">

        <!-- Tombol Toggle Sidebar -->
        <button class="btn btn-primary me-3" id="toggleSidebar" type="button">
            <i class="bi bi-list fs-5"></i>
        </button>

        <!-- Judul -->
        <span class="navbar-brand fw-bold mb-0">
            Sistem Pendukung Keputusan
        </span>

        <!-- User -->
        <div class="ms-auto d-flex align-items-center me-4">

            <span class="me-3 text-dark">
                <i class="bi bi-person-circle me-1"></i>
                <?= htmlspecialchars($_SESSION['username']); ?>
            </span>

            <span class="badge bg-primary">
                <?= htmlspecialchars($_SESSION['role']); ?>
            </span>

        </div>

    </div>

</nav>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const sidebar = document.getElementById("sidebar");
const navbar = document.querySelector(".top-navbar");
const content = document.querySelector(".content");
const footer = document.querySelector(".footer-admin");
const toggle = document.getElementById("toggleSidebar");

toggle.addEventListener("click", function () {

    sidebar.classList.toggle("hide");
    navbar.classList.toggle("full");

    if(content){
        content.classList.toggle("full");
    }

    if(footer){
        footer.classList.toggle("full");
    }

});

});
</script>