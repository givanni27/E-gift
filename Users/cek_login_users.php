<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1); // Munculkan error jika ada

include '../Admin/database.php';

$Password = $_POST['Password'];
$Email = $_POST['Email'];

$query = "SELECT * FROM users WHERE email= '$Email' AND password = '$Password'";
$sql = mysqli_query($koneksi, $query);

if (!$sql) {
    die("Query Error: " . mysqli_error($koneksi)); // Cek apakah tabel/kolom salah nama
}

$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    $row = mysqli_fetch_array($sql);
    $_SESSION['id_users'] = $row['id_users'];
    $_SESSION['username_users'] = $row['username_users'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['berhasil'] = true;

    echo "Login Berhasil, mencoba pindah halaman..."; 
    header('location:index.php');
    exit();
} else {
    header('location:login.php?pesan=gagal');
    exit();
}
