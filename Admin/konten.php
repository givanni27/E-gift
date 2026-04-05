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
            include('content/product.php');
            break;

        case 'pesanan':
            include('content/pesanan.php');
            break;
    }
} else {
    include('content/dashboard.php');
}
