<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Program Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Tambah Program Marketing Baru</h1>
            <a href="index.php">⬅ Kembali ke Dashboard</a>
        </header>

        <form action="proses_tambah_program.php" method="POST" class="main-form">
            <div class="form-group">
                <label>Nama Program/Campaign:</label>
                <input type="text" name="nama_program" placeholder="Contoh: Buat Promo 12.12" required>
            </div>

            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea name="deskripsi" rows="4" style="padding:10px; border-radius:4px; border:1px solid #ccc;"></textarea>
            </div>

            <div style="display: flex; gap: 20px;">
                <div class="form-group" style="flex: 1;">
                    <label>Tanggal Mulai:</label>
                    <input type="date" name="tanggal_mulai" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Tanggal Selesai:</label>
                    <input type="date" name="tanggal_selesai" required>
                </div>
            </div>

            <div class="form-group">
                <label>Manager Program:</label>
                <select name="manager_id">
                    <?php
                    $user = mysqli_query($conn, "SELECT * FROM users");
                    while($u = mysqli_fetch_array($user)) {
                        echo "<option value='".$u['user_id']."'>".$u['nama']."</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn-submit" style="background-color: #3498db;">Simpan Program</button>
        </form>
    </div>
</body>
</html>