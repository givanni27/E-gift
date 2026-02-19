<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?menu=dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar produk</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                    <a class="btn btn-tool" title="Add New" data-toggle="modal" data-target="#modalformulir">
                        <i class="fas fa-file-import"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 20px" class="text-center">id</th>
                                <th style="width: 150px">Nama barang</th>
                                <th style="width: 120px" class="text-center">Gambar</th>
                                <th style="width: 100px" class="text-center">Stok</th>
                                <th style="width: 120px" class="text-center">id_Kategory</th>
                                <th style="width: 10px;" class="text-center">Status</th>
                                <th style="width: 10px;" class="text-center">Kategory</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT products.*, category.name_category FROM products LEFT JOIN category ON products.id_category = category.id";
                            $sql = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_array($sql)):
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $row['id_products']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                        <br />
                                        <small class="text-muted">
                                            Rp<?php echo number_format($row['price'], 0, ',', '.'); ?>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <img alt="<?php echo $row['name']; ?>"
                                                    src="../Admin/image/<?php echo $row['image']; ?>"
                                                    style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #adb5bd; cursor: pointer;"
                                                    data-toggle="modal"
                                                    data-target="#modalGambar<?php echo $row['id_products']; ?>">
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-info"><?php echo $row['stock']; ?> Pcs</span>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['id_category']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($row['stock'] > 0): ?>
                                            <span class="badge badge-success">Tersedia</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Habis</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['name_category']; ?>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a data-toggle="modal" data-target="#editModal<?= $row['id_products']; ?>"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            href="proses/proses_tambah.php?proses=delete&id_products=<?php echo $row['id_products']; ?>"
                                            onclick="return confirm('Yakin hapus?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!--Cek Gambar-->
                                <div class="modal fade" id="modalGambar<?php echo $row['id_products']; ?>" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content bg-transparent" style="border:none;">
                                            <div class="modal-body text-center">
                                                <img src="../Admin/image/<?php echo $row['image']; ?>"
                                                    alt="<?php echo $row['name']; ?>" class="img-fluid rounded shadow-sm"
                                                    style="max-height: 50vh; object-fit: cover;">
                                                <br><br>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editModal<?= $row['id_products']; ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="proses/proses_tambah.php" method="POST"
                                                enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_products"
                                                        value="<?= $row['id_products']; ?>">

                                                    <div class="form-group">
                                                        <label>Nama Barang</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="<?= $row['name']; ?>" placeholder="Masukkan nama"
                                                            required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Harga</label>
                                                        <input type="number" name="price" class="form-control"
                                                            value="<?= $row['price']; ?>" placeholder="Contoh: 50000"
                                                            required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Stok</label>
                                                        <input type="number" name="stock" class="form-control"
                                                            value="<?= $row['stock']; ?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Gambar Produk</label>
                                                        <div class="text-center mb-3">
                                                            <img src="../Admin/image/<?= $row['image']; ?>"
                                                                class="img-thumbnail shadow-sm" style="max-height: 150px;">
                                                            <p class="small text-muted mt-2">Gambar saat ini</p>
                                                        </div>

                                                        <div class="custom-file">
                                                            <input type="file" name="image" class="custom-file-input"
                                                                id="inputEdit<?= $row['id_products']; ?>"
                                                                onchange="updateFileName(this)"> <label
                                                                class="custom-file-label"
                                                                for="inputEdit<?= $row['id_products']; ?>">
                                                                Pilih gambar baru...
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Kategori</label>
                                                        <select name="id_category" class="form-control" required>
                                                            <?php
                                                            $kat = mysqli_query($koneksi, "SELECT * FROM category");
                                                            while ($k = mysqli_fetch_array($kat)) {
                                                                $selected = ($k['id'] == $row['id_category']) ? 'selected' : '';
                                                                echo "<option value='$k[id]' $selected>$k[name_category]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" name="proses" value="edit"
                                                        class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>



<div class="modal fade" id="modalformulir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="proses/proses_tambah.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama" required>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="price" class="form-control" placeholder="Contoh: 50000" required>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Gambar Produk</label>

                        <div id="areaPreview" class="text-center mb-3" style="display: none;">
                            <img id="imagePreview" src="#" class="img-thumbnail shadow-sm" style="max-height: 200px;">
                            <p class="small text-muted mt-2" id="namaFilePreview"></p>
                            <button type="button" class="btn btn-xs btn-danger" onclick="resetGambar()">Ganti
                                Gambar</button>
                        </div>

                        <div id="inputGroupGambar" class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="inputFile"
                                    onchange="tampilkanPreview(this)" accept="image/*">
                                <label class="custom-file-label" for="inputFile">Pilih gambar...</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_category" class="form-control" required>
                            <?php
                            $kat = mysqli_query($koneksi, "SELECT * FROM category");
                            while ($k = mysqli_fetch_array($kat)) {
                                echo "<option value='$k[id]'>$k[name_category]</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="proses" value="tambah" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function tampilkanPreview(input) {
        const areaPreview = document.getElementById('areaPreview');
        const imagePreview = document.getElementById('imagePreview');
        const inputGroup = document.getElementById('inputGroupGambar');
        const namaFile = document.getElementById('namaFilePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // 1. Masukkan gambar ke tag img
                imagePreview.src = e.target.result;
                // 2. Tampilkan area preview
                areaPreview.style.display = 'block';
                // 3. Sembunyikan kotak input bawaan agar rapi
                inputGroup.style.display = 'none';
                // 4. Tampilkan nama filenya
                namaFile.innerText = input.files[0].name;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetGambar() {
        // Fungsi untuk membatalkan dan memilih ulang
        document.getElementById('inputFile').value = ""; // Reset input file
        document.getElementById('areaPreview').style.display = 'none'; // Sembunyikan preview
        document.getElementById('inputGroupGambar').style.display = 'flex'; // Munculkan input lagi
    }
</script>

<script>
    function updateFileName(input) {
        // Ambil nama file dari input
        let fileName = input.files[0].name;

        // Cari elemen 'label' yang bertetangga langsung dengan input ini
        let label = input.nextElementSibling;

        // Ubah isi teks label menjadi nama file
        label.innerText = fileName;
    }
</script>