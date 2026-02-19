<!-- Main Sidebar Container -->
<?php
$activeMenu = isset($_GET['menu']) ? $_GET['menu'] : '';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <img src="./image/logo/liu.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-gift - Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-2 pb-1 mb-1">
            <div class="info">
                <a class="d-block"><?= $_SESSION['username_admin'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php?menu=dashboard"
                        class="nav-link <?php echo ($activeMenu == 'dashboard') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <li class="nav-header">Shop Editor</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Halaman Website
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?menu=project"
                                class="nav-link <?php echo ($activeMenu == 'project') ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?menu=pesanan"
                                class="nav-link <?php echo ($activeMenu == 'pesanan') ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pesanan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">Akun</li>

                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>