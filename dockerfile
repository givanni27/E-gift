# Pakai versi PHP yang stabil
FROM dunglas/frankenphp:latest-php8.2

# INI BAGIAN PALING PENTING: Install alat buat koneksi database
RUN install-php-extensions mysqli pdo_mysql

# Copy semua file project kamu ke folder /app
COPY . /app

# Atur izin akses file biar bisa dibaca
WORKDIR /app
