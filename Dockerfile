# Dockerfile
FROM php:8.2-apache

# Install dependensi PostgreSQL
RUN apt-get update && apt-get install -y \
  libpq-dev \
  && docker-php-ext-install pdo pdo_pgsql

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Salin semua file proyek ke direktori Apache
COPY ./web /var/www/html/

# Set izin agar Apache bisa mengakses semua file
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html
