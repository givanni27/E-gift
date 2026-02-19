<?php
//mengecek parameter menu yang ada di url
if (isset($_GET['menu'])) {
    $m = $_GET['menu'];

    switch ($m) {
        case 'dashboard':
            include('content/dashboard.php');
            break;

        case 'proses_tambah':
            include('proses/proses_tambah.php');
            break;

        case 'project':
            include('content/project.php');
            break;

        case 'pesanan':
            include('content/pesanan.php');
            break;

        case 'pengaduan_selesai':
            include('konten/pengaduan_selesai.php');
            break;
        case 'pengaduan_detail_selesai':
            include('konten/pengaduan_detail_selesai.php');
            break;
        case 'laporan_pengaduan':
            include('konten/laporan_pengaduan.php');
            break;
        case 'cetak_laporan':
            include('konten/cetak_laporan.php');
            break;
    }
} else {
    include('content/dashboard.php');
}
