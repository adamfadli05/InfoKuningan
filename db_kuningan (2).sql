-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2026 pada 10.28
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kuningan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin123', 'Administrator Kuningan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuliner`
--

CREATE TABLE `kuliner` (
  `id_kuliner` int(11) NOT NULL,
  `nama_kuliner` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `menu_andalan` varchar(100) DEFAULT NULL,
  `range_harga` varchar(50) DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `link_maps` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kuliner`
--

INSERT INTO `kuliner` (`id_kuliner`, `nama_kuliner`, `deskripsi`, `menu_andalan`, `range_harga`, `lokasi`, `link_maps`, `foto`) VALUES
(2, 'Rujak Kangkung Dadakan dan Sop Tutut', 'Kangkung adalah sejenis sayuran yang populer di Indonesia. Tanaman kangkung memiliki daun hijau gelap yang tumbuh di air atau di tanah yang lembab.\r\n\r\ncontact person: 0858-6457-0038', 'Rujak Kangkung', '5000', 'Jalaksana', 'https://www.bing.com/maps/search?FORM=HDRSC6&style=r&q=Rujak+Kangkung+Khas+Kuningan+jawabarat&secq=Rujak+Kangkung+Dadakan+dan+Sop+Tutut&sece=ypid%3AYNBA39CC79DC920662&cp=-6.878379%7E108.469169&lvl=12.6', 'Rujak Kangkung.jfif'),
(3, 'Nasi Kasreng Luragung Ceu Iyan', 'Nasi Kasreng, makanan khas Kabupaten Kuningan yang memiliki cita rasa yang khas, yaitu pedas gurih dengan aroma terasi. Menu makanan ini terbuat dari bahan nasi putih yang disantap bersama lauk-pauk sederhana, seperti ikan asin, sambal terasi, juga lalapan segar.\r\n\r\nNasi Kasreng disajikan dalam porsi kecil namun kaya rasa dengan bungkus daun pisang. Makanan satu ini cocok dijadikan sebagai menu sarapan atau makanan siang ringan. Untuk menyantap hidangan ini, Kamu hanya perlu mengeluarkan kocek mulai dari Rp 5.000-Rp 10.000 per bungkusnya.\r\n\r\nContact persont: 0899-2219-340', 'Nasi Kasreng', '5rb-10rb', '3 Jl Raya Kuningan - Luragung 45581 Kuningan Jawa Barat', 'https://www.bing.com/maps/search?mepi=0%7ERestaurant%7EEmbedded%7EEntity_Vertical_List_Card&ty=17&poicount=18&sei=0&FORM=MPSRPL&q=nasi+kasreng+kuningan&secq=Nasi+Kasreng+Luragung+Ceu+Iyan+nasi+kasreng+kuningan&sece=ypid.YN64A3D25E369F93F3&ppois=-6.8867688', 'Annotation 2026-05-20 024708.jpg'),
(4, 'Tahu Lamping', 'Jika berwisata ke Jawa Barat seringnya menemukan tahu Sumedang, di Kuningan ada menu tahu juga bernama Tahu Lamping. Tahu Lamping memiliki ciri khas dengan teksturs lembut di dalam dan renyah di luar. Pembuatannya menggunakan kedelai pilihan dan difermentasi sehingga menghasilkan tahu dengan rasa yang lebih gurih. Tahu Lamping menjadi semakin nikmat apabila disantap dengan cabe rawit dan kecap manis.\r\n\r\nContact person: +62 232 873255', 'Tahu Lamping', '2rb-5rb', 'Jalan Veteran, Lamping 45511 Kuningan Jawa Barat', 'https://www.bing.com/maps/search?mepi=0%7ERestaurant%7EEmbedded%7EEntity_Vertical_List_Card&ty=17&poicount=18&sei=0&FORM=MPSRPL&style=r&q=Tahu+Lamping+Khas+Kuningan%2C+Jalan+Veteran%2C+Lamping%2C+Kuningan+45511%2C+Indonesia&ss=id.local_ypid%3A%22YN7999x49', 'Annotation 2026-05-20 025047.jpg'),
(5, 'Makan Serabi Bandung', 'Sorabi, atau serabi, merupakan camilan tradisional yang terbuat dari adonan tepung beras dan santan, biasanya dimasak di atas tungku. Di Kuningan, tepatnya di Taman Cilimus, Anda bisa menemukan Sorabi Aneka Rasa, yang menghadirkan banyak pilihan rasa yang unik dan menarik.', 'Serabi Telor', '5rb-25rb', 'Jalan Linggasana', 'https://maps.app.goo.gl/BbwkD38L1Y5Xa4316?g_st=ic', 'Annotation 2026-05-27 104144.jpg'),
(6, 'Peyeum ketan', 'Peyeum Ketan adalah tape ketan yang terbuat dari beras ketan yang difermentasi. Makanan ini memiliki rasa manis dan biasanya dibungkus dalam wadah ember. Peuyeum Ketan menjadi oleh-oleh yang populer dari Kuningan.', 'Peyeum ketan', '20rb-100rb', 'Jalan Lebegede', 'https://maps.app.goo.gl/JykTMzegMHkZL9N59?g_st=iw', 'Annotation 2026-05-27 105546.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` int(11) NOT NULL,
  `nama_wisata` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga_tiket` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `fasilitas` text DEFAULT NULL,
  `link_maps` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `nama_wisata`, `deskripsi`, `harga_tiket`, `alamat`, `fasilitas`, `link_maps`, `foto`) VALUES
(2, 'Desa Wisata Cibuntu', 'area khusus untuk berfoto, mushola, akses Wi-Fi, tempat makan, toilet umum, hingga penyewaan perlengkapan wisata.', '15.000 (per-orang)', 'Desa Wisata Cibuntu berada di Kecamatan Pasawahan, Kabupaten Kuningan, Jawa Barat, tepat di kaki Gunung Ciremai. ', '', 'https://maps.app.goo.gl/GFoDKQpn8NTNQM6S6', 'cibuntu.jpg'),
(3, 'Lembah Cilengkrang', 'Lembah Cilengkrang berada di Kawasan konservasi Taman Nasional Gunung Ciremai yang berada di Kabupaten Kuningan, Jawa Barat. Lembah Cilengkrang menjadi salah satu tempat wisata Kuningan yang paling banyak dikunjungi oleh wisatawan, baik dari dalam maupun luar Kabupaten Kuningan.', '25.000 (per-orang) ', 'Lembah Cilengkrang tepatnya berada kawasan Taman Nasional Gunung Ciremai, Desa Pajambon, Kecamatan Kramatmulya, Kabupaten Kuningan atau berjarak sekitar 33 kilometer dari Kota Cirebon.', 'Parkir, Toilet, Kolam Renang Air Hangat, Mushola', 'https://www.bing.com/maps/search?name=Lembah+Cilengkrang&trfc=&mepi=0%7E%7EEmbedded%7ELargeMapLink&FORM=MPSRPL&style=r&q=Lembah+Cilengkrang&ss=id.ypid%3AYN7999x3427680341454789059&ppois=-6.935980796813965_108.43798065185547_Lembah+Cilengkrang&cp=-6.935981', 'cilengkrang.jpg'),
(4, 'Waduk Darma', 'Waduk Darma adalah destinasi wisata unggulan di Kuningan, Jawa Barat, yang menawarkan pemandangan alam yang indah dan berbagai aktivitas rekreasi. \r\nWaduk Darma dikelilingi oleh pegunungan hijau yang memberikan panorama yang menakjubkan. Luas waduk ini sekitar 425 hektar, menjadikannya sebagai primadona bagi para pengunjung yang ingin menikmati suasana tenang dan pemandangan yang memukau.', '22.000 (per-orang)', 'Waduk Darma terletak di Desa Jagara, Kecamatan Darma, Kabupaten Kuningan, Jawa Barat. Lokasi ini dapat diakses dengan mudah melalui jalan raya Cirebon – Kuningan - Ciamis. Waduk ini merupakan destinasi wisata yang populer dan menawarkan pemandangan yang indah bagi pengunjung.', 'sewa untuk acara & ruang pertemuan, camping ground/ atau campervan. Termasuk paket piknik, wedding, photoshoot prewedding, wahana (permainan anak, sepeda listrik, atv), spot foto, banana boat, rolling boat dan perahu wisata.', 'https://www.bing.com/maps/search?name=Waduk+Darma&trfc=&mepi=0%7E%7EEmbedded%7ELargeMapLink&FORM=MPSRPL&style=r&q=Waduk+Darma&ss=id.ypid%3AYN7999x4566521630478223006&ppois=-7.020895004272461_108.40381622314453_Waduk+Darma&cp=-7.020895%7E108.403816&lvl=15', 'WhatsApp Image 2026-04-13 at 23.18.26.jpeg'),
(5, 'Curug Putri Palutungan', 'Curug Putri Palutungan adalah permata tersembunyi di kaki Gunung Ciremai. Air terjun ini menawarkan suasana sejuk dan damai. Terletak di kawasan Palutungan Kuningan, Jawa Barat. Tempat ini sangat cocok untuk melepaskan penat dari hiruk pikuk kota. Ketinggian air terjunnya mencapai sekitar 20 meter.', '20.000 (per-orang)', 'Desa Cisantana RT/RW 07/03, Kec. Cigugur, Kab. Kuningan, Jawa Barat 45552', 'Area parkir, camping, rafting, saung, shelter, toilet, mushola, warung dan pusat informasi.', 'https://www.bing.com/maps/search?name=Curug+Putri+Palutungan&trfc=&mepi=0%7E%7EEmbedded%7ELargeMapLink&FORM=MPSRPL&style=r&q=Curug+Putri+Palutungan&ss=id.ypid%3AYN7999x9252627553190581369&ppois=-6.946993827819824_108.43291473388672_Curug+Putri+Palutungan&', 'curug putri.jpg'),
(6, 'Bendungan Kuningan', 'Bendungan Kuningan adalah sebuah waduk yang terletak di Kuningan, Jawa Barat, Indonesia. Waduk ini dibangun dengan cara membendung aliran Sungai Cikaro di Desa Randusari, Kecamatan Cibeureum. Waduk ini diresmikan oleh Presiden Joko Widodo pada tanggal 31 Agustus 2021.', 'Gratis', 'Jalan Raya Desa Randusari, Kecamatan Cibereum, Kabupaten Kuningan, Jawa Barat 45588.', '', 'https://www.bing.com/maps/search?name=Gedung+Pandang+Bendungan&trfc=&mepi=0%7E%7EEmbedded%7ELargeMapLink&FORM=MPSRPL&style=r&q=Gedung+Pandang+Bendungan&ss=id.ypid%3AYN7999x15522450549725904099&ppois=-7.0648698806762695_108.70675659179688_Gedung+Pandang+Be', 'bendungan.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kuliner`
--
ALTER TABLE `kuliner`
  ADD PRIMARY KEY (`id_kuliner`);

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kuliner`
--
ALTER TABLE `kuliner`
  MODIFY `id_kuliner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
