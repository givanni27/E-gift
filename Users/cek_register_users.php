<?php
session_start();
include '../Admin/database.php';

// Get form data
$Username = mysqli_real_escape_string($koneksi, $_POST['Username']);
$Email = mysqli_real_escape_string($koneksi, $_POST['Email']); // NEW variable
$Password = $_POST['Password'];
$Confirm_Password = $_POST['Confirm_Password'];

// Simple validation
if ($Password !== $Confirm_Password) {
    header('Location:register.php?error=password_tidaksama');
    exit();
}

// Check if username already exists
$checkUserQuery = "SELECT * FROM users WHERE username_users = '$Username'";
$result = mysqli_query($koneksi, $checkUserQuery);
if (mysqli_num_rows($result) > 0) {
    header('Location: register.php?error=user_ada');
    exit();
}

// Hash the password (use password_hash for security)

// Insert user data with nama_masyarakat
$insertQuery = "INSERT INTO users (username_users, password, email) 
                VALUES ('$Username', '$Password', '$Email')";


if (mysqli_query($koneksi, $insertQuery)) {
    // Registration success, redirect to login or dashboard
    header('Location: login.php?success=registered');
} else {
    // Registration failed
    header('Location: ./Users/register.php?error=registration_failed');
}
