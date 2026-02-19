<?php
include '../Admin/database.php';

// 1. Ambil ID dari tabel orders yang dikirim lewat URL
if (isset($_GET['id'])) {
    $id_orders = $_GET['id'];

    // 2. Hapus baris data di tabel orders berdasarkan ID tersebut
    $query = "DELETE FROM orders WHERE id_orders = '$id_orders'";
    $hapus = mysqli_query($koneksi, $query);

    if ($hapus) {
        // 3. Jika berhasil, kembali ke keranjang
        header("Location: keranjang.php");
    } else {
        echo "Gagal menghapus item: " . mysqli_error($koneksi);
    }
} else {
    header("Location: keranjang.php");
}
?>