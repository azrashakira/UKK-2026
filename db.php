<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_aspirasi_siswa"; 

$conn = mysqli_connect($host, $user, $pass, $db);

// cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>