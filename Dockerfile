FROM php:8.2-apache

# Tambahkan ServerName untuk hilangkan warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install dependensi PostgreSQL
RUN apt-get update && apt-get install -y \
  libpq-dev \
  && docker-php-ext-install pdo pdo_pgsql

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Copy file project
COPY . /var/www/html/

# Set permission
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html
