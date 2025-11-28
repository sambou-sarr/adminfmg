# Image PHP officielle
FROM php:8.2-fpm

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www

# Copier le projet
COPY . .

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Installer dépendances Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Exposer le port pour Laravel
EXPOSE 8080

# Entrypoint pour dev
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
