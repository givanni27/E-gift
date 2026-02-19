<?php
session_start();
include('../database.php');

if (!isset($_SESSION['id_admin']))
    exit(header('Location: login.php'));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proses'])) {
    extract($_POST);

    // 1. Ambil Nama Gambar Lama (Jika Edit)
    $image_db = "default.jpg";
    if ($proses === 'edit') {
        $old = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT image FROM products WHERE id_products = '$id_products'"));
        $image_db = $old['image'];
    }

    // 2. Logika Olah Gambar (Sama persis dengan kode Tambah)
    if ($_FILES['image']['error'] === 0) {
        $tmpName = $_FILES['image']['tmp_name'];
        $ekstensi = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $namaFileBaru = uniqid() . '.' . $ekstensi;
        $tujuan = '../image/' . $namaFileBaru;

        // Ambil info ukuran & buat gambar otomatis
        list($w_asli, $h_asli) = getimagesize($tmpName);
        $source = imagecreatefromstring(file_get_contents($tmpName));

        if ($source) {
            $canvas = imagecreatetruecolor(600, 600);
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);

            // Logika Crop Tengah (Identik dengan kode Tambah)
            if ($w_asli > $h_asli) {
                $cut = $h_asli;
                $x = (int) (($w_asli - $h_asli) / 2);
                $y = 0;
            } else {
                $cut = $w_asli;
                $x = 0;
                $y = (int) (($h_asli - $w_asli) / 2);
            }

            imagecopyresampled($canvas, $source, 0, 0, $x, $y, 600, 600, $cut, $cut);

            // Simpan sesuai format asli
            if ($ekstensi == 'png')
                imagepng($canvas, $tujuan, 9);
            elseif ($ekstensi == 'webp')
                imagewebp($canvas, $tujuan, 80);
            else
                imagejpeg($canvas, $tujuan, 90);

            // Hapus gambar lama jika proses EDIT dan ganti gambar
            if ($proses === 'edit' && $image_db != "default.jpg" && file_exists('../image/' . $image_db)) {
                @unlink('../image/' . $image_db);
            }

            $image_db = $namaFileBaru; // Update variabel untuk database
            imagedestroy($canvas);
            imagedestroy($source);
        }
    }

    // 3. Query Eksekusi
    $name = mysqli_real_escape_string($koneksi, $name);
    $sql = ($proses === 'tambah')
        ? "INSERT INTO products (name, price, stock, image, id_category) VALUES ('$name', '$price', '$stock', '$image_db', '$id_category')"
        : "UPDATE products SET name='$name', price='$price', stock='$stock', image='$image_db', id_category='$id_category' WHERE id_products='$id_products'";

    mysqli_query($koneksi, $sql);
    header("location:../index.php?menu=project");
}

// 4. Logika Delete
if (isset($_GET['proses']) && $_GET['proses'] === 'delete') {
    $id = $_GET['id_products'];
    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT image FROM products WHERE id_products = '$id'"));
    if ($data['image'] != 'default.jpg')
        @unlink("../image/" . $data['image']);
    mysqli_query($koneksi, "DELETE FROM products WHERE id_products = '$id'");
    header("location:../index.php?menu=project");
}