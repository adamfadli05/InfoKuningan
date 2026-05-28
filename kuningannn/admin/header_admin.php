<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f1f3f5; }
        .sidebar { 
            background: #2c3e50; /* Warna Navy Gelap agar beda dengan Index */
            min-height: 100vh; 
            color: white; 
        }
        .nav-link { color: #bdc3c7; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: #34495e; border-radius: 8px; }
        .main-content { padding: 30px; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-4">
            <h5 class="fw-bold mb-4 text-center">ADMIN PANEL</h5>
            <nav class="nav flex-column">
                <a class="nav-link active mb-2" href="dashboard_admin.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a class="nav-link mb-2" href="tambah_wisata.php"><i class="bi bi-plus-circle"></i> Tambah Wisata</a>
                <a class="nav-link mb-2" href="tambah_kuliner.php"><i class="bi bi-plus-circle"></i> Tambah Kuliner</a>
                <hr>
                <a class="nav-link text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Keluar</a>
            </nav>
        </div>
        <div class="col-md-10 main-content">