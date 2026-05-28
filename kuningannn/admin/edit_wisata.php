<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) { header("Location: login_admin.php"); exit; }

// Ambil data lama berdasarkan ID yang dikirim dari dashboard
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM wisata WHERE id_wisata = '$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama      = mysqli_real_escape_string($conn, $_POST['nama_wisata']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga     = mysqli_real_escape_string($conn, $_POST['harga_tiket']);
    $alamat    = mysqli_real_escape_string($conn, $_POST['alamat']);
    $fasilitas = mysqli_real_escape_string($conn, $_POST['fasilitas']);
    $maps      = mysqli_real_escape_string($conn, $_POST['link_maps']);

    // Logika Ganti Foto
    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../gambar/" . $foto);
    } else {
        // Jika tidak upload foto baru, pakai nama foto yang lama
        $foto = $_POST['foto_lama'];
    }

    $sql = "UPDATE wisata SET 
            nama_wisata='$nama', 
            deskripsi='$deskripsi', 
            harga_tiket='$harga', 
            alamat='$alamat', 
            fasilitas='$fasilitas', 
            link_maps='$maps', 
            foto='$foto' 
            WHERE id_wisata='$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Wisata Berhasil Diperbarui!'); window.location='dashboard_admin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Wisata - Kuningan Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; padding-bottom: 50px; }
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .card-header-custom { background-color: #3498db; color: white; border-radius: 20px 20px 0 0; padding: 25px; }
    </style>
</head>
<body>
<div class="container mt-5" style="max-width: 750px;">
    <div class="card card-custom">
        <div class="card-header-custom text-center">
            <h3><i class="bi bi-pencil-square"></i> Edit Destinasi Wisata</h3>
        </div>
        <div class="card-body p-5">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Nama Wisata</label>
                    <input type="text" name="nama_wisata" class="form-control" value="<?= $data['nama_wisata']; ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold text-secondary">Harga Tiket</label>
                        <input type="text" name="harga_tiket" class="form-control" value="<?= $data['harga_tiket']; ?>">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold text-secondary">Foto Baru (Opsional)</label>
                        <input type="file" name="foto" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin ganti foto</small>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Foto Saat Ini</label><br>
                    <img src="../gambar/<?= $data['foto']; ?>" width="150" class="rounded shadow-sm border">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"><?= $data['deskripsi']; ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?= $data['alamat']; ?>">
                </div>

                <div class="mb-5">
                    <label class="form-label fw-bold text-secondary">Link Google Maps</label>
                    <input type="url" name="link_maps" class="form-control" value="<?= $data['link_maps']; ?>">
                </div>

                <div class="d-flex justify-content-between pt-4 border-top">
                    <a href="dashboard_admin.php" class="btn btn-light px-4 rounded-pill">Batal</a>
                    <button type="submit" name="update" class="btn btn-primary px-5 rounded-pill fw-bold shadow">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>