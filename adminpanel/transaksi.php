<?php
require "session.php";
require "../koneksi.php";

if (isset($_POST['update_status'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $status_baru = $_POST['status'];
    
    $query_update = "UPDATE transaksi SET status = '$status_baru' WHERE transaksi_id = '$transaksi_id'";
    mysqli_query($con, $query_update);
    header("Location: transaksi.php");
}

$querytransaksi = mysqli_query($con, "SELECT * FROM transaksi");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <h2>Data Transaksi</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_assoc($querytransaksi)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['transaksi_id']; ?></td>
                    <td><?php echo $data['tanggal']; ?></td>
                    <td><?php echo $data['total_harga']; ?></td>
                    <td><?php echo $data['status']; ?></td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="transaksi_id" value="<?php echo $data['transaksi_id']; ?>">
                            <select name="status" class="form-select" required>
                                <option value="Pending" <?php echo ($data['status'] == 'Pending') ? 'selected' : ''; ?>>
                                    Pending</option>
                                <option value="Paid" <?php echo ($data['status'] == 'Paid') ? 'selected' : ''; ?>>
                                    Paid</option>
                                <option value="Cancelled"
                                    <?php echo ($data['status'] == 'Cancelled') ? 'selected' : ''; ?>>
                                    Cancelled</option>
                            </select>
                            <button type="submit" name="update_status" class="btn btn-primary mt-2">Ubah</button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>