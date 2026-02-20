<?php
// Mengambil data dari environment variables Railway
$host = "mysql.railway.internal";
$user = "root";
$pass = "dftQWOjFdpLtcZkGUZzgMOsluGVBBiBD"; // Sesuai gambar variabel kamu
$db   = "railway";
$port = "3306";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
