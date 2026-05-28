<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) { header("Location: login_admin.php"); exit; }

// Ambil ID dan Tipe (Wisata/Kuliner) dari URL
$id   = $_GET['id'];
$type = $_GET['type'];

if ($type == 'wisata') {
    $query = "DELETE FROM wisata WHERE id_wisata = $id";
} else {
    $query = "DELETE FROM kuliner WHERE id_kuliner = $id";
}

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data Berhasil Dihapus!'); window.location='dashboard_admin.php';</script>";
} else {
    echo "Gagal menghapus: " . mysqli_error($conn);
}
?>