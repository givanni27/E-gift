<?php
session_start();
include '../database.php'; // Sesuaikan path jika file ini di dalam folder 'proses'

if (isset($_REQUEST['proses'])) {
    $proses = $_REQUEST['proses'];

    // 1. PROSES UPDATE STATUS
    if ($proses == 'update_status') {
        $id_transaksi = mysqli_real_escape_string($koneksi, $_POST['id_transaksi']);
        $status = mysqli_real_escape_string($koneksi, $_POST['status']);

        $query = "UPDATE transactions SET status = '$status' WHERE id_transaksi = '$id_transaksi'";
        $update = mysqli_query($koneksi, $query);

        if ($update) {
            header("Location: ../index.php?menu=pesanan&status=updated");
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }

    // 2. PROSES HAPUS PESANAN
    if ($proses == 'delete') {
        $id_transaksi = mysqli_real_escape_string($koneksi, $_GET['id']);

        // Hapus detail transaksi terlebih dahulu (Foreign Key Guard)
        mysqli_query($koneksi, "DELETE FROM transaction_details WHERE id_transaksi = '$id_transaksi'");

        // Hapus data transaksi utama
        $delete = mysqli_query($koneksi, "DELETE FROM transactions WHERE id_transaksi = '$id_transaksi'");

        if ($delete) {
            header("Location: ../index.php?menu=pesanan&status=deleted");
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
} else {
    // Jika akses langsung tanpa parameter
    header("Location: ../index.php?menu=pesanan");
}