<?php
include "../db.php";

$kategori = $_POST['ket_kategori'];

mysqli_query($conn, "
    INSERT INTO kategori (ket_kategori)
    VALUES ('$kategori')
");

header("Location: kategori.php");
?>