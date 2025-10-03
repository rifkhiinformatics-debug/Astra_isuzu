# Gunakan PHP image dengan extensions yang sering dipakai Laravel
FROM php:8.2-fpm

# Install dependencies untuk PHP dan Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy file composer.json & composer.lock
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy semua file project ke container
COPY . .

# Install Node.js + npm untuk build asset
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install \
    && npm run build

# Laravel optimize
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear

# Expose port
EXPOSE 8000

# Jalankan Laravel pakai artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
