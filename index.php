<?php
session_start();

/* kalau sudah login */
if(isset($_SESSION['login'])){

    if($_SESSION['login'] == "admin"){
        header("Location: admin/dashboard.php");
        exit();
    }else if($_SESSION['login'] == "siswa"){
        header("Location: siswa/form_aspirasi.php");
        exit();
    }

}

/* kalau belum login */
header("Location: login.php");
exit();
?>