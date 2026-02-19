<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/src/output.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section class="min-h-screen flex flex-col items-center justify-center bg-gray-900">
        <div class="w-full max-w-md">

            <div class="relative rounded-t-lg bg-gray-700 text-center py-3">
                <p class="text-white">Masukkan Akun</p>
                <button type="button" onclick="window.location.href='../index.php'"
                    class="rounded-sm bg-indigo-600 h-6 w-6 absolute -top-0 -bottom-0 -right-0 text-gray-400 hover:text-white transition-all duration-200 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>
            <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "gagal") { ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: 'Email atau Password Salah!',
                            confirmButtonColor: '#3085d6'
                        });
                    </script>
                <?php }
            }
            ?>

            <?php
            if (isset($_GET['success'])) {
                if ($_GET['success'] == "registered") { ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'register berhasil',
                            text: 'Selamat Melanjutkan!',
                            confirmButtonColor: '#3085d6'
                        });
                    </script>
                <?php }
            }
            ?>

            <form class="flex flex-col space-y-6 p-6 rounded-b-lg shadow-xl/30 bg-gray-800/80"
                action="cek_login_users.php" autocomplete="off" method="post">
                <label for="Email">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200"> Email </span>

                    <input type="Email" placeholder="Masukkan Email kamu" id="Email" name="Email" required
                        class="text-sm placeholder:text-gray-500 placeholder:italic mt-0.5 h-8 w-full px-3 rounded border-gray-300 shadow-sm sm:text-sm dark:border-gray-600 dark:bg-gray-700/75 dark:text-white">
                </label>

                <label for="Password">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200"> Password </span>

                    <input placeholder="Masukkan Password Kamu" type="Password" name="Password" required
                        class="text-sm placeholder:text-gray-500 placeholder:italic mt-0.5 h-8 w-full px-3 rounded border-gray-300 shadow-sm sm:text-sm dark:border-gray-600 dark:bg-gray-700/75 dark:text-white">
                </label>

                <div class="mt-8 flex justify-center">

                    <button
                        class="inline-block rounded-md border border-indigo-600 bg-indigo-600 px-20 py-2 text-sm font-medium text-white hover:bg-indigo-700 hover:text-white-600"
                        type="submit">Login
                    </button>
                </div>

                <div class="flex justify-center text-xs gap-1">
                    <div class="text-gray-500">Belum punya akun?
                    </div>

                    <a href="./register.php" class="text-sky-600 no-underline hover:underline dark:text-sky-400">ayo
                        buat</a>
                </div>

            </form>
    </section>
    </div>

</body>

</html>