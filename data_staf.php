<?php
include 'koneksi.php';

// 1. Ambil data staf dari database
$query = "SELECT * FROM users ORDER BY nama ASC";
$result = mysqli_query($conn, $query);

// 2. Cek apakah query berhasil
if (!$result) {
    die("Kesalahan Query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Staf - PMS UAS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Styling tambahan agar serasi dengan Dashboard */
        .container { padding: 20px; max-width: 1000px; margin: auto; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-back { text-decoration: none; color: #3498db; font-weight: bold; }
        .btn-delete-php {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">
    <header class="header-flex">
        <h1>Manajemen Data Staf</h1>
        <a href="index.php" class="btn-back">🏠 Kembali ke Dashboard</a>
    </header>

    <main>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nama Staf</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($row['nama']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['jabatan']); ?></td>
                        <td><span class="badge"><?php echo htmlspecialchars($row['role']); ?></span></td>
                        <td>
                            <a href="konfirmasi_hapus_staf.php?id=<?php echo $row['user_id']; ?>&nama=<?php echo urlencode($row['nama']); ?>" 
                               class="btn-delete-php">
                               Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">Belum ada data staf dalam database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>