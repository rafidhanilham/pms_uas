<?php
include 'koneksi.php';

// Pastikan proses penghapusan datang dari form POST (Konfirmasi)
if (isset($_POST['proses_hapus'])) {
    
    // PERBAIKAN: Gunakan mysqli_real_escape_string, bukan mysqli_real_escape_id
    $id = mysqli_real_escape_string($conn, $_POST['user_id']);

    // Query untuk menghapus staf berdasarkan ID
    $query = "DELETE FROM users WHERE user_id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Jika berhasil, lempar kembali ke index (Dashboard) dengan status deleted
        header("Location: index.php?status=deleted");
        exit();
    } else {
        // Jika gagal karena ada relasi database (staf masih punya tugas)
        die("Gagal menghapus staf: " . mysqli_error($conn));
    }
} else {
    // Jika file diakses langsung tanpa lewat form konfirmasi
    header("Location: index.php");
    exit();
}
?>