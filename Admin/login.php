<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Admin/plugin/css/all.min.css">
    <link rel="stylesheet" href="../Admin/plugin/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Admin/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex min-vh-100 justify-content-center align-items-center p-4">
                <!-- left column -->
                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header text-center">
                            <h3 class="card-title float-none">E-gift admin</h3>
                        </div>

                        <?php
                        if (isset($_GET['pesan'])) {
                            if ($_GET['pesan'] == "gagal") { ?>
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Login Gagal',
                                        text: 'Username atau Password Salah!',
                                        confirmButtonColor: '#3085d6'
                                    });
                                </script>
                            <?php }
                        }
                        ?>

                        <?php
                        if (isset($_GET['pesan'])) {
                            if ($_GET['pesan'] == "logout") { ?>
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil Logout',
                                        text: 'See you again!',
                                        timer: '2000',
                                        showConfirmButton: false
                                    });
                                </script>
                            <?php }
                        }
                        ?>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="cek_login.php" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="LoginEmail">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Masukkan Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
    </section>
</body>

</html>