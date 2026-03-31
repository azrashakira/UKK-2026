<?php
session_start();
include "../db.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM input_aspirasi WHERE id_pelaporan=$id");
}

header("Location: data_aspirasi.php");
exit();