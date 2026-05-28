<?php 
include 'koneksi.php'; 
include 'header.php'; 

$id   = $_GET['id'];
$type = $_GET['type'];

if ($type == 'wisata') {
    $res = mysqli_query($conn, "SELECT * FROM wisata WHERE id_wisata = '$id'");
    $d   = mysqli_fetch_assoc($res);
    $nama = $d['nama_wisata'];
    $sub  = "Harga Tiket: " . $d['harga_tiket'];
    $info_label = "Fasilitas Utama";
    $info_val   = $d['fasilitas'];
    $lokasi     = $d['alamat'];
    $warna      = "primary";
} else {
    $res = mysqli_query($conn, "SELECT * FROM kuliner WHERE id_kuliner = '$id'");
    $d   = mysqli_fetch_assoc($res);
    $nama = $d['nama_kuliner'];
    $sub  = "Range Harga: " . $d['range_harga'];
    $info_label = "Menu Andalan";
    $info_val   = $d['menu_andalan'];
    $lokasi     = $d['lokasi'];
    $warna      = "success";
}
?>

<div class="container my-5 pt-5">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active text-capitalize"><?= $type; ?></li>
      </ol>
    </nav>

    <div class="row g-5 mt-2">
        <div class="col-md-6">
            <div class="shadow-sm overflow-hidden" style="border-radius: 30px;">
                <img src="gambar/<?= $d['foto']; ?>" class="w-100 shadow" style="height: 450px; object-fit: cover;">
            </div>
        </div>

        <div class="col-md-6">
            <span class="badge bg-<?= $warna; ?> mb-3 px-3 py-2 rounded-pill">Detail <?= $type; ?></span>
            <h1 class="fw-bold display-5 mb-3"><?= $nama; ?></h1>
            <h4 class="text-<?= $warna; ?> fw-bold mb-4"><?= $sub; ?></h4>
            
            <div class="card border-0 bg-light p-4 mb-4" style="border-radius: 20px;">
                <h6 class="fw-bold text-secondary mb-2"><i class="bi bi-info-circle-fill"></i> <?= $info_label; ?></h6>
                <p class="mb-0 text-dark"><?= $info_val; ?></p>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-secondary mb-2"><i class="bi bi-card-text"></i> Deskripsi</h6>
                <p class="text-muted lead" style="font-size: 1rem; line-height: 1.8;"><?= $d['deskripsi']; ?></p>
            </div>

            <div class="mb-5">
                <h6 class="fw-bold text-secondary mb-2"><i class="bi bi-geo-alt-fill"></i> Lokasi</h6>
                <p class="text-muted"><?= $lokasi; ?></p>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="<?= $d['link_maps']; ?>" target="_blank" class="btn btn-<?= $warna; ?> btn-lg px-5 rounded-pill shadow fw-bold">
                    <i class="bi bi-map-fill me-2"></i> Buka di Google Maps
                </a>
                <a href="index.php" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Kembali</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>