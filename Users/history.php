<?php
session_start();
include '../Admin/database.php';

if (!isset($_SESSION['username_users'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username_users'];
$query = mysqli_query($koneksi, "SELECT * FROM transactions WHERE nama_pembeli = '$username' ORDER BY tgl_transaksi DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        @theme {
            --color-primary: #6366f1;
        }
    </style>
</head>

<body class="bg-gray-50 antialiased">

    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-3xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="index.php" class="flex items-center gap-2 text-gray-600 hover:text-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-bold">Kembali</span>
            </a>
            <div class="text-sm font-medium text-gray-500">Akun: <span class="text-gray-900"><?= $username ?></span>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 py-8">
        <header class="mb-8">
            <h1 class="text-2xl font-black text-gray-900">Riwayat Pesanan</h1>
            <p class="text-sm text-gray-500">Daftar transaksi yang pernah kamu lakukan.</p>
        </header>

        <div class="grid gap-4">
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query)):
                    $status = $row['status'] ?? 'Pending';
                    $statusClasses = match ($status) {
                        'Selesai' => 'bg-green-50 text-green-700 border-green-200',
                        'Proses' => 'bg-blue-50 text-blue-700 border-blue-200',
                        default => 'bg-amber-50 text-amber-700 border-amber-200',
                    };
                    ?>
                    <div
                        class="group bg-white border border-gray-200 rounded-2xl p-5 hover:border-primary/50 transition-all shadow-xs">
                        <div class="flex flex-wrap justify-between items-start gap-4">
                            <div class="space-y-1">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="text-sm font-mono font-bold text-gray-900 tracking-tight">#INV-<?= $row['id_transaksi'] ?></span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border <?= $statusClasses ?>">
                                        <?= strtoupper($status) ?>
                                    </span>
                                </div>
                                <p class="text-[11px] text-gray-400 font-medium italic">
                                    <?= date('d M Y • H:i', strtotime($row['tgl_transaksi'])) ?>
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Total Bayar</p>
                                <p class="text-lg font-black text-primary italic">
                                    Rp<?= number_format($row['total_bayar'], 0, ',', '.') ?></p>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-50 flex justify-end">
                            <a href="detail_pesanan.php?id=<?= $row['id_transaksi'] ?>"
                                class="text-xs font-bold text-gray-400 group-hover:text-primary flex items-center gap-1 transition-colors">
                                LIHAT DETAIL
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="py-20 text-center border-2 border-dashed border-gray-200 rounded-3xl">
                    <p class="text-gray-400 font-medium">Belum ada transaksi.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>

</html>