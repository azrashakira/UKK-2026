<?php
session_start();
include "../db.php";

/* Proteksi admin */
if (!isset($_SESSION['login']) || $_SESSION['login'] != "admin") {
    header("Location: ../login.php");
    exit();
}

/* ambil filter */
$nis      = isset($_GET['nis']) ? $_GET['nis'] : '';
$tanggal  = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$sql = "SELECT 
            input_aspirasi.*, 
            aspirasi.status, 
            kategori.ket_kategori
        FROM input_aspirasi
        LEFT JOIN aspirasi 
            ON input_aspirasi.id_pelaporan = aspirasi.id_pelaporan
        LEFT JOIN kategori
            ON input_aspirasi.id_kategori = kategori.id_kategori
        WHERE 1=1";

/* filter nis */
if ($nis != '') {
    $sql .= " AND input_aspirasi.nis LIKE '%$nis%'";
}

/* filter tanggal */
if ($tanggal != '') {
    $sql .= " AND DATE(input_aspirasi.tanggal) = '$tanggal'";
}

/* filter kategori */
if ($kategori != '') {
    $sql .= " AND input_aspirasi.id_kategori = '$kategori'";
}

$sql .= " ORDER BY input_aspirasi.id_pelaporan DESC";

$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Aspirasi</title>
    <link rel="stylesheet" href="../aset/css/style.css">
</head>

<body class="admin-page">

    <div class="container">

        <div class="card">
            <h2>Data Aspirasi Siswa</h2>
            <a href="dashboard.php" class="btn">Kembali ke Dashboard</a>
        </div>

        <div class="card">

            <!-- FORM SEARCH -->
            <form method="GET" class="search-form">

                <input type="text" name="nis" placeholder="Cari NIS">

                <input type="date" name="tanggal">

                <select name="kategori">
                    <option value="">-Semua Kategori-</option>

                    <?php
                    $k = mysqli_query($conn, "SELECT * FROM kategori");
                    while ($kat = mysqli_fetch_assoc($k)) {
                        echo "<option value='" . $kat['id_kategori'] . "'>" . $kat['ket_kategori'] . "</option>";
                    }
                    ?>
                </select>

                <button type="submit" class="btn">Search</button>
                <a href="data_aspirasi.php" class="btn logout">Reset</a>

            </form>

            <table border="1" width="100%" cellpadding="10" cellspacing="0">

                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <?php
                if (mysqli_num_rows($query) == 0) {
                ?>

                    <tr>
                        <td colspan="8" style="text-align:center;">
                            Belum ada data aspirasi
                        </td>
                    </tr>

                <?php
                } else {

                    $no = 1;

                    while ($data = mysqli_fetch_assoc($query)) {

                        $status = $data['status'] ? $data['status'] : 'menunggu';
                ?>

                        <tr>

                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nis']; ?></td>
                            <td><?php echo $data['ket_kategori']; ?></td>
                            <td><?php echo $data['lokasi']; ?></td>
                            <td><?php echo $data['ket']; ?></td>
                            <td><?php echo $data['tanggal']; ?></td>

                            <td class="status">
                                <?php echo ucfirst($status); ?>
                            </td>

                            <td>
                                <a href="feedback.php?id=<?php echo $data['id_pelaporan']; ?>" class="btn">
                                    Feedback
                                </a>

                                <a href="hapus.php?id=<?php echo $data['id_pelaporan']; ?>"
                                   class="btn logout"
                                   onclick="return confirm('Yakin ingin hapus data ini?')">
                                    Hapus
                                </a>
                            </td>

                        </tr>

                <?php
                    }
                }
                ?>

            </table>

        </div>

    </div>

</body>
</html>