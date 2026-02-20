<?php
session_start();

// include database
include '../Admin/database.php';

$Password = $_POST['Password'];
$Email = $_POST['Email'];

$query = "SELECT * FROM users WHERE email= '$Email' AND password = '$Password'";
$sql = mysqli_query($koneksi, $query);

// mengecek data
$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    $row = mysqli_fetch_array($sql);
    
    // Simpan data ke session
    $_SESSION['id_users'] = $row['id_users'];
    $_SESSION['username_users'] = $row['username_users'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['berhasil'] = true;

    // Redirect ke index.php (tanpa folder Users karena file ini satu level)
    header('Location: index.php');
    exit();
} else {
    header('Location: login.php?pesan=gagal');
    exit();
}
