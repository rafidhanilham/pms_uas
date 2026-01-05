<?php
include 'koneksi.php';
$query = "SELECT programs.*, users.nama AS manager FROM programs 
          JOIN users ON programs.manager_id = users.user_id";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Program - PMS UAS</title>
    <link rel="stylesheet" href="style.css">
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
                    <a href="hapus_program.php?id=<?php echo $row['program_id']; ?>" 
                       class="btn-delete" 
                       onclick="return confirm('Peringatan: Menghapus program akan menghapus SEMUA tugas di dalamnya. Lanjutkan?')">
                       Hapus
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php if (isset($_GET['status'])): ?>
<script>
    // Ambil nilai status dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'success') {
        alert("Selamat! Program baru berhasil disimpan.");
    } else if (status === 'deleted') {
        alert("Data program telah berhasil dihapus dari sistem.");
    }

    // Membersihkan URL tanpa refresh agar pesan tidak muncul lagi saat di-F5
    window.history.replaceState({}, document.title, window.location.pathname);
</script>
<?php endif; ?>
</body>
</html>