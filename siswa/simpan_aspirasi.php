<?php
session_start();
include "../db.php";

if(!isset($_SESSION['login']) || $_SESSION['login'] != "siswa"){
    header("Location: ../login.php");
    exit();
}

$nis = $_SESSION['nis']; 
$id_kategori = $_POST['id_kategori'];
$lokasi = $_POST['lokasi'];
$ket = $_POST['ket'];

mysqli_query($conn, "
    INSERT INTO input_aspirasi (nis, id_kategori, lokasi, ket)
    VALUES ('$nis', '$id_kategori', '$lokasi', '$ket')
");

header("Location: form_aspirasi.php?success=1");
exit();
?>