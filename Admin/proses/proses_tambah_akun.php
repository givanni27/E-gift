<?php
session_start();
include('../database.php');

if (!isset($_SESSION['id_admin']))
    exit(header('Location: login.php'));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proses'])) {
    extract($_POST);

    $name = mysqli_real_escape_string($koneksi, $name);
    $sql = ($proses === 'tambah')
        ? "INSERT INTO users (username_users, password, email) VALUES ('$username_users', '$password', '$email')"
        : "UPDATE users SET username_users='$username_users', password='$password', email='$email' WHERE id_users='$id_users'";

    mysqli_query($koneksi, $sql);
    header("Location: ../index.php?menu=daftar_akun");
}

// 4. Logika Delete
if (isset($_GET['proses']) && $_GET['proses'] === 'delete') {
    $id_users = $_GET['id_users'];
    $nama_pembeli = $_GET['nama_pembeli'];

    mysqli_query($koneksi, "DELETE FROM transactions WHERE nama_pembeli = '$nama_pembeli'");
    mysqli_query($koneksi, "DELETE FROM users WHERE id_users = '$id_users'");
    header("Location: ../index.php?menu=daftar_akun");
}
