<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) { header("Location: login_admin.php"); exit; }

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kuliner WHERE id_kuliner = '$id'"));

if (isset($_POST['update'])) {
    $nama         = mysqli_real_escape_string($conn, $_POST['nama_kuliner']);
    $deskripsi    = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $menu_andalan = mysqli_real_escape_string($conn, $_POST['menu_andalan']);
    $range_harga  = mysqli_real_escape_string($conn, $_POST['range_harga']);
    $alamat       = mysqli_real_escape_string($conn, $_POST['alamat']);

    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../gambar/" . $foto);
    } else {
        $foto = $_POST['foto_lama'];
    }

    $sql = "UPDATE kuliner SET 
            nama_kuliner='$nama', deskripsi='$deskripsi', 
            menu_andalan='$menu_andalan', range_harga='$range_harga', 
            alamat='$alamat', foto='$foto' 
            WHERE id_kuliner='$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Kuliner Berhasil Diperbarui!'); window.location='dashboard_admin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Kuliner - Kuningan Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; padding-bottom: 50px; }
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .card-header-custom { background-color: #27ae60; color: white; border-radius: 20px 20px 0 0; padding: 25px; }
    </style>
</head>
<body>
<div class="container mt-5" style="max-width: 750px;">
    <div class="card card-custom">
        <div class="card-header-custom text-center">
            <h3><i class="bi bi-pencil-square"></i> Edit Data Kuliner</h3>
        </div>
        <div class="card-body p-5">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Nama Kuliner / Tempat</label>
                    <input type="text" name="nama_kuliner" class="form-control" value="<?= $data['nama_kuliner']; ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold text-secondary">Menu Andalan</label>
                        <input type="text" name="menu_andalan" class="form-control" value="<?= $data['menu_andalan']; ?>">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold text-secondary">Range Harga</label>
                        <input type="text" name="range_harga" class="form-control" value="<?= $data['range_harga']; ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4 text-center">
                        <label class="form-label d-block fw-bold text-secondary">Foto Saat Ini</label>
                        <img src="../gambar/<?= $data['foto']; ?>" width="150" class="rounded shadow-sm border mb-2">
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"><?= $data['deskripsi']; ?></textarea>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-bold text-secondary">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?= $data['alamat']; ?>">
                </div>

                <div class="d-flex justify-content-between pt-4 border-top">
                    <a href="dashboard_admin.php" class="btn btn-light px-4 rounded-pill">Batal</a>
                    <button type="submit" name="update" class="btn btn-success px-5 rounded-pill fw-bold shadow">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>