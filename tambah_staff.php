<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Staff Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Registrasi Staff Baru</h1>
            <a href="index.php">⬅ Kembali ke Dashboard</a>
        </header>

        <form action="proses_tambah_staff.php" method="POST" class="main-form">
            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" name="nama" placeholder="Contoh: Ahmad Fauzi" required>
            </div>

            <div class="form-group">
                <label>Email Korporat:</label>
                <input type="email" name="email" placeholder="contoh@petrokimia.com" required>
            </div>

            <div class="form-group">
                <label>Jabatan/Role:</label>
                <select name="jabatan">
                    <option value="Digital Marketing Staff">Digital Marketing Staff</option>
                    <option value="Marketing Manager">Marketing Manager</option>
                    <option value="Content Creator">Content Creator</option>
                    <option value="Social Media Specialist">Social Media Specialist</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Simpan Data Staff</button>
        </form>
    </div>
</body>
</html>