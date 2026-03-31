<?php
session_start();
include "../db.php";

/* Proteksi admin */
if(!isset($_SESSION['login']) || $_SESSION['login'] != "admin"){
    header("Location: ../login.php");
    exit();
}

/* Query laporan per bulan */
$query = mysqli_query($conn, "
    SELECT 
        MONTH(tanggal) AS bulan,
        MONTHNAME(tanggal) AS nama_bulan,
        COUNT(*) AS jumlah
    FROM input_aspirasi
    GROUP BY MONTH(tanggal)
    ORDER BY MONTH(tanggal)
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bulanan</title>
    <link rel="stylesheet" href="../aset/css/style.css">
</head>
<body class="admin-page">

<div class="container">

    <div class="card">
        <h2>Laporan Aspirasi Per Bulan</h2>
        <a href="dashboard.php" class="btn">Kembali</a>
    </div>

    <div class="card">
            <table class="table">
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Jumlah Aspirasi</th>
            </tr>

            <?php 
            $no = 1;
            while($data = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_bulan']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>