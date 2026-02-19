<?php
session_start();
include '../Admin/database.php';

if (!isset($_SESSION['username_users'])) {
    header("Location: login.php");
    exit;
}

$nama_akun = $_SESSION['username_users'];
$id_inv = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

if (empty($id_inv)) {
    header("Location: history.php");
    exit;
}

$query_trans = mysqli_query($koneksi, "SELECT * FROM transactions WHERE id_transaksi = '$id_inv'");
$trans = mysqli_fetch_assoc($query_trans);

if (!$trans) {
    header("Location: history.php");
    exit;
}

$query_items = mysqli_query($koneksi, "SELECT transaction_details.*, products.name, products.image 
                                      FROM transaction_details 
                                      JOIN products ON transaction_details.id_products = products.id_products 
                                      WHERE id_transaksi = '$id_inv'");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice_#<?= $id_inv ?></title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        /* CSS KHUSUS PRINT */
        @media print {
            @page {
                margin: 0; /* Menghilangkan Header (URL/Judul) dan Footer browser */
            }
            body {
                margin: 1.5cm; /* Memberikan ruang kosong di pinggir kertas agar rapi */
                background-color: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .print\:hidden {
                display: none !important; /* Sembunyikan tombol navigasi saat diprint */
            }
            main {
                max-width: 100% !important;
                padding: 0 !important;
            }
            /* Memastikan warna background muncul di printer tertentu */
            .bg-indigo-600 { background-color: #4f46e5 !important; }
            .bg-gray-900 { background-color: #111827 !important; }
            .bg-gray-50 { background-color: #f9fafb !important; }
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased font-sans">

    <main class="max-w-2xl mx-auto px-4 py-10">
        <a href="history.php"
            class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-indigo-600 transition mb-6 print:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
            </svg>
            KEMBALI KE RIWAYAT
        </a>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-indigo-600 p-8 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-indigo-200 text-[10px] font-bold uppercase tracking-widest">Detail Invoice</p>
                        <h1 class="text-2xl font-black">#INV-<?= $id_inv ?></h1>
                    </div>
                    <span class="px-4 py-1 bg-white/20 rounded-full text-[10px] font-bold backdrop-blur-md">
                        <?= strtoupper($trans['status'] ?? 'PENDING') ?>
                    </span>
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-2 gap-8 mb-8 pb-8 border-b border-gray-100">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter mb-2">Akun Pemesan</p>
                        <p class="text-sm font-bold text-gray-800"><?= htmlspecialchars($trans['nama_pembeli'] ?? $nama_akun) ?></p>
                        <p class="text-xs text-gray-500 mt-1"><?= htmlspecialchars($trans['no_hp'] ?? '') ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter mb-2">Alamat Tujuan</p>
                        <p class="text-xs text-gray-600 leading-relaxed"><?= htmlspecialchars($trans['alamat'] ?? 'Alamat tidak ditemukan') ?></p>
                    </div>
                </div>

                <div class="space-y-6 mb-8">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Item yang Dibeli</p>
                    <?php while ($item = mysqli_fetch_assoc($query_items)): ?>
                        <div class="flex items-center gap-4">
                            <img src="../Admin/image/<?= $item['image'] ?>" class="size-14 rounded-xl object-cover bg-gray-100 border border-gray-100">
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-gray-800"><?= htmlspecialchars($item['name']) ?></h4>
                                <p class="text-xs text-gray-400"><?= $item['qty'] ?> x Rp<?= number_format($item['harga_saat_ini'], 0, ',', '.') ?></p>
                            </div>
                            <p class="text-sm font-bold text-gray-900">Rp<?= number_format($item['harga_saat_ini'] * $item['qty'], 0, ',', '.') ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 font-medium">Subtotal</span>
                        <span class="font-bold">Rp<?= number_format($trans['total_bayar'], 0, ',', '.') ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 font-medium">Biaya Layanan</span>
                        <span class="font-bold text-green-600">FREE</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                        <span class="font-black text-gray-900 uppercase text-xs">Total Pembayaran</span>
                        <span class="text-xl font-black text-indigo-600">Rp<?= number_format($trans['total_bayar'], 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-gray-900 text-white flex justify-between items-center">
                <div class="flex flex-col">
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-tight">Waktu Transaksi</p>
                    <p class="text-xs italic font-medium">
                        <?= isset($trans['tgl_transaksi']) ? date('d F Y - H:i', strtotime($trans['tgl_transaksi'])) : '-' ?>
                    </p>
                </div>
                <button onclick="window.print()" class="p-3 bg-white/10 hover:bg-white/20 rounded-xl transition print:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                </button>
            </div>
        </div>

        <p class="text-center text-[10px] text-gray-300 mt-8 font-bold uppercase tracking-[0.2em]">Terima kasih telah berbelanja</p>
    </main>

</body>
</html>