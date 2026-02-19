<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Pesanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?menu=dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Pesanan Masuk</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Transaksi Masuk</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped projects text-sm">
                        <thead>
                            <tr>
                                <th style="width: 120px" class="text-center">ID Invoice</th>
                                <th style="width: 200px">Pelanggan</th>
                                <th class="text-center">Total Bayar</th>
                                <th style="width: 150px" class="text-center">Tanggal</th>
                                <th style="width: 100px" class="text-center">Status</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM transactions ORDER BY tgl_transaksi DESC";
                            $sql = mysqli_query($koneksi, $query);
                            $data_modal = []; // Penampung data untuk modal di luar loop tabel
                            while ($row = mysqli_fetch_array($sql)):
                                $data_modal[] = $row; // Simpan row ke array
                                $id_transaksi = $row['id_transaksi'] ?? '';
                                $nama_pembeli = $row['nama_pembeli'] ?? 'Anonim';
                                $no_hp = $row['no_hp'] ?? '';
                                $status = $row['status'] ?? 'Pending';
                                $total = $row['total_bayar'] ?? 0;
                                $tgl = $row['tgl_transaksi'] ?? date('Y-m-d H:i:s');

                                $badgeClass = match ($status) {
                                    'Selesai' => 'badge-success',
                                    'Proses' => 'badge-primary',
                                    'Dibatalkan' => 'badge-danger',
                                    default => 'badge-warning',
                                };
                                ?>
                                <tr>
                                    <td class="text-center font-weight-bold text-primary">
                                        #INV-<?= $id_transaksi ?>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold"><?= htmlspecialchars($nama_pembeli) ?></span>
                                        <br />
                                        <small class="text-muted">WA: <?= htmlspecialchars($no_hp) ?></small>
                                    </td>
                                    <td class="text-center font-weight-bold">
                                        Rp<?= number_format((float) $total, 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        <small><?= date('d/m/Y H:i', strtotime($tgl)) ?></small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $badgeClass ?>"><?= strtoupper($status) ?></span>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a data-toggle="modal" data-target="#viewDetail<?= $id_transaksi ?>"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-sm"
                                            href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $no_hp) ?>"
                                            target="_blank">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#editStatus<?= $id_transaksi ?>"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            href="proses/proses_pesanan.php?proses=delete&id=<?= $id_transaksi ?>"
                                            onclick="return confirm('Hapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php foreach ($data_modal as $m):
        $id_m = $m['id_transaksi'];
        $status_m = $m['status'] ?? 'Pending';
        ?>
        <div class="modal fade" id="editStatus<?= $id_m ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Update Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form action="proses/proses_pesanan.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_transaksi" value="<?= $id_m ?>">
                            <div class="form-group">
                                <label>Status Pesanan</label>
                                <select name="status" class="form-control">
                                    <option value="Pending" <?= $status_m == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Proses" <?= $status_m == 'Proses' ? 'selected' : '' ?>>Proses</option>
                                    <option value="Selesai" <?= $status_m == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                    <option value="Dibatalkan" <?= $status_m == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="proses" value="update_status"
                                class="btn btn-primary btn-block">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewDetail<?= $id_m ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold">Detail Pesanan #INV-<?= $id_m ?></h5>
                        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted text-xs font-weight-bold uppercase">Penerima:</p>
                                <p class="mb-0 font-weight-bold"><?= htmlspecialchars($m['nama_pembeli'] ?? '') ?></p>
                                <p class="text-xs"><?= htmlspecialchars($m['no_hp'] ?? '') ?></p>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <p class="mb-1 text-muted text-xs font-weight-bold uppercase">Alamat Tujuan:</p>
                                <p class="text-xs"><?= htmlspecialchars($m['alamat'] ?? '-') ?></p>
                            </div>
                        </div>
                        <table class="table table-bordered table-sm">
                            <thead class="bg-light text-xs font-weight-bold">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center" style="width: 80px">Jumlah</th>
                                    <th class="text-right" style="width: 150px">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs">
                                <?php
                                $d_sql = mysqli_query($koneksi, "SELECT td.*, p.name FROM transaction_details td JOIN products p ON td.id_products = p.id_products WHERE td.id_transaksi = '$id_m'");
                                while ($it = mysqli_fetch_assoc($d_sql)):
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($it['name']) ?></td>
                                        <td class="text-center"><?= $it['qty'] ?></td>
                                        <td class="text-right">
                                            Rp<?= number_format($it['harga_saat_ini'] * $it['qty'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-right uppercase">Total Bayar</th>
                                    <th class="text-right text-primary">
                                        Rp<?= number_format($m['total_bayar'], 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>