<?php
include 'koneksi.php';

// Gunakan mysqli_real_escape_string untuk mencegah error syntax dan SQL Injection
$nama_program = mysqli_real_escape_string($conn, $_POST['nama_program']);
$deskripsi    = mysqli_real_escape_string($conn, $_POST['deskripsi']);
$tgl_mulai    = $_POST['tanggal_mulai'];
$tgl_selesai  = $_POST['tanggal_selesai'];
$manager_id   = $_POST['manager_id'];

// Pastikan penulisan query INSERT INTO programs benar
$query = "INSERT INTO programs (nama_program, deskripsi, tanggal_mulai, tanggal_selesai, status, manager_id) 
          VALUES ('$nama_program', '$deskripsi', '$tgl_mulai', '$tgl_selesai', 'Planning', '$manager_id')";

if (mysqli_query($conn, $query)) {
    header("Location: data_program.php?status=success"); 
} else {
    // Menampilkan pesan error yang lebih detail jika gagal
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>