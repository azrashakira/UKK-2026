<?php
session_start();
include "../db.php";

/* Proteksi admin */
if (!isset($_SESSION['login']) || $_SESSION['login'] != "admin") {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$data = mysqli_query($conn, "
    SELECT * 
    FROM input_aspirasi 
    WHERE id_pelaporan = '$id'
");

$d = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback Aspirasi</title>
    <link rel="stylesheet" href="../aset/css/style.css">
</head>

<body class="admin-page">

    <div class="form-container">

        <h2>Feedback Aspirasi</h2>

        <form method="POST" action="simpan_feedback.php">

            <input type="hidden" name="id_pelaporan" value="<?php echo $d['id_pelaporan']; ?>">

            <label>NIS</label>
            <input type="text" value="<?php echo $d['nis']; ?>" readonly>

            <label>Keterangan</label>
            <textarea readonly><?php echo $d['ket']; ?></textarea>

            <label>Status</label>
            <select name="status" required>
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
            </select>

            <label>Feedback</label>
            <textarea name="feedback" required></textarea>

            <button type="submit" class="btn">Simpan</button>

        </form>

        <br>

        <a href="data_aspirasi.php" class="btn">Kembali</a>

    </div>

</body>
</html>