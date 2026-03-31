<?php
session_start();
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

/* CEK ADMIN */
$queryAdmin = mysqli_query($conn, 
    "SELECT * FROM tb_admin 
     WHERE username='$username' 
     AND password='".md5($password)."'"
);

if(mysqli_num_rows($queryAdmin) > 0){

    $_SESSION['login'] = "admin";
    $_SESSION['username'] = $username;

    header("Location: admin/dashboard.php");

/* CEK SISWA */
}else{

    $querySiswa = mysqli_query($conn, 
        "SELECT * FROM siswa 
         WHERE nis='$username' 
         AND password= '".md5($password)."'"
    );

    if(mysqli_num_rows($querySiswa) > 0){

        $_SESSION['login'] = "siswa";
        $_SESSION['nis'] = $username;

        header("Location: siswa/form_aspirasi.php");

    }else{
        echo "<script>
                alert('Username atau Password salah!');
                window.location='login.php';
              </script>";
    }
}
?>