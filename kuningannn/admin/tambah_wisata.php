<?php
session_start();
// Mundur satu folder untuk mengambil koneksi.php
include '../koneksi.php';

// Pastikan hanya admin yang bisa akses halaman ini
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

if (isset($_POST['simpan'])) {
    // Ambil dan bersihkan data input
    $nama      = mysqli_real_escape_string($conn, $_POST['nama_wisata']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga     = mysqli_real_escape_string($conn, $_POST['harga_tiket']);
    $alamat    = mysqli_real_escape_string($conn, $_POST['alamat']);
    $fasilitas = mysqli_real_escape_string($conn, $_POST['fasilitas']);
    $maps      = mysqli_real_escape_string($conn, $_POST['link_maps']);

    // Proses Upload Foto
    $foto      = $_FILES['foto']['name'];
    $tmp_name  = $_FILES['foto']['tmp_name'];
    
    // Upload naik satu level ke folder 'gambar' (C:\xampp2\htdocs\kuningan\gambar)
    move_uploaded_file($tmp_name, "../gambar/" . $foto);

    $sql = "INSERT INTO wisata (nama_wisata, deskripsi, harga_tiket, alamat, fasilitas, link_maps, foto) 
            VALUES ('$nama', '$deskripsi', '$harga', '$alamat', '$fasilitas', '$maps', '$foto')";
    
    if (mysqli_query($conn, $sql)) {
        // Gunakan Javascript untuk alert dan redirect agar tidak error 'header already sent'
        echo "<script>
                alert('Data Destinasi Wisata Berhasil Disimpan!');
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
    <title>Tambah Destinasi Wisata - Kuningan Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --blue-main: #3498db;
            --blue-light: #e3f2fd;
            --grey-bg: #f8f9fa;
        }
        body {
            background-color: var(--grey-bg);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            padding-bottom: 50px;
        }
        .form-container {
            max-width: 750px;
            margin: 60px auto;
        }
        .card-custom {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); /* Shadow tipis agar estetik */
            background-color: white;
        }
        .card-header-custom {
            background-color: var(--blue-main);
            color: white;
            padding: 25px;
            border: none;
        }
        .card-header-custom h3 {
            margin: 0;
            font-weight: 700;
        }
        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            background-color: #fafafa;
        }
        .form-control:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.15);
            background-color: white;
        }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            background-color: var(--blue-light);
            border: 1px solid #ddd;
            color: var(--blue-main);
        }
        .input-group > .form-control {
            border-radius: 0 10px 10px 0;
        }
        .btn-simpan {
            background-color: var(--blue-main);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.3s;
        }
        .btn-simpan:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        .btn-batal {
            background-color: #e0e0e0;
            color: #555;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            text-decoration: none;
        }
        .btn-batal:hover {
            background-color: #d5d5d5;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="card card-custom">
        <div class="card-header-custom text-center">
            <h3><i class="bi bi-geo-alt-fill"></i> Tambah Destinasi Wisata</h3>
            <p class="mb-0 opacity-75">Masukkan data lengkap untuk mempromosikan pariwisata Kuningan</p>
        </div>
        <div class="card-body p-5">
            <form action="" method="POST" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label for="nama_wisata" class="form-label"><i class="bi bi-tag text-primary me-2"></i> Nama Wisata</label>
                    <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" placeholder="Contoh: Telaga Biru Cicerem" required>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label"><i class="bi bi-text-left text-primary me-2"></i> Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan daya tarik, keindahan, dan informasi menarik lainnya..." required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="harga_tiket" class="form-label"><i class="bi bi-cash-stack text-primary me-2"></i> Harga Tiket</label>
                        <div class="input-group">
                            <span class="input-group-text fw-bold">Rp</span>
                            <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" placeholder="Contoh: 15.000 (per orang)" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="foto" class="form-label"><i class="bi bi-camera text-primary me-2"></i> Foto Destinasi</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                        <div class="form-text text-muted small">Disarankan gambar landscape (16:9). Max 2MB.</div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="alamat" class="form-label"><i class="bi bi-map text-primary me-2"></i> Alamat Lengkap</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Nama desa, kecamatan, atau patokan lokasi" required>
                </div>

                <div class="mb-4">
                    <label for="fasilitas" class="form-label"><i class="bi bi-building text-primary me-2"></i> Fasilitas</label>
                    <input type="text" class="form-control" id="fasilitas" name="fasilitas" placeholder="Contoh: Parkir, Toilet, Mushola, Gazebo" required>
                </div>

                <div class="mb-5">
                    <label for="link_maps" class="form-label"><i class="bi bi-google text-primary me-2"></i> Link Google Maps</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                        <input type="url" class="form-control" id="link_maps" name="link_maps" placeholder="https://goo.gl/maps/..." required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                    <a href="dashboard_admin.php" class="btn-batal"><i class="bi bi-arrow-left me-2"></i> Batal</a>
                    <button type="submit" name="simpan" class="btn-simpan"><i class="bi bi-check-lg me-2"></i> Simpan Data</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>