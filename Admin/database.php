<?php
$host     = "db";
$username = "db";
$password = "db";
$database = "db";

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
