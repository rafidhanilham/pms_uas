<?php
include 'koneksi.php';

$id = $_GET['id'];
$nama = isset($_GET['nama']) ? $_GET['nama'] : "Staf ini";

if (!$id) {
    header("Location: data_staf.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Hapus Staf</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="max-width: 500px; margin: 100px auto; padding: 20px; border: 1px solid #e74c3c; text-align: center; font-family: sans-serif;">
        <h2 style="color: #e74c3c;">Hapus Data Staf?</h2>
        <p>Anda yakin ingin menghapus staf: <strong><?php echo htmlspecialchars($nama); ?></strong>?</p>
        <p style="font-size: 0.8em; color: #666;">Catatan: Tugas yang diberikan kepada staf ini akan kehilangan penanggung jawabnya.</p>
        
        <form action="hapus_staf.php" method="POST" style="margin-top: 20px;">
            <input type="hidden" name="user_id" value="<?php echo $id; ?>">
            
            <a href="data_staf.php" style="padding: 10px 20px; background: #95a5a6; color: white; text-decoration: none; border-radius: 4px; margin-right: 10px;">Batal</a>
            
            <button type="submit" name="proses_hapus" style="padding: 10px 20px; background: #e74c3c; color: white; border: none; border-radius: 4px; cursor: pointer;">Ya, Hapus Sekarang</button>
        </form>
    </div>
</body>
</html>