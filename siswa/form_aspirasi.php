<?php
session_start();
include "../db.php";

/* Proteksi siswa */
if (!isset($_SESSION['login']) || $_SESSION['login'] != "siswa") {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Aspirasi Siswa</title>
    <link rel="stylesheet" href="../aset/css/style.css">
</head>

<body class="siswa-page">

    <div class="form-container">
        <h2>Form Aspirasi</h2>

        <form method="POST" action="simpan_aspirasi.php">

            <label>Kategori</label>
            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>

                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM kategori");
                while ($k = mysqli_fetch_assoc($kategori)) {
                    echo "<option value='" . $k['id_kategori'] . "'>" . $k['ket_kategori'] . "</option>";
                }
                ?>

            </select>

            <label>Lokasi</label>
            <input type="text" name="lokasi" required>

            <label>Keterangan</label>
            <textarea name="ket" rows="4" required></textarea>

            <button type="submit" class="btn">Kirim Aspirasi</button>

        </form>

        <br>

        <a href="riwayat_aspirasi.php" class="btn">Riwayat Aspirasi</a>
    </div>

</body>
</html>