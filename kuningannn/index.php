<?php 
include 'koneksi.php'; 
include 'header.php'; 

// --- LOGIKA PENCARIAN & PAGINATION ---
$keyword = "";
if (isset($_POST['cari'])) { $keyword = mysqli_real_escape_string($conn, $_POST['keyword']); }
$perHalaman = 4; 
$halamanAktif = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$awalData = ($perHalaman * $halamanAktif) - $perHalaman;
$queryTotal = mysqli_query($conn, "SELECT * FROM wisata WHERE nama_wisata LIKE '%$keyword%'");
$totalData = mysqli_num_rows($queryTotal);
$totalHalaman = ceil($totalData / $perHalaman);
?>

<style>
    /* WARNA BACKGROUND: BIRU ABU-ABU GRADASI */
    body { 
        background: linear-gradient(135deg, #eef2f3 0%, #8e9eab 100%); 
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
    }
    
    /* CAROUSEL FULL SIZE & TEKS KIRI */
    .carousel-item {
        height: 85vh;
        min-height: 450px;
    }
    .carousel-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    .carousel-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 100%);
    }
    .carousel-caption { 
        top: 30%; 
        bottom: auto;
        text-align: left; 
        left: 10%; 
        right: auto;
        max-width: 800px; 
        z-index: 10;
    }
    .carousel-caption h1 { 
        font-size: 4.5rem; 
        font-weight: 800; 
        line-height: 1;
        text-shadow: 2px 2px 20px rgba(0,0,0,0.5);
        color: white;
    }

    /* CARD STYLE */
    .custom-card {
        border: none;
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.9);
        transition: 0.4s;
    }
    .custom-card:hover {
        transform: translateY(-15px);
        background: white;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    .card-img-top { height: 220px; object-fit: cover; border-radius: 25px 25px 0 0; }
    .section-title { font-weight: 800; border-bottom: 5px solid #3498db; padding-bottom: 5px; display: inline-block; color: #2c3e50; }
</style>

<div id="kuninganHero" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1596438459194-f275f413d6ff?q=80&w=1600" class="carousel-img">
            <div class="carousel-overlay"></div>
            <div class="carousel-caption">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">Wisata Alam</span>
                <h1>Jelajahi Pesona <br>Gunung Ciremai</h1>
                <p class="text-white">Nikmati keajaiban alam dan udara sejuk pegunungan Kuningan.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1600" class="carousel-img">
            <div class="carousel-overlay"></div>
            <div class="carousel-caption">
                <span class="badge bg-success px-3 py-2 rounded-pill mb-3">Kuliner Khas</span>
                <h1>Cita Rasa <br>Legendaris</h1>
                <p class="text-white">Sajian autentik dengan bumbu tradisi yang memanjakan lidah.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#kuninganHero" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#kuninganHero" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center bg-white bg-opacity-50 shadow-sm p-4 p-md-5" style="border-radius: 40px; backdrop-filter: blur(10px);">
            <div class="col-lg-12 text-center">
                <h2 class="display-6 fw-bold mb-4" style="color: #2c3e50;">Selamat Datang di Kuningan</h2>
                <p class="lead text-secondary mb-5 mx-auto" style="max-width: 900px; line-height: 1.8;">
                    Terletak megah di lereng Gunung Ciremai, Kuningan adalah harmoni sempurna antara alam yang asri dan kearifan lokal yang kental. 
                    Dikenal sebagai <strong>Kota Kuda</strong>, wilayah ini menawarkan kesegaran mata air pegunungan, udara yang bersih, serta petualangan kuliner legendaris yang memikat hati.
                </p>
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="p-2 bg-white rounded-pill shadow-lg d-flex align-items-center">
                            <i class="bi bi-search ms-4 text-muted"></i>
                            <form action="" method="POST" class="w-100 d-flex">
                                <input type="text" name="keyword" class="form-control border-0 bg-transparent py-3 shadow-none" 
                                       placeholder="Cari tempat wisata atau kuliner favoritmu..." value="<?= $keyword; ?>">
                                <button type="submit" name="cari" class="btn btn-primary px-5 rounded-pill fw-bold">Cari</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5 pb-5">
    <h2 class="section-title mb-4">Destinasi Wisata</h2>
    <div class="row g-4">
        <?php
        $res_w = mysqli_query($conn, "SELECT * FROM wisata WHERE nama_wisata LIKE '%$keyword%' LIMIT $awalData, $perHalaman");
        while($w = mysqli_fetch_assoc($res_w)) { ?>
            <div class="col-md-3">
                <div class="card custom-card h-100">
                    <img src="gambar/<?= $w['foto']; ?>" class="card-img-top">
                    <div class="card-body p-4 text-center">
                        <h6 class="fw-bold mb-3"><?= $w['nama_wisata']; ?></h6>
                        <a href="detail.php?id=<?= $w['id_wisata']; ?>&type=wisata" class="btn btn-primary btn-sm w-100 rounded-pill py-2 fw-bold">Detail</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    
    <?php if ($totalHalaman > 1) : ?>
    <nav class="mt-5"><ul class="pagination justify-content-center">
        <?php for($i = 1; $i <= $totalHalaman; $i++) : ?>
            <li class="page-item <?= ($i == $halamanAktif) ? 'active' : ''; ?>">
                <a class="page-link rounded-circle mx-1" href="?page=<?= $i; ?>&keyword=<?= $keyword; ?>"><?= $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul></nav>
    <?php endif; ?>

    <h2 class="section-title mb-4 mt-5" style="border-color: #27ae60;">Kuliner Favorit</h2>
    <div class="row g-4">
        <?php
        $res_k = mysqli_query($conn, "SELECT * FROM kuliner WHERE nama_kuliner LIKE '%$keyword%' LIMIT 4");
        while($k = mysqli_fetch_assoc($res_k)) { ?>
            <div class="col-md-3">
                <div class="card custom-card h-100 border-top border-success border-5">
                    <img src="gambar/<?= $k['foto']; ?>" class="card-img-top">
                    <div class="card-body p-4 text-center">
                        <h6 class="fw-bold mb-3"><?= $k['nama_kuliner']; ?></h6>
                        <a href="detail.php?id=<?= $k['id_kuliner']; ?>&type=kuliner" class="btn btn-success btn-sm w-100 rounded-pill py-2 fw-bold">Detail</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>