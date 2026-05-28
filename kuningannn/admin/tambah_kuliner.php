<?php
session_start();
include '../koneksi.php';

// Proteksi Halaman Admin
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $nama          = mysqli_real_escape_string($conn, $_POST['nama_kuliner']);
    $deskripsi     = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $menu_andalan  = mysqli_real_escape_string($conn, $_POST['menu_andalan']);
    $range_harga   = mysqli_real_escape_string($conn, $_POST['range_harga']);
    $lokasi        = mysqli_real_escape_string($conn, $_POST['lokasi']); // Sesuaikan kolom DB: lokasi
    $link_maps     = mysqli_real_escape_string($conn, $_POST['link_maps']);

    // Proses Upload Foto
    $foto      = $_FILES['foto']['name'];
    $tmp_name  = $_FILES['foto']['tmp_name'];
    
    // Pastikan folder ../gambar/ sudah ada
    move_uploaded_file($tmp_name, "../gambar/" . $foto);

    // Query INSERT sesuai struktur tabel kuliner kamu
    $sql = "INSERT INTO kuliner (nama_kuliner, deskripsi, menu_andalan, range_harga, lokasi, link_maps, foto) 
            VALUES ('$nama', '$deskripsi', '$menu_andalan', '$range_harga', '$lokasi', '$link_maps', '$foto')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data Kuliner Berhasil Disimpan!');
                window.location.href = 'dashboard_admin.php'; 
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kuliner - Kuningan Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --green-main: #27ae60;
            --grey-bg: #f8f9fa;
        }
        body {
            background-color: var(--grey-bg);
            font-family: 'Segoe UI', sans-serif;
            padding-bottom: 50px;
        }
        .form-container {
            max-width: 750px;
            margin: 60px auto;
        }
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background-color: white;
            overflow: hidden;
        }
        .card-header-custom {
            background-color: var(--green-main);
            color: white;
            padding: 25px;
        }
        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            background-color: #fafafa;
        }
        .form-control:focus {
            border-color: var(--green-main);
            box-shadow: 0 0 0 0.25rem rgba(39, 174, 96, 0.15);
        }
        .btn-simpan {
            background-color: var(--green-main);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-simpan:hover {
            background-color: #219150;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }
        .btn-batal {
            background-color: #e0e0e0;
            color: #555;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="card card-custom">
        <div class="card-header-custom text-center">
            <h3><i class="bi bi-egg-fried"></i> Tambah Data Kuliner</h3>
            <p class="mb-0 opacity-75">Lengkapi data kuliner khas Kuningan</p>
        </div>
        <div class="card-body p-5">
            <form action="" method="POST" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-shop text-success me-2"></i> Nama Kuliner / Tempat</label>
                    <input type="text" name="nama_kuliner" class="form-control" placeholder="Contoh: Nasi Kasreng Luragung" required>
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-card-text text-success me-2"></i> Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan keunikan rasanya..." required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><i class="bi bi-star-fill text-success me-2"></i> Menu Andalan</label>
                        <input type="text" name="menu_andalan" class="form-control" placeholder="Contoh: Sambal Dadak" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><i class="bi bi-currency-dollar text-success me-2"></i> Range Harga</label>
                        <input type="text" name="range_harga" class="form-control" placeholder="Contoh: 10rb - 50rb" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><i class="bi bi-geo-alt text-success me-2"></i> Lokasi (Alamat)</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Kecamatan atau Nama Jalan" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><i class="bi bi-camera text-success me-2"></i> Foto Kuliner</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label"><i class="bi bi-google text-success me-2"></i> Link Google Maps</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-link-45deg"></i></span>
                        <input type="url" name="link_maps" class="form-control" placeholder="Paste link Google Maps di sini">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                    <a href="dashboard_admin.php" class="btn-batal"><i class="bi bi-arrow-left me-2"></i> Batal</a>
                    <button type="submit" name="simpan" class="btn-simpan"><i class="bi bi-check-lg me-2"></i> Simpan Kuliner</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>