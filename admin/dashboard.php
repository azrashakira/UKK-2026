<?php
session_start();
include "../db.php";

/* Proteksi halaman admin */
if(!isset($_SESSION['login']) || $_SESSION['login'] != "admin"){
    header("Location: ../login.php");
    exit();
}

/* Hitung total laporan */
$totalLaporan = mysqli_query($conn, 
    "SELECT COUNT(*) AS jumlah FROM input_aspirasi"
);
$dataTotal = mysqli_fetch_assoc($totalLaporan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../aset/css/style.css">
</head>
<body class="admin-page">

<div class="container">

    <div class="card">
        <h2>Dashboard Admin</h2>
        <p>
            Selamat datang, 
            <b><?php echo $_SESSION['username']; ?></b>
        </p>
    </div>

    <div class="card">
        <h3>Total Laporan Masuk</h3>
        <h1><?php echo $dataTotal['jumlah']; ?></h1>
    </div>

    <div class="card">
        <a href="data_aspirasi.php" class="btn">Lihat Data Aspirasi</a>
        <a href="laporan_bulanan.php" class="btn">Laporan Bulanan</a>
        <a href="kategori.php" class="btn">Kelola Kategori</a>
        <a href="../logout.php" class="btn logout">Logout</a>
    </div>

</div>

</body>
</html>