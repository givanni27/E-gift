<?php
session_start();
include '../Admin/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nama otomatis dari session, bukan dari input user
    $nama = $_SESSION['username_users'] ?? 'Guest';

    // Ambil data lainnya dari form
    $hp = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    // Hitung total
    $query_total = mysqli_query($koneksi, "SELECT SUM(p.price * o.qty) as total FROM orders o JOIN products p ON o.id_products = p.id_products");
    $data_total = mysqli_fetch_assoc($query_total);
    $total = $data_total['total'];

    if ($total > 0) {
        // Masukkan ke transactions dengan nama_pembeli dari session
        $sql_trans = "INSERT INTO transactions (total_bayar, nama_pembeli, no_hp, alamat) 
                      VALUES ('$total', '$nama', '$hp', '$alamat')";
        mysqli_query($koneksi, $sql_trans);
        $id_transaksi = mysqli_insert_id($koneksi);

        // Pindahkan detail item DAN kurangi stok
        $items = mysqli_query($koneksi, "SELECT * FROM orders JOIN products ON orders.id_products = products.id_products");
        while ($item = mysqli_fetch_assoc($items)) {
            $id_p = $item['id_products'];
            $qty = $item['qty'];
            $harga = $item['price'];

            // Simpan rincian transaksi
            mysqli_query($koneksi, "INSERT INTO transaction_details (id_transaksi, id_products, qty, harga_saat_ini) VALUES ('$id_transaksi', '$id_p', '$qty', '$harga')");

            // update stock ketika user mengcheckout
            mysqli_query($koneksi, "UPDATE products SET stock = stock - $qty WHERE id_products = '$id_p'");
        }

        // menghapus product yang sudah di checkout di keranjang
        mysqli_query($koneksi, "DELETE FROM orders");

        header("Location: index.php?checkout=success&id_inv=" . $id_transaksi);
    } else {
        header("Location: keranjang.php?error=empty");
    }
}
?>