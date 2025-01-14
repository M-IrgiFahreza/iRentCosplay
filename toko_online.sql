-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 06:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `detail_id` int(3) NOT NULL,
  `transaksi_id` int(3) NOT NULL,
  `produk_id` int(3) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`detail_id`, `transaksi_id`, `produk_id`, `jumlah`, `harga`) VALUES
(1, 1, 19, 1, 45000.00),
(2, 2, 21, 1, 55000.00),
(3, 3, 22, 1, 65000.00),
(4, 4, 18, 1, 50000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(33, 'Baju Pria'),
(34, 'Baju Wanita'),
(35, 'Hoodie'),
(36, 'Sepatu'),
(37, 'Jam Tangan'),
(38, 'Topi');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `produk_id` int(3) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `user_id`, `produk_id`, `jumlah`, `tanggal`) VALUES
(3, 4, 18, 3, '2024-12-09 08:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `user_id` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`user_id`, `username`, `email`, `password`) VALUES
(4, 'Akbar', 'hadityaakbar@gmail.com', 'Akbar Haditya'),
(5, 'Sugiri', 'sugiri@gmail.com', 'Sugiri Nih');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`) VALUES
(18, 33, 'baju pria 1', 50000, '3rnJLVkx1tZbvGI9D5lN.jpg', 'Kaos ini bikin kamu nggak cuma survivor, tapi juga fashion icon! Udah keren, adem, nggak bikin gerah... kayak gebetan yang nggak ngambek terus. Cocok buat ngumpul, push rank, atau cuma sekedar rebahan sambil nunggu zone shrink. BOOYAH', 'tersedia'),
(19, 33, 'baju pria 2', 45000, '3GuiIdKttEI0D6yaHwUt.jpg', 'Kaos premium bertema karakter Free Fire favorit Anda! Dibuat dari bahan katun lembut yang menyerap keringat, kaos ini memberikan kenyamanan maksimal sepanjang hari. Dengan sablon berkualitas tinggi, gambar tidak mudah pudar meski dicuci berulang kali. Tersedia dalam berbagai ukuran (S, M, L, XL).', 'tersedia'),
(20, 33, 'baju Pria 3', 25000, '8yOg9WCoxRsGxLYbgaxT.jpg', 'Kaos polos ini bukan sekadar pakaian, tapi investasi kenyamanan! Dibuat dari bahan 100% katun combed yang lembut, adem, dan menyerap keringat, kaos ini cocok dipakai di segala suasana. Desain simpel tapi tetap stylish, pas untuk santai, kerja, atau hangout bareng teman. Pilihan warna lengkap, cocok untuk semua mood!', 'tersedia'),
(21, 33, 'baju pria 4', 55000, 'n5FEI0v4RPKgsGkMd9Jy.jpg', 'Tampil percaya diri dengan kemeja hitam ini! Desainnya simpel tapi elegan, cocok untuk acara formal maupun semi-formal. Dibuat dari bahan katun premium yang lembut, ringan, dan mudah menyerap keringat. Jahitan rapi dan potongan slim fit membuat Anda terlihat rapi dan profesional sepanjang hari.', 'tersedia'),
(22, 34, 'baju wanita 5', 65000, 'GSuH3QCiOAT2RlJCdVY8.jpg', 'Tampil cantik dengan gaya minimalis! Kaos leher V ini dirancang untuk memberikan kesan santai tapi tetap anggun. Bahan katun lembut yang adem membuat nyaman dipakai sepanjang hari. Cocok dipadukan dengan jeans, rok, atau celana pendek.', 'tersedia'),
(23, 34, 'baju wanita 6', 139000, 'mq8tcPYLvXKWEeLVfl4z.jpg', 'Blouse ini dirancang untuk kamu yang suka tampil simpel namun tetap anggun. Bahan lembut dan adem cocok dipakai seharian, dari bekerja hingga hangout santai. Padukan dengan jeans atau rok untuk gaya kasual atau semi-formal.\r\n\r\nBahan: Katun Combed Premium\r\nModel: Regular Fit\r\nFitur: Adem, Mudah Dicuci, Tidak Mudah Kusut\r\nWarna: Putih, Hitam, Soft Pink, Navy\r\nUkuran: S, M, L, XL\r\nHarga: Rp139.000', 'tersedia'),
(24, 35, 'hoodie 1', 189000, 'WDF5Qcu3EFvz47Yzlpw2.jpg', 'Hoodie pendek ini dirancang untuk kamu yang ingin tampil santai tapi tetap fashionable. Kombinasi warna hitam dan kuning menciptakan kesan bold dan modern. Dengan potongan pendek serta bahan yang adem, hoodie ini cocok untuk cuaca panas atau aktivitas santai di luar ruangan.\r\n\r\nBahan: Katun Fleece Premium\r\nFitur:\r\nAdem dan ringan\r\nTerdapat detail print modern\r\nTali hoodie yang bisa diatur\r\nWarna: Hitam dengan aksen kuning cerah\r\nUkuran Tersedia: S, M, L, XL', 'tersedia'),
(25, 35, 'hoodie 2', 150000, 'YhgwjLquZuBJmoMYzbZg.jpg', 'Siap tampil dengan gaya simpel tapi tetap stylish? Hoodie polos ini adalah pilihan sempurna! Dengan bahan katun fleece premium yang lembut dan adem, kamu bakal nyaman seharian, baik di rumah maupun di luar. Desainnya yang minimalis dengan warna cream memberi kesan elegan, sementara kantong depan dan tali hoodie yang bisa disesuaikan membuatnya praktis dan fungsional.', 'tersedia'),
(26, 37, 'jam 1', 799000, 'yct5fGtl8mvawKkuZpPx.jpg', 'Bawa gaya hidupmu ke level selanjutnya dengan Jam Tangan Quiksilver. Desain sporty dengan sentuhan modern, membuat jam tangan ini cocok untuk aktivitas outdoor maupun gaya sehari-hari. Tahan lama, stylish, dan tentunya penuh dengan fungsi – jam tangan Quiksilver adalah pilihan tepat untuk kamu yang aktif dan ingin selalu tampil keren.', 'tersedia'),
(27, 37, 'jam 2', 799000, 'DbvvBjp7TMHX1inqWvGj.jpg', 'iap untuk tampil keren dengan sentuhan sporty yang tak tertandingi? Jam Tangan Quiksilver adalah pilihan tepat untuk kamu yang selalu bergerak dinamis dan ingin menambah kesan keren pada penampilan. Desainnya yang maskulin dan kokoh, cocok untuk melengkapi gaya hidup aktif kamu, dari pantai hingga petualangan sehari-hari.', 'tersedia'),
(28, 37, 'jam 3', 899000, '6LCFd6Nekp7Q1pYuuwPB.jpg', 'Jam Tangan Digitec Runner Series Smart Watch adalah pilihan sempurna untuk kamu yang aktif, penuh gaya, dan tidak ingin ketinggalan teknologi terkini. Dengan desain modern dan warna merah yang mencolok, jam tangan ini tidak hanya tampil stylish tetapi juga dilengkapi berbagai fitur pintar yang memudahkan aktivitas harianmu.', 'tersedia'),
(29, 37, 'jam 4', 799000, 'ZcNFGHrMS4vdokOVjhyG.jpg', 'Tampil lebih stylish dengan CIVO CV0250, jam tangan kulit elegan yang dirancang untuk memberikan kesan mewah dan modern. Dengan dial unik dan strap kulit hitam yang nyaman, jam tangan ini sempurna untuk melengkapi gaya kasual atau formal kamu.\r\n\r\nMaterial: Strap kulit premium yang lembut dan tahan lama\r\nDesain: Dial unik dengan tampilan minimalis yang elegan\r\nFitur: Tahan lama, cocok untuk berbagai kesempatan\r\nWarna: Hitam, memberi kesan klasik dan elegan\r\nHarga: Rp799.000', 'tersedia'),
(32, 36, 'sepatu 1', 150000, 'uYUpvaAWpBSAE5RaUA1W.jpg', 'Sepatu Adidas adalah pilihan sempurna untuk kamu yang mengutamakan kenyamanan dan gaya. Dengan teknologi terbaru dan desain modern, sepatu ini cocok untuk berbagai kegiatan, dari olahraga hingga gaya hidup aktif sehari-hari. Menawarkan dukungan maksimal dengan tampilan yang selalu keren.', 'tersedia'),
(33, 36, 'sepatu 2', 399000, 'xNu7z06AD8eeuQUkha5u.jpg', 'Tampil dengan gaya klasik dan nyaman menggunakan Sepatu Converse. Dengan desain legendaris yang sudah dikenal di seluruh dunia, sepatu ini memberikan sentuhan kasual yang sempurna untuk berbagai aktivitas. Dari jalanan hingga acara santai, Converse selalu jadi pilihan tepat.\r\n\r\nMaterial: Kanvas berkualitas tinggi, ringan dan breathable\r\nDesain: Desain low-top dengan warna klasik, cocok untuk segala suasana\r\nSol: Karet anti-slip, nyaman digunakan sepanjang hari\r\nWarna: Hitam, putih, biru, dan berbagai pilihan warna lainnya\r\nHarga: Mulai dari Rp399.000', 'tersedia'),
(34, 36, 'sepatu 3', 349000, 'Y2wJoHn5AzSwrfL4P4hk.jpg', 'Sepatu Vantela hadir untuk memberikan sentuhan kasual dan nyaman dalam setiap langkahmu. Dengan desain yang simpel namun tetap stylish, sepatu ini cocok untuk digunakan sehari-hari, baik untuk bekerja, hangout, atau sekadar jalan-jalan santai.\r\n\r\nMaterial: Kanvas berkualitas tinggi, ringan dan breathable\r\nDesain: Desain low-top klasik dengan pilihan warna netral, mudah dipadukan dengan berbagai outfit\r\nSol: Sol karet yang tahan lama dan nyaman digunakan sepanjang hari\r\nWarna: Tersedia dalam berbagai pilihan warna netral dan kekinian\r\nHarga: Mulai dari Rp349.000\r\nCocok Untuk:\r\n\r\nGaya kasual sehari-hari\r\nTampilan santai yang tetap modis\r\nKenyamanan maksimal untuk aktivitas ringan\r\nTampil simpel dan elegan dengan Sepatu Vantela – Pilihan tepat untuk langkah penuh gaya!', 'tersedia'),
(35, 38, 'topi 1', 45000, '4ZnLwsZPPb3bBHGKgDcG.jpg', 'Topi adalah aksesori wajib yang dapat mengubah tampilanmu dalam sekejap. Dengan desain yang praktis dan stylish, topi tidak hanya melindungi dari panas matahari tetapi juga menambah kesan keren pada setiap gaya. Tersedia dalam berbagai pilihan model, dari snapback hingga beanie, semuanya siap untuk melengkapi penampilanmu.', 'tersedia'),
(36, 38, 'topi 2', 45000, 'dmzenNlLTFuF8j4GXrCo.jpg', 'Topi adalah aksesori wajib yang dapat mengubah tampilanmu dalam sekejap. Dengan desain yang praktis dan stylish, topi tidak hanya melindungi dari panas matahari tetapi juga menambah kesan keren pada setiap gaya. Tersedia dalam berbagai pilihan model, dari snapback hingga beanie, semuanya siap untuk melengkapi penampilanmu.', 'tersedia'),
(37, 38, 'topi 3', 42000, 'shVNAtNHYvfIBbtnMr8n.jpg', 'Topi adalah aksesori wajib yang dapat mengubah tampilanmu dalam sekejap. Dengan desain yang praktis dan stylish, topi tidak hanya melindungi dari panas matahari tetapi juga menambah kesan keren pada setiap gaya. Tersedia dalam berbagai pilihan model, dari snapback hingga beanie, semuanya siap untuk melengkapi penampilanmu.', 'tersedia'),
(38, 38, 'topi 4', 35000, 'g0xwp7Sk5HSrhFjehuus.jpg', 'Topi adalah aksesori wajib yang dapat mengubah tampilanmu dalam sekejap. Dengan desain yang praktis dan stylish, topi tidak hanya melindungi dari panas matahari tetapi juga menambah kesan keren pada setiap gaya. Tersedia dalam berbagai pilihan model, dari snapback hingga beanie, semuanya siap untuk melengkapi penampilanmu.', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `metode_pembayaran` enum('transfer bca','transfer bri','cod') NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','cancelled') NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `user_id`, `alamat`, `kota`, `kode_pos`, `no_telepon`, `metode_pembayaran`, `total_harga`, `status`, `tanggal`) VALUES
(1, 4, 'Pondok Kacang Prima Blok H5 No 16', 'Tangerang Selatan', '15226', '08888940294', 'cod', 45000.00, 'paid', '2024-12-12 03:49:43'),
(2, 4, 'Pondok Kacang Prima Blok H5 No 16', 'Tangerang Selatan', '15226', '08888940294', 'cod', 55000.00, 'cancelled', '2024-12-12 03:48:37'),
(3, 5, 'Jalan Sukadiri', 'Tangerang', '15226', '0863543637', 'cod', 65000.00, 'pending', '2024-12-11 08:56:08'),
(4, 5, 'FGHJJKK', 'Tangerang', '15864', '0823828865', 'cod', 50000.00, 'pending', '2024-12-11 08:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(3) NOT NULL,
  `produk_id` int(3) NOT NULL,
  `username` varchar(55) NOT NULL,
  `rating` int(3) NOT NULL,
  `komentar` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `produk_id`, `username`, `rating`, `komentar`, `tanggal`) VALUES
(1, 19, 'Akbar', 5, 'Produk ini sangat bagusss', '2024-12-08 05:27:51'),
(2, 19, 'Akbar', 5, 'kereeeennn', '2024-12-08 05:30:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `transaksi_id` (`transaksi_id`,`produk_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`produk_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `detail_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `pelanggan` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `pelanggan` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
