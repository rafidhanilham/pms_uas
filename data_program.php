<?php
include 'koneksi.php';
$query = "SELECT programs.*, users.nama AS manager FROM programs 
          JOIN users ON programs.manager_id = users.user_id";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Program - PMS UAS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Tambahan CSS sederhana untuk notifikasi */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            text-align: center;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Manajemen Program</h1>
        <div class="nav-actions">
            <a href="index.php">⬅ Kembali ke Dashboard</a>
            <a href="tambah_program.php" class="btn-add" style="background-color: #27ae60;">+ Program Baru</a>
        </div>
    </header>

    <?php if (isset($_GET['status'])): ?>
        <div class="alert alert-success">
            <?php 
                if ($_GET['status'] === 'success') {
                    echo "Selamat! Program baru berhasil disimpan.";
                } elseif ($_GET['status'] === 'deleted') {
                    echo "Data program telah berhasil dihapus dari sistem.";
                }
            ?>
            <br>
            <small><a href="data_program.php" style="color: inherit;">[Tutup Pesan]</a></small>
        </div>
    <?php endif; ?>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Nama Program</th>
                <th>Manager</th>
                <th>Durasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><strong><?php echo $row['nama_program']; ?></strong></td>
                <td><?php echo $row['manager']; ?></td>
                <td><?php echo $row['tanggal_mulai']; ?> s/d <?php echo $row['tanggal_selesai']; ?></td>
                <td>
                    <a href="konfirmasi_hapus.php?id=<?php echo $row['program_id']; ?>&nama=<?php echo urlencode($row['nama_program']); ?>" 
                        class="btn-delete" style="background-color: #e74c3c; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px;">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>