<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_pms";

// Menghilangkan pesan error default dari PHP agar tidak membingungkan
mysqli_report(MYSQLI_REPORT_OFF);

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    // Pesan error yang lebih rapi
    die("Koneksi ke database '$db' gagal: " . mysqli_connect_error());
}

// Tambahkan ini agar mendukung karakter khusus/simbol
mysqli_set_charset($conn, "utf8mb4");
?>