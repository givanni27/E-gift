<?php
include '../Admin/database.php';

// Cek apakah ada kiriman data dari form Beli Sekarang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_products'])) {
    $id_products = mysqli_real_escape_string($koneksi, $_POST['id_products']);
    // Jika qty tidak dikirim (dari modal index), set default 1
    $qty = isset($_POST['qty']) ? (int) $_POST['qty'] : 1;

    // 1. Cek apakah produk sudah ada di tabel orders
    $cek = mysqli_query($koneksi, "SELECT * FROM orders WHERE id_products = '$id_products'");

    if (mysqli_num_rows($cek) > 0) {
        // 2. Jika ada, tambah jumlahnya
        mysqli_query($koneksi, "UPDATE orders SET qty = qty + $qty WHERE id_products = '$id_products'");
    } else {
        // 3. Jika belum, masukkan baru
        mysqli_query($koneksi, "INSERT INTO orders (id_products, qty) VALUES ('$id_products', '$qty')");
    }

    // Redirect ke halaman yang sama (GET) untuk menghindari pengiriman ulang form
    header("Location: keranjang.php");
    exit;
}

// Query untuk menampilkan data
$query = mysqli_query($koneksi, "SELECT orders.*, products.name, products.price, products.stock, products.image FROM orders JOIN products ON orders.id_products = products.id_products");
$subtotal = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../Users/assets/src/output.css" rel="stylesheet">
    <style>
        /* Sembunyikan scrollbar di iframe agar rapi */
        body::-webkit-scrollbar {
            display: none;
        }

        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-white-600 dark:bg-gray-900 antialiased">
    <div class="flex flex-col md:flex-row h-full">
        <div class="w-full md:w-1/2 h-64 md:h-full bg-gray-100 dark:bg-gray-800">
            <img src="../Admin/image/<?= $p['image'] ?>" class="w-full h-full object-cover">
        </div>

        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <p class="text-sm font-semibold text-indigo-600 uppercase mb-2"><?= $p['name_category'] ?></p>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4"><?= $p['name'] ?></h1>
            

            <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Rp<?= number_format($p['price'], 0, ',', '.') ?>
            </p>

            <div class="space-y-4 border-t border-gray-100 dark:border-gray-800 pt-6">
                <form action="./keranjang.php" method="POST" target="_parent">
                    <input type="hidden" name="id_products" value="<?= $p['id_products'] ?>">
                    <input type="number" name="qty" value="1" min="1">

                    <div class="flex flex-col gap-3">
                        <button type="submit" name="checkout" value="checkout"
                            class="w-full border-2 border-indigo-600 py-3 px-6 rounded-xl font-bold text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-800 transition-colors">
                            Beli Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>