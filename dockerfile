# Kita pakai image PHP yang ringan dan sudah ada Apache-nya
FROM php:8.1-apache

# Pasang alat mysqli buat koneksi database
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy semua file kamu ke dalam server
COPY . /var/www/html/

# Atur izin folder supaya bisa dibaca oleh server
RUN chown -R www-data:www-data /var/www/html

# Buka pintu akses utama
EXPOSE 80
