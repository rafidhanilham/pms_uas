<?php
include 'koneksi.php';
$id = $_GET['id'];

$query = "DELETE FROM programs WHERE program_id = '$id'";

if (mysqli_query($conn, $query)) {
    // Tambahkan parameter status=deleted
    header("Location: data_program.php?status=deleted");
} else {
    echo "Gagal menghapus program: " . mysqli_error($conn);
}
?>