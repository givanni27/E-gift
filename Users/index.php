<?php
session_start();

// Cek apakah session id_users ada, jika TIDAK ada, arahkan ke login
if (!isset($_SESSION['id_users'])) {
    header('location:login.php');
    exit();
}

include('../Admin/database.php'); // Pastikan titik koma ada di sini
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belanja-boneka</title>
    <link rel="icon" type="image/x-icon" href="../Users/assets/image/logo.svg">

    <link href="../Users/assets/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="../Users/assets/src/elements.bundle.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <header
        class="sticky top-0 z-50 w-full bg-white dark:bg-gray-900 border-b-2 border-indigo-200 dark:border-gray-800 shadow-sm">
        <div class="mx-auto flex h-16 max-w-7xl items-center gap-8 px-4 sm:px-6 lg:px-8">
            <a class="block text-indigo-600 dark:text-indigo-400" href="#">
                <span class="sr-only">Home</span>
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M4 3C3.44772 3 3 3.44772 3 4C3 4.55228 3.44772 5 4 5H5C5.50065 5 5.91537 5.36792 5.98854 5.84813L6.26745 10.3118C6.43211 12.947 8.61737 15 11.2577 15H16C18.7614 15 21 12.7614 21 10C21 7.23858 18.7614 5 16 5H7.82929C7.41746 3.83481 6.30622 3 5 3H4Z" />
                    <path
                        d="M12 19C12 20.1046 11.1046 21 10 21C8.89543 21 8 20.1046 8 19C8 17.8954 8.89543 17 10 17C11.1046 17 12 17.8954 12 19Z" />
                    <path
                        d="M16 21C17.1046 21 18 20.1046 18 19C18 17.8954 17.1046 17 16 17C14.8954 17 14 17.8954 14 19C14 20.1046 14.8954 21 16 21Z" />
                </svg>
            </a>
            <div class="flex flex-2 items-center justify-end md:justify-between">
                <nav aria-label="Global" class="hidden md:block">
                    <ul class="flex items-center gap-6 text-sm">
                        <li>
                            <a class="text-gray-500 transition hover:text-gray-500/75 dark:text-white dark:hover:text-white/75"
                                href="#">
                                Beranda
                            </a>
                        </li>

                        <li>
                            <a class="text-gray-500 transition hover:text-gray-500/75 dark:text-white dark:hover:text-white/75"
                                href="#Card">
                                Produk
                            </a>
                        </li>

                        <li>
                            <a class="text-gray-500 transition hover:text-gray-500/75 dark:text-white dark:hover:text-white/75"
                                href="#Footer">
                                Tentang
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="flex items-center gap-4">
                    <div class="sm:flex sm:gap-4">
                        <div class="badge badge-soft badge-secondary"><?= $_SESSION['username_users'] ?></div>
                    </div>
                    <el-dropdown class="inline-block">
                        <button
                            class="inline-flex w-full justify-center gap-x-1.5 rounded-sm px-1 py-2 text-sm font-semibold text-white inset-ring-1 inset-ring-white/5 hover:bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>

                        <el-menu anchor="bottom end" popover
                            class="w-56 origin-top-right rounded-md bg-gray-800 outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                            <div class="py-1">

                                <button onclick="PageRedirect ()"
                                    class="block w-full px-4 py-2 text-left text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">
                                    Keranjang</button>
                                <script>
                                    function PageRedirect() {
                                        window.location.href = "../Users/keranjang.php";
                                    }
                                </script>

                                <a href="history.php"
                                    class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">History</a>


                                <form action="../Users/logoutU.php" method="POST">
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-left text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Keluar
                                        Akun</button>
                                </form>
                            </div>
                            </el - menu>
                            </el - dropdown>
                </div>
            </div>
        </div>
    </header>

    <?php
    if (isset($_SESSION['berhasil'])) { ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Selamat berbelanja!',
                timer: '3000',
                showConfirmButton: false
            });
        </script>
        <?php
        unset($_SESSION['berhasil']);
    } ?>

    <section class="bg-white min-h-screen dark:bg-gray-900 flex items-center">
        <div class="mx-auto max-w-7xl px-6 py-16 sm:px-8 lg:px-12">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-6xl dark:text-white leading-tight">
                    Halo <span class="text-indigo-600 block sm:inline"><?= $_SESSION['username_users']; ?>,</span>
                    selamat datang di
                    Belanja Boneka!
                </h1>
                <p class="mx-auto mt-6 max-w-xl text-lg text-gray-700 dark:text-gray-200">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, nisi. Natus, provident
                    accusamus impedit minima harum corporis iusto.
                </p>
                <div class="mt-10 flex justify-center gap-4">
                    <a class="inline-block rounded-lg bg-indigo-600 px-8 py-3 font-medium text-white shadow-md transition hover:bg-indigo-700"
                        href="#Card">
                        Ayo Belanja
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- blog -->
    <section id="Card" class="bg-white dark:bg-gray-900 py-16">
        <div class="mx-auto w-full max-w-7xl px-4 sm:px-8 lg:px-12">

            <div class="text-center mb-12">
                <div class="text-4xl font-bold text-gray-900 dark:text-white">
                    Produk Kami
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-3 gap-14 mb-12">
                <?php
                // Query ini hanya mengambil 6 produk terbaru yang stoknya masih ada
                $query = "SELECT * FROM products WHERE stock > 0 ORDER BY id_products DESC LIMIT 6";
                $sql = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_array($sql)):
                    ?>

                    <article
                        class="w-full overflow-hidden rounded-lg border-2 border-gray-200 dark:border-gray-700 shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 hover:border-indigo-500">

                        <img alt="<?php echo $row['name']; ?>" src="../Admin/image/<?php echo $row['image']; ?>"
                            class="w-full h-64 object-cover">

                        <div class="bg-white p-4 sm:p-6 dark:bg-gray-900">

                            <h3 class="mt-0.5 text-lg text-gray-900 dark:text-white text-center">
                                <?php echo $row['name']; ?>

                            </h3>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-200 text-center">
                                Rp<?php echo number_format($row['price'], 0, ',', '.'); ?>
                            </p>

                            <p class="mt-0 text-xs text-gray-500 dark:text-indigo-600 text-center">
                               stock <?php echo $row['stock'] ?>
                            </p>


                            <div class="mt-4 flex justify-center">
                                <a href="javascript:void(0)" onclick="openQuickView(this)"
                                    data-id="<?= $row['id_products'] ?>" data-name="<?= $row['name'] ?>"
                                    data-price="Rp<?= number_format($row['price'], 0, ',', '.') ?>"
                                    data-image="../Admin/image/<?= $row['image'] ?>"
                                    class="inline-block rounded-full border border-indigo-600 bg-indigo-600 p-3 text-white hover:bg-transparent hover:text-indigo-600">
                                    <span class="sr-only"> Checkout </span>

                                    <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>

                <?php endwhile; ?>

            </div>
        </div>
    </section>


    <!-- Feature Section -->

    <section id="Feature" class="bg-[#0f172a] py-24 border-y border-slate-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-800/50 backdrop-blur-md rounded-2xl p-8 md:p-12 border border-slate-700 shadow-2xl">

                <div class="flex flex-col items-center text-center p-4">
                    <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-xl text-blue-400">
                        <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"
                            fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <style type="text/css">
                                    .st0 {
                                        fill: none;
                                        stroke: #ffffff;
                                        stroke-width: 2;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                        stroke-miterlimit: 10;
                                    }

                                    .st1 {
                                        fill: none;
                                        stroke: #ffffff;
                                        stroke-width: 2;
                                        stroke-linejoin: round;
                                        stroke-miterlimit: 10;
                                    }
                                </style>
                                <ellipse class="st0" cx="16" cy="12.9" rx="8" ry="8.1"></ellipse>
                                <path class="st0" d="M8,12c-1.7-0.4-3-2-3-4C5,5.8,6.8,4,9,4c1.3,0,2.5,0.7,3.2,1.7">
                                </path>
                                <path class="st0"
                                    d="M19.8,5.7C20.5,4.7,21.7,4,23,4c2.2,0,4,1.8,4,4.1c0,1.9-1.3,3.5-3,4"></path>
                                <line class="st0" x1="14" y1="12" x2="14" y2="13"></line>
                                <line class="st0" x1="18" y1="12" x2="18" y2="13"></line>
                                <line class="st0" x1="16" y1="14" x2="16" y2="16"></line>
                                <ellipse transform="matrix(0.7087 -0.7055 0.7055 0.7087 -14.8111 13.1311)" class="st0"
                                    cx="8.5" cy="24.5" rx="2.8" ry="4.1"></ellipse>
                                <ellipse transform="matrix(0.7055 -0.7087 0.7087 0.7055 -10.441 23.8715)" class="st0"
                                    cx="23.5" cy="24.5" rx="4.1" ry="2.8"></ellipse>
                                <path class="st0" d="M9,21.4c0-0.1,0-0.3,0-0.4c0-1.1,0.3-2.2,0.7-3.1"></path>
                                <path class="st0" d="M20.2,26.6C19,27.5,17.6,28,16,28c-1.6,0-3-0.5-4.2-1.4"></path>
                                <path class="st0" d="M22.3,17.9c0.5,0.9,0.7,2,0.7,3.1c0,0.1,0,0.3,0,0.4"></path>
                                <path class="st0" d="M6.2,21.3C6.1,20.9,6,20.4,6,20c0-2,1.1-3.7,2.6-4"></path>
                                <path class="st0" d="M23.4,16c1.5,0.2,2.6,1.9,2.6,4c0,0.4-0.1,0.9-0.2,1.3"></path>
                                <path class="st0" d="M10,18c0-2.2,2.7-4,6-4s6,1.8,6,4"></path>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Berkualitas</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Jaitan dan bentuk yang sempurna untuk kenyamanan
                        Anda</p>
                </div>

                <div
                    class="flex flex-col items-center text-center p-4 border-y md:border-y-0 md:border-x border-slate-700/50">
                    <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-xl text-green-400">
                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="white"
                            fill="none">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M21.68,42.22H37.17a1.68,1.68,0,0,0,1.68-1.68L44.7,19.12A1.68,1.68,0,0,0,43,17.44H17.61a1.69,1.69,0,0,0-1.69,1.68l-5,21.42a1.68,1.68,0,0,0,1.68,1.68h2.18">
                                </path>
                                <path
                                    d="M41.66,42.22H38.19l5-17.29h8.22a.85.85,0,0,1,.65.3l3.58,6.3a.81.81,0,0,1,.2.53L52.51,42.22h-3.6">
                                </path>
                                <ellipse cx="18.31" cy="43.31" rx="3.71" ry="3.76"></ellipse>
                                <ellipse cx="45.35" cy="43.31" rx="3.71" ry="3.76"></ellipse>
                                <line x1="23.25" y1="22.36" x2="6.87" y2="22.36" stroke-linecap="round"></line>
                                <line x1="20.02" y1="27.6" x2="8.45" y2="27.6" stroke-linecap="round"></line>
                                <line x1="21.19" y1="33.5" x2="3.21" y2="33.5" stroke-linecap="round"></line>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Pengiriman Cepat</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Cepat, terlambat? jaminan gratis ongkir!</p>
                </div>

                <div class="flex flex-col items-center text-center p-4">
                    <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-xl text-purple-400">
                        <svg fill="#ffffff" height="200px" width="200px" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512.001 512.001" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <path
                                            d="M503.524,87.486h-92.897c-4.682,0-8.476,3.795-8.476,8.476c0,4.681,3.794,8.476,8.476,8.476h41.672 c3.604,21.854,20.895,39.144,42.749,42.749v98.963c-21.854,3.604-39.145,20.895-42.749,42.749H142.724 c-3.604-21.854-20.895-39.144-42.749-42.749v-98.963c21.854-3.604,39.144-20.895,42.749-42.749H381.49 c4.682,0,8.476-3.795,8.476-8.476c0-4.681-3.794-8.476-8.476-8.476H91.498c-4.681,0-8.476,3.795-8.476,8.476v201.412 c0,4.681,3.795,8.476,8.476,8.476h233.978v24.863H16.952V237.69c0-9.116,7.417-16.533,16.533-16.533h29.757 c4.681,0,8.476-3.795,8.476-8.476c0-4.681-3.795-8.476-8.476-8.476H33.484C15.022,204.207,0,219.227,0,237.691V391.03 c0,18.463,15.022,33.484,33.484,33.484h275.46c18.464,0,33.484-15.021,33.484-33.484v-85.179h161.096 c4.682,0,8.476-3.795,8.476-8.476V95.962C512,91.281,508.206,87.486,503.524,87.486z M99.974,104.438h25.456 c-3.12,12.488-12.968,22.336-25.456,25.456V104.438z M99.974,288.898v-25.456c12.488,3.12,22.336,12.968,25.456,25.456H99.974z M325.476,363.487H83.754c-4.681,0-8.476,3.795-8.476,8.476s3.795,8.476,8.476,8.476h241.723v10.59 c0,9.117-7.416,16.533-16.531,16.533H33.484c-9.116,0-16.533-7.417-16.533-16.533v-10.59H52.11c4.681,0,8.476-3.795,8.476-8.476 s-3.795-8.476-8.476-8.476H16.952v-15.822h308.524V363.487z M495.048,288.898h-25.456c3.12-12.488,12.968-22.336,25.456-25.456 V288.898z M495.048,129.894c-12.488-3.12-22.336-12.968-25.456-25.456h25.456V129.894z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M297.511,119.181c-34.834,0-63.174,34.762-63.174,77.488c0,42.727,28.34,77.488,63.174,77.488 s63.174-34.762,63.174-77.488C360.685,153.942,332.345,119.181,297.511,119.181z M297.512,257.205 c-25.487,0-46.222-27.157-46.222-60.536s20.736-60.536,46.222-60.536c25.487,0,46.222,27.157,46.222,60.536 C343.734,230.048,322.999,257.205,297.512,257.205z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M470.807,177.458h-83.836c-4.682,0-8.476,3.795-8.476,8.476s3.794,8.476,8.476,8.476h83.836 c4.682,0,8.476-3.795,8.476-8.476S475.489,177.458,470.807,177.458z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M203.963,177.458h-83.837c-4.681,0-8.476,3.795-8.476,8.476s3.795,8.476,8.476,8.476h83.837 c4.681,0,8.476-3.795,8.476-8.476C212.439,181.253,208.644,177.458,203.963,177.458z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M470.807,206.341h-46.007c-4.682,0-8.476,3.795-8.476,8.476s3.794,8.476,8.476,8.476h46.007 c4.682,0,8.476-3.795,8.476-8.476S475.489,206.341,470.807,206.341z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M166.133,206.341h-46.007c-4.681,0-8.476,3.795-8.476,8.476s3.795,8.476,8.476,8.476h46.007 c4.681,0,8.476-3.795,8.476-8.476S170.814,206.341,166.133,206.341z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M322.053,188.193h-40.609v-12.812h40.609c4.682,0,8.476-3.795,8.476-8.476s-3.794-8.476-8.476-8.476h-16.066v-8.532 c0-4.681-3.794-8.476-8.476-8.476s-8.476,3.795-8.476,8.476v8.532h-16.067c-4.682,0-8.476,3.795-8.476,8.476v29.764 c0,4.681,3.794,8.476,8.476,8.476h40.609v12.812h-40.609c-4.682,0-8.476,3.795-8.476,8.476s3.794,8.476,8.476,8.476h16.067v8.532 c0,4.681,3.794,8.476,8.476,8.476s8.476-3.795,8.476-8.476v-8.532h16.066c4.682,0,8.476-3.795,8.476-8.476v-29.764 C330.529,191.988,326.735,188.193,322.053,188.193z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Harga Adaptasi</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Keuangan kurang, namun ingin beli? Bisa Nego Loh
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section id="Footer">
        <footer class="bg-white dark:bg-gray-900">
            <div class="mx-auto max-w-7xl px-4 pt-16 pb-8 sm:px-6 lg:px-8 lg:pt-24">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-5xl dark:text-white">
                        Tentang Kami
                    </h2>

                    <p class="mx-auto mt-4 max-w-sm text-gray-500 dark:text-gray-400">
                        Belanja-boneka adalah website belanja yang muncul dari pikiran seorang anak SMK, dengan tujuan
                        ingin memudahkan orang-orang yang ingin membeli boneka dengan kualitas baik dan harga yang
                        murah.
                    </p>
                </div>

                <div
                    class="mt-16 border-t border-gray-100 pt-8 sm:flex sm:items-center sm:justify-between lg:mt-24 dark:border-gray-800">
                    <ul class="flex flex-wrap justify-center gap-4 text-xs lg:justify-end">
                        <li>
                            <a href="#" class="text-gray-500 transition hover:opacity-75 dark:text-gray-400">
                                Terms &amp; Conditions
                            </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-500 transition hover:opacity-75 dark:text-gray-400">
                                Privacy Policy
                            </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-500 transition hover:opacity-75 dark:text-gray-400">
                                Cookies
                            </a>
                        </li>
                    </ul>

                    <ul class="mt-8 flex justify-center gap-6 sm:mt-0 lg:justify-end">
                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Facebook</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Instagram</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Twitter</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">GitHub</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Dribbble</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </section>
    <div id="login-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="bg-slate-900 p-8 rounded-2xl border border-slate-700 w-full max-w-md">
            <div class="flex justify-between mb-4">
                <h2 class="text-white text-xl font-bold">Login</h2>
                <button id="close-modal" class="text-white text-2xl">&times;</button>
            </div>
        </div>
    </div>
