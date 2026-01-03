# File: backend/Dockerfile
FROM php:8.2-apache

# 1. Install Library System (git, zip, unzip wajib buat Composer)
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

# 2. Install Ekstensi PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite

# 3. 🔥 INSTALL COMPOSER (Cara paling elegan & standar)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 4. Apache Configuration
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable AllowOverride All
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
