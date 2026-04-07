<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?menu=dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Akun</li>
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
                <h3 class="card-title">Daftar Pengguna</h3>

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
                                <th style="width: 150px">Nama Akun</th>
                                <th style="width: 10px;" class="text-center">Password</th>
                                <th style="width: 10px;" class="text-center">Email</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM users";
                            $sql = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_array($sql)):
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $row['id_users']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['username_users']; ?>
                                        <br />
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['password']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a data-toggle="modal" data-target="#editModal<?= $row['id_users']; ?>"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            href="proses/proses_tambah_akun.php?proses=delete&id_users=<?php echo $row['id_users']; ?>"
                                            onclick="return confirm('Yakin hapus?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>


                                <div class="modal fade" id="editModal<?= $row['id_users']; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Akun Pengguna</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="proses/proses_tambah_akun.php" method="POST"
                                                enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_users" value="<?= $row['id_users']; ?>">

                                                    <div class="form-group">
                                                        <label>Nama Akun</label>
                                                        <input type="text" name="username_users" class="form-control"
                                                            value="<?= $row['username_users']; ?>"
                                                            placeholder="Masukkan nama baru" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="text" name="password" class="form-control"
                                                            value="<?= $row['password']; ?>"
                                                            placeholder="Masukkan password baru" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="email" class="form-control"
                                                            value="<?= $row['email']; ?>" placeholder="Masukkan email baru"
                                                            required>
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
