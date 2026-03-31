<?php
session_start();
include "../db.php";

/* Proteksi admin */
if (!isset($_SESSION['login']) || $_SESSION['login'] != "admin") {
    header("Location: ../login.php");
    exit();
}

/* ambil data kategori */
$query = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
    <link rel="stylesheet" href="../aset/css/style.css">
</head>

<body class="admin-page">

    <div class="container">

        <div class="card">
            <h2>Data Kategori</h2>
            <a href="dashboard.php" class="btn">Kembali</a>
        </div>

        <div class="card">

            <!-- FORM TAMBAH -->
            <form method="POST" action="simpan_kategori.php">

                <input 
                    type="text" 
                    name="ket_kategori" 
                    placeholder="Nama Kategori" 
                    required
                >

                <button type="submit" class="btn">Tambah</button>

            </form>

        </div>

        <div class="card">

            <table border="1" width="100%" cellpadding="10">

                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                </tr>

                <?php 
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) {
                ?>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['ket_kategori']; ?></td>
                    </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</body>
</html>