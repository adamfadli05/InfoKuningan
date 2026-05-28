<?php
ob_start(); // Mencegah error 'header already sent'
session_start();
include '../koneksi.php';

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['admin'] = $data['username'];
        $_SESSION['nama']  = $data['nama_lengkap'];
        
        // Pindah halaman pakai PHP Header (Lebih kuat dari Javascript)
        header("Location: dashboard_admin.php");
        exit(); 
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f4f7f6;">
<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <h3 class="text-center fw-bold mb-4 text-primary">ADMIN LOGIN</h3>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger small"><?= $error; ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="small">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="small">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100 py-2">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>