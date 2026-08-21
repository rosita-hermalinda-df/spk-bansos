<?php
session_start();

if(isset($_SESSION['login'])){
    header("Location: ../admin/dashboard.php");
    exit;
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | SPK Bansos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background:#f5f7fb;
        }

        .login-card{
            border:none;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-4">
                <div class="card login-card">
                    <div class="card-body p-4">

                        <h3 class="text-center fw-bold mb-1">SPK BANSOS</h3>
                        <p class="text-center text-muted mb-4">Silakan login</p>
                        <form action="proses_login.php" method="POST">

                            <div class="mb-3">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            
                            <div class="mb-4">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button class="btn btn-primary w-100">
                                <i class="bi bi-box-arrow-in-right"></i>
                                    Login
                            </button>
                        
                        </form>
                    
                    </div>
    
                </div>
    
            </div>
    
        </div>
    </div>
</body>
</html>