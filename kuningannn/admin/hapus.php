<?php
session_start();
include '../koneksi.php';

// Pastikan hanya admin yang bisa menghapus
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Cek apakah ada ID dan Tipe yang dikirim melalui URL
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id   = mysqli_real_escape_string($conn, $_GET['id']);
    $type = $_GET['type'];

    if ($type == 'wisata') {
        // Hapus dari tabel wisata
        $query = "DELETE FROM wisata WHERE id_wisata = '$id'";
    } elseif ($type == 'kuliner') {
        // Hapus dari tabel kuliner
        $query = "DELETE FROM kuliner WHERE id_kuliner = '$id'";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data Berhasil Dihapus!');
                window.location.href = 'dashboard_admin.php';
              </script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    // Jika tidak ada ID atau Type, balikkan ke dashboard
    header("Location: dashboard_admin.php");
}
?>