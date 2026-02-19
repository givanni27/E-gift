<?php
// Mengambil data dari "catatan rahasia" Railway
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = getenv('DB_PORT');

// Cara nyambunginnya
$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Aduh, gagal nyambung: " . mysqli_connect_error());
}
// Kalau sukses, aplikasi kamu sudah bisa baca database-mu sendiri!
?>
