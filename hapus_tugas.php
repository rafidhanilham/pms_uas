<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Jalankan query hapus
$query = "DELETE FROM tasks WHERE task_id = '$id'";

if (mysqli_query($conn, $query)) {
    // Jika berhasil, kembali ke halaman utama
    header("Location: index.php");
} else {
    echo "Gagal menghapus: " . mysqli_error($conn);
}
?>