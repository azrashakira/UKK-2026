<?php
session_start();
include "../db.php";

if(!isset($_SESSION['login']) || $_SESSION['login'] != "admin"){
    header("Location: ../login.php");
    exit();
}

$id = $_POST['id_pelaporan'];
$status = $_POST['status'];
$feedback = $_POST['feedback'];

/* cek apakah sudah ada data */
$cek = mysqli_query($conn,"
SELECT * FROM aspirasi WHERE id_pelaporan='$id'
");

if(mysqli_num_rows($cek) > 0){

    mysqli_query($conn,"
    UPDATE aspirasi
    SET status='$status', feedback='$feedback'
    WHERE id_pelaporan='$id'
    ");

}else{

    mysqli_query($conn,"
    INSERT INTO aspirasi (status,id_pelaporan,feedback)
    VALUES ('$status','$id','$feedback')
    ");

}

header("Location: data_aspirasi.php");
exit();
?>