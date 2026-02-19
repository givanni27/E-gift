<?php
// Tampilkan error biar kalau ada masalah gak putih lagi
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Railway biasanya kasih variable ini otomatis kalau kita pake MySQL Railway
$host = getenv('MYSQLHOST') ?: 'db'; 
$user = getenv('MYSQLUSER') ?: 'db';
$pass = getenv('MYSQLPASSWORD') ?: 'db';
$db   = getenv('MYSQLDATABASE') ?: 'db';
$port = getenv('MYSQLPORT') ?: '3306';

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Aduh, koneksi database gagal: " . mysqli_connect_error());
}
?>
