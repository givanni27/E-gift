<?php
include '../Admin/database.php';

// Quickview
if (isset($_POST['id_products']) && isset($_POST['qty'])) {
    $id_products = $_POST['id_products'];
    $qty = $_POST['qty'];

    $cek = mysqli_query($koneksi, "SELECT * FROM orders WHERE id_products = '$id_products'");

    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($koneksi, "UPDATE orders SET qty = qty + $qty WHERE id_products = '$id_products'");
    } else {
        mysqli_query($koneksi, "INSERT INTO orders (id_products, qty) VALUES ('$id_products', '$qty')");
    }

    header("Location: keranjang.php");
    exit;
}

// Show data
  $query = mysqli_query($koneksi, "SELECT orders.*, products.name, products.price, products.image FROM orders JOIN products ON orders.id_products = products.id_products");
  $subtotal = 0;
?>

<html>

<head>
    <link rel="stylesheet" href="../Users/assets/src/output.css" />
    <script src="../Users/assets/src/elements.js"></script>
</head>

<body class="bg-gray-50">
    <section>
        <div class="mx-auto mt-8 max-w-7xl px-8 py-8 sm:px-6 sm:py-12 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <header class="text-center">
                    <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Keranjang kamu</h1>
                </header>

                <div class="mt-8">
                    <ul class="space-y-4">
                        <?php while ($row = mysqli_fetch_assoc($query)):
                            $item_total = $row['price'] * $row['qty'];
                            $subtotal += $item_total;
                            ?>
                            <li class="flex items-center gap-4 bg-white p-4 rounded-lg shadow-sm">
                                <img src="../Admin/image/<?= $row['image'] ?>" alt="<?= $row['name'] ?>"
                                    class="size-16 rounded-sm object-cover">
                                <div>
                                    <h3 class="text-sm text-gray-900 font-semibold"><?= $row['name'] ?></h3>
                                    <dl class="mt-0.5 space-y-px text-[10px] text-gray-600">
                                        <div>
                                            <dt class="inline">Harga:</dt>
                                            <dd class="inline">Rp<?= number_format($row['price'], 0, ',', '.') ?></dd>
                                        </div>
                                        <div>
                                            <dt class="inline">Jumlah:</dt>
                                            <dd class="inline"><?= $row['qty'] ?></dd>
                                        </div>
                                    </dl>
                                </div>

                                <div class="flex flex-1 items-center justify-end gap-2">
                                    <span
                                        class="text-sm font-bold text-gray-800">Rp<?= number_format($item_total, 0, ',', '.') ?></span>
                                    <a href="hapus.php?id=<?= $row['id_orders'] ?>"
                                        class="text-gray-400 hover:text-red-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </a>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                    <div class="mt-10 flex justify-end border-t border-gray-300 pt-8">
                        <div class="w-screen max-w-lg space-y-4">
                            <dl class="flex justify-between text-base font-bold text-gray-900">
                                <dt>Total Keseluruhan</dt>
                                <dd>Rp<?= number_format($subtotal, 0, ',', '.') ?></dd>
                            </dl>

                            <div class="flex justify-end gap-2">
                                <a href="index.php"
                                    class="rounded-md border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">Lanjut
                                    Belanja</a>
                                <button onclick="openModal()"
                                    class="rounded-md bg-indigo-600 px-5 py-3 text-sm font-medium text-white hover:bg-indigo-700 transition">
                                    Checkout Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="modalForm" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-8 shadow-2xl transform transition-all">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Data Pengiriman</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>

            <form action="proses_checkout.php" method="POST" class="space-y-4">

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">No. WhatsApp</label>
                    <input type="tel" name="hp" required placeholder="0812xxxx"
                        class="w-full rounded-lg border-gray-200 p-3 text-sm border focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" required rows="3" placeholder="Nama jalan, Nomor rumah, Kec/Kota..."
                        class="w-full rounded-lg border-gray-200 p-3 text-sm border focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full rounded-xl bg-indigo-600 py-3 font-bold text-white hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all active:scale-95">
                        Konfirmasi & Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('modalForm');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('modalForm');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Tutup modal jika user klik di area luar kotak putih
        window.onclick = function (event) {
            const modal = document.getElementById('modalForm');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>