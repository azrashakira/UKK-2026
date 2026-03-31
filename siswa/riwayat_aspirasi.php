<?php
session_start();
include "../db.php";

    if(!isset($_SESSION['login']) || $_SESSION['login'] != "siswa"){
        header("Location: ../login.php");
        exit();
    }

    $nis = $_SESSION['nis'];

        $query = mysqli_query($conn,"
        SELECT input_aspirasi.*, aspirasi.status, aspirasi.feedback, kategori.ket_kategori
        FROM input_aspirasi
        LEFT JOIN aspirasi 
        ON input_aspirasi.id_pelaporan = aspirasi.id_pelaporan
        LEFT JOIN kategori
        ON input_aspirasi.id_kategori = kategori.id_kategori
        WHERE input_aspirasi.nis='$nis'
        ORDER BY input_aspirasi.id_pelaporan DESC
        ");
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Riwayat Aspirasi</title>
            <link rel="stylesheet" href="../aset/css/style.css">
        </head>

    <body class="admin-page">

            <div class="container">

            <div class="card">
            <h2>Riwayat Aspirasi Saya</h2>
            <a href="form_aspirasi.php" class="btn">Kirim Aspirasi</a>
            <a href="../logout.php" class="btn logout">Logout</a>
            </div>

            <div class="card">

            <table class="table">
            <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Feedback</th>
            </tr>

            <?php
            $no=1;
            while($data=mysqli_fetch_assoc($query)){
            ?>

            <tr>

            <td><?php echo $no++; ?></td>

            <td><?php echo $data['ket_kategori']; ?></td>

            <td><?php echo $data['lokasi']; ?></td>

            <td><?php echo $data['ket']; ?></td>

            <td>
            <?php 
            $status = $data['status'] ? $data['status'] : 'menunggu';

            if($status=="menunggu"){
            echo "<span class='status menunggu'>Menunggu</span>";
            }elseif($status=="proses"){
            echo "<span class='status proses'>Proses</span>";
            }else{
            echo "<span class='status selesai'>Selesai</span>";
            }
            ?>
            </td>

            <td>
            <?php echo $data['feedback'] ? $data['feedback'] : '-'; ?>
            </td>

            </tr>

            <?php } ?>

            
            </table>
            </div>
        </div>
    </body>
</html>