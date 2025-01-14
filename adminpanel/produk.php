<?php
require "session.php";
require "../koneksi.php";
$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../adminpanel/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>

        <!-- Form Tambah Produk -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title">Tambah Produk</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                    </div>
                    <div>
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="">Pilih Satu</option>
                            <?php while ($data = mysqli_fetch_array($queryKategori)) { ?>
                                <option value="<?= $data['id']; ?>"><?= $data['nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>
                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div>
                        <label for="detail">Detail</label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="ketersediaan_stok">Ketersediaan Stok</label>
                        <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                            <option value="tersedia">Tersedia</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($nama == '' || $kategori == '' || $harga == '') {
                        echo '<div class="alert alert-warning mt-3">Nama, kategori, dan harga wajib diisi.</div>';
                    } else {
                        if ($nama_file != '') {
                            if ($image_size > 500000) {
                                echo '<div class="alert alert-warning mt-3">File tidak boleh lebih dari 500 KB.</div>';
                            } else {
                                if ($imageFileType != 'jpg' && $imageFileType != 'png') {
                                    echo '<div class="alert alert-warning mt-3">File wajib bertipe JPG atau PNG.</div>';
                                } else {
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                                }
                            }
                        }

                        $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) 
                            VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

                        if ($queryTambah) {
                            echo '<div class="alert alert-primary mt-3">Produk berhasil disimpan.</div>';
                            echo '<meta http-equiv="refresh" content="2; url=produk.php" />';
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }
                ?>
            </div>
        </div>

        <!-- List Produk -->
        <div class="mt-3 mb-5">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersediaan Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                            echo '<tr><td colspan="6" class="text-center">Data produk tidak tersedia.</td></tr>';
                        } else {
                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) {
                                echo '<tr>
                                        <td>' . $no++ . '</td>
                                        <td>' . $data['nama'] . '</td>
                                        <td>' . $data['nama_kategori'] . '</td>
                                        <td>' . $data['harga'] . '</td>
                                        <td>' . $data['ketersediaan_stok'] . '</td>
                                        <td><a href="produk_detail.php?p=' . $data['produk_id'] . '" class="btn btn-info">Detail</a></td>
                                      </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
