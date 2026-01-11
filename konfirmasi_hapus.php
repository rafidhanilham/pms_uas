<?php
include 'koneksi.php';

// Ambil data dari URL
$id = $_GET['id'];
$nama = isset($_GET['nama']) ? $_GET['nama'] : "Program ini";

if (!$id) {
    header("Location: data_program.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Hapus - PMS UAS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .confirm-box {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            border: 2px solid #e74c3c;
            border-radius: 8px;
            text-align: center;
            background-color: #fff5f5;
        }
        .btn {
            padding: 10px 20px;
            margin: 10px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-danger { background-color: #e74c3c; color: white; }
        .btn-secondary { background-color: #95a5a6; color: white; }
    </style>
</head>
<body>
    <div class="confirm-box">
        <h2 style="color: #c0392b;">Konfirmasi Penghapusan</h2>
        <p>Apakah Anda yakin ingin menghapus program: <br><strong><?php echo htmlspecialchars($nama); ?></strong>?</p>
        <p style="color: #7f8c8d; font-size: 0.9em;">Peringatan: Tindakan ini akan menghapus semua tugas yang terkait dengan program ini.</p>
        
        <hr>
        
        <form action="hapus_program.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <a href="data_program.php" class="btn btn-secondary">Batal</a>
            <button type="submit" name="confirm_delete" class="btn btn-danger" style="border:none; cursor:pointer;">Ya, Hapus Permanen</button>
        </form>
    </div>
</body>
</html>