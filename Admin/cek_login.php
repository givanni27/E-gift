<?php
// aktifkan session
session_start();

// include database
include 'database.php';

// mengambil dari form login.php
$username = $_POST['username'];
$password = $_POST['password'];

// mengambil data dari database
$query = "SELECT * FROM admin WHERE username_admin = '$username' AND password = '$password'";
$sql = mysqli_query($koneksi, $query);

// mengecek data
$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    $row = mysqli_fetch_array($sql);
    $_SESSION['id_admin'] = $row['id_admin'];
    $_SESSION['username_admin'] = $row['username_admin'];

    header('location:index.php');
} else {
    header('location:login.php?pesan=gagal');
}