</body>


<dialog id="quickview_modal" class="modal">
    <div class="modal-box max-w-2xl bg-white p-0 overflow-hidden">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 z-10">✕</button>
        </form>

        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/2">
                <img id="qv_image" src="" class="h-64 md:h-full w-full object-cover" />
            </div>
            <div class="p-6 md:w-1/2">
                <h3 id="qv_name" class="text-2xl font-bold text-gray-800"></h3>
                <p id="qv_price" class="py-4 text-xl text-indigo-600 font-bold"></p>
                <br>
                <form action="./keranjang.php" method="POST">
                    <input type="hidden" id="qv_id" name="id_products">
                    <input type="hidden" name="qty" value="1">

                    <button type="submit" class="btn btn-primary w-full">Beli Sekarang</button>
                </form>
            </div>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>


<script>
    function openQuickView(element) {
        // Ambil data dari atribut data- di tag <a>
        const id = element.getAttribute('data-id');
        const name = element.getAttribute('data-name');
        const price = element.getAttribute('data-price');
        const image = element.getAttribute('data-image');

        // Masukkan data ke dalam elemen modal
        document.getElementById('qv_id').value = id;
        document.getElementById('qv_name').innerText = name;
        document.getElementById('qv_price').innerText = price;
        document.getElementById('qv_image').src = image;



        // Tampilkan modal (fungsi bawaan HTML5/DaisyUI)
        document.getElementById('quickview_modal').showModal();
    }
