<?php
session_start();
include ('../Admin/database.php');

$Password = $_POST['Password'];
$Email = $_POST['Email'];

$query = "SELECT * FROM users WHERE email= '$Email' AND password = '$Password'";
$sql = mysqli_query($koneksi, $query);
$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    $row = mysqli_fetch_array($sql);
    $_SESSION['id_users'] = $row['id_users'];
    $_SESSION['username_users'] = $row['username_users'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['berhasil'] = true;
    header('location:index.php'); // Pastikan tidak ada enter di atas baris ini
    exit(); 
} else {
    header('location:login.php?pesan=gagal');
    exit();
}



