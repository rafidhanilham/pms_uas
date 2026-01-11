<?php
include 'koneksi.php';

if (isset($_POST['confirm_delete'])) {
    $id = $_POST['id'];

    // Query hapus
    $query = "DELETE FROM programs WHERE program_id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Kembali ke halaman utama dengan status deleted
        header("Location: data_program.php?status=deleted");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    // Jika diakses tanpa form, lempar balik
    header("Location: data_program.php");
}
?>