</script>

<?php
if (isset($_GET['checkout']) && $_GET['checkout'] == 'success' && isset($_GET['id_inv'])):
    include '../Admin/database.php';
    $id_inv = mysqli_real_escape_string($koneksi, $_GET['id_inv']);

    // Ambil data transaksi
    $query_trans = mysqli_query($koneksi, "SELECT * FROM transactions WHERE id_transaksi = '$id_inv'");
    $trans = mysqli_fetch_assoc($query_trans);

    // Ambil detail produk
    $query_detail = mysqli_query($koneksi, "SELECT transaction_details.*, products.name 
                                           FROM transaction_details 
                                           JOIN products ON transaction_details.id_products = products.id_products 
                                           WHERE id_transaksi = '$id_inv'");

    // Pesan WhatsApp Otomatis
    $pesan_wa = "Halo Admin, saya ingin konfirmasi pembayaran.\n\n" .
        "*Invoice:* #INV-" . $id_inv . "\n" .
        "*Nama:* " . $trans['nama_pembeli'] . "\n" .
        "*Total:* Rp" . number_format($trans['total_bayar'], 0, ',', '.') . "\n\n" .
        "Mohon segera diproses ya. Terima kasih!";
    $wa_link = "https://wa.me/6282340871922?text=" . urlencode($pesan_wa); // GANTI NOMOR WA DISINI
    ?>

    <div id="invoiceModal" class="fixed inset-0 z-[999] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div
            class="bg-white rounded-2xl max-w-lg w-full flex flex-col max-h-[90vh] overflow-hidden shadow-2xl animate-fade-in">

            <div class="bg-indigo-600 p-5 text-white text-center shrink-0">
                <h2 class="text-xl font-bold">Checkout Berhasil!</h2>
                <p class="text-indigo-100 text-[10px] uppercase tracking-wider">Simpan invoice ini sebagai bukti pesanan</p>
            </div>

            <div class="p-6 overflow-y-auto bg-white custom-scrollbar">
                <div class="flex justify-between items-start mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Nomor Invoice</p>
                        <p class="font-mono font-bold text-gray-800">#INV-<?= $id_inv ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Nama Pemesan</p>
                        <p class="font-bold text-gray-800"><?= htmlspecialchars($trans['nama_pembeli']) ?></p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 mb-6">
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase mb-3 tracking-widest">Daftar Belanja</h3>
                    <div class="space-y-3">
                        <?php while ($item = mysqli_fetch_assoc($query_detail)): ?>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600"><?= htmlspecialchars($item['name']) ?> <span
                                        class="text-gray-400 text-xs">x<?= $item['qty'] ?></span></span>
                                <span
                                    class="font-semibold text-gray-800">Rp<?= number_format($item['harga_saat_ini'] * $item['qty'], 0, ',', '.') ?></span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div
                        class="border-t border-gray-200 mt-4 pt-3 flex justify-between items-center font-black text-indigo-600">
                        <span class="text-xs uppercase">Total Bayar</span>
                        <span class="text-lg">Rp<?= number_format($trans['total_bayar'], 0, ',', '.') ?></span>
                    </div>
                </div>


            </div>

            <div class="p-6 bg-white border-t border-gray-100 shrink-0 flex flex-col gap-3">
                <a href="<?= $wa_link ?>" target="_blank"
                    class="w-full bg-green-500 text-indigo-400 py-3.5 rounded-xl font-bold hover:bg-green-600 transition flex items-center justify-center gap-2 shadow-lg shadow-green-100 active:scale-95">
                    Konfirmasi Via WhatsApp
                </a>
                <button onclick="closeInvoiceModal()"
                    class="w-full text-gray-400 text-[11px] font-bold uppercase hover:text-gray-600 transition tracking-widest">
                    Tutup Invoice
                </button>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.4s ease-out;
        }

        /* Agar scrollbar di modal tetap cantik */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }
    </style>

    <script>
        function closeInvoiceModal() {
            const modal = document.getElementById('invoiceModal');
            modal.style.opacity = '0';
            modal.style.transition = 'opacity 0.3s ease';
            setTimeout(() => {
                modal.remove();
                // Bersihkan URL tanpa Refresh
                if (window.history.replaceState) {
                    const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({ path: cleanUrl }, '', cleanUrl);
                }
            }, 300);
        }
    </script>
<?php endif; ?>
</html>












