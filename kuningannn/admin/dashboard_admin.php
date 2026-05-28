<?php
session_start();
include '../koneksi.php';

// Proteksi Halaman: Jika belum login, tendang ke halaman login
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kuningan Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root { --navy: #2c3e50; --light-bg: #f4f7f6; }
        body { background-color: var(--light-bg); font-family: 'Segoe UI', sans-serif; }
        
        /* Sidebar Styling */
        .sidebar { background: var(--navy); min-height: 100vh; color: white; padding: 20px; position: fixed; width: inherit; }
        .nav-link { color: #bdc3c7; border-radius: 10px; margin-bottom: 8px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: #34495e; }
        
        /* Content Styling */
        .main-content { margin-left: 16.66667%; padding: 40px; } /* Offset for col-md-2 */
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .table img { border-radius: 8px; object-fit: cover; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 p-0 shadow">
            <div class="sidebar">
                <h4 class="fw-bold text-center mb-4 mt-2 text-info">ADMIN HUB</h4>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="dashboard_admin.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                    <a class="nav-link" href="tambah_wisata.php"><i class="bi bi-tree me-2"></i> Tambah Wisata</a>
                    <a class="nav-link" href="tambah_kuliner.php"><i class="bi bi-egg-fried me-2"></i> Tambah Kuliner</a>
                    <hr class="text-secondary">
                    <a class="nav-link" href="../index.php" target="_blank"><i class="bi bi-eye me-2"></i> Lihat Web</a>
                    <a class="nav-link text-danger mt-5" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                </nav>
            </div>
        </div>

        <div class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-secondary">Manajemen Data</h2>
                <span class="badge bg-primary px-3 py-2">Login sebagai: <?= $_SESSION['nama']; ?></span>
            </div>

            <div class="card mb-5">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="fw-bold m-0 text-primary"><i class="bi bi-map me-2"></i> Daftar Wisata</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Foto</th>
                                <th>Nama Destinasi</th>
                                <th>Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res_w = mysqli_query($conn, "SELECT * FROM wisata");
                            while($w = mysqli_fetch_assoc($res_w)) { ?>
                            <tr>
                                <td><img src="../gambar/<?= $w['foto']; ?>" width="70" height="50"></td>
                                <td class="fw-bold"><?= $w['nama_wisata']; ?></td>
                                <td><?= $w['harga_tiket']; ?></td>
                                <td class="text-center">
                                    <a href="edit_wisata.php?id=<?= $w['id_wisata']; ?>" class="btn btn-warning btn-sm shadow-sm"><i class="bi bi-pencil"></i> Edit</a>
                                    <a href="hapus.php?id=<?= $w['id_wisata']; ?>&type=wisata" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="fw-bold m-0 text-success"><i class="bi bi-potted-plant me-2"></i> Daftar Kuliner</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Foto</th>
                                <th>Nama Kuliner</th>
                                <th>Range Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res_k = mysqli_query($conn, "SELECT * FROM kuliner");
                            while($k = mysqli_fetch_assoc($res_k)) { ?>
                            <tr>
                                <td><img src="../gambar/<?= $k['foto']; ?>" width="70" height="50"></td>
                                <td class="fw-bold"><?= $k['nama_kuliner']; ?></td>
                                <td><?= $k['range_harga']; ?></td>
                                <td class="text-center">
                                    <a href="edit_kuliner.php?id=<?= $k['id_kuliner']; ?>" class="btn btn-warning btn-sm shadow-sm"><i class="bi bi-pencil"></i> Edit</a>
                                    <a href="hapus.php?id=<?= $k['id_kuliner']; ?>&type=kuliner" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>