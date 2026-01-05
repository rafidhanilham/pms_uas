<?php
include 'koneksi.php';

$nama_tugas = $_POST['nama_tugas'];
$program_id = $_POST['program_id'];
$assigned_to = $_POST['assigned_to'];
$deadline = $_POST['deadline'];

$query = "INSERT INTO tasks (program_id, nama_tugas, deadline, assigned_to, status) 
          VALUES ('$program_id', '$nama_tugas', '$deadline', '$assigned_to', 'To Do')";

if (mysqli_query($conn, $query)) {
    header("Location: index.php"); // Jika berhasil, balik ke dashboard
} else {
    echo "Error: " . mysqli_error($conn);
}
?>