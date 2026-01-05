<?php
include 'koneksi.php';

$nama    = $_POST['nama'];
$email   = $_POST['email'];
$jabatan = $_POST['jabatan'];

$query = "INSERT INTO users (nama, email, jabatan) VALUES ('$nama', '$email', '$jabatan')";

if (mysqli_query($conn, $query)) {
    // Kembali ke index dengan status sukses
    header("Location: index.php?status=staff_success");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>