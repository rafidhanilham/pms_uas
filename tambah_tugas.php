<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tugas Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Tambah Tugas Baru</h1>
            <a href="index.php">⬅ Kembali ke Dashboard</a>
        </header>

        <form action="proses_tambah.php" method="POST" class="main-form">
            <div class="form-group">
                <label>Nama Tugas:</label>
                <input type="text" name="nama_tugas" required>
            </div>

            <div class="form-group">
                <label>Pilih Program:</label>
                <select name="program_id">
                    <?php
                    $prog = mysqli_query($conn, "SELECT * FROM programs");
                    while($p = mysqli_fetch_array($prog)) {
                        echo "<option value='".$p['program_id']."'>".$p['nama_program']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Penanggung Jawab:</label>
                <select name="assigned_to">
                    <?php
                    $user = mysqli_query($conn, "SELECT * FROM users");
                    while($u = mysqli_fetch_array($user)) {
                        echo "<option value='".$u['user_id']."'>".$u['nama']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Deadline:</label>
                <input type="datetime-local" name="deadline" required>
            </div>

            <button type="submit" class="btn-submit">Simpan Tugas</button>
        </form>
    </div>
</body>
</html>