# ==============================================================================
# Dockerfile untuk Sistem Stok Bahan Baku - 1/2 Kopi Tiam
# Optimized untuk Railway deployment (running as root)
# ==============================================================================

# Stage 1: Build Assets (Node.js)
FROM node:20-alpine AS node-builder

WORKDIR /app

# Copy package files
COPY package.json package-lock.json* ./

# Install dependencies
RUN npm install --ignore-scripts

# Copy source files untuk build Vite
COPY resources ./resources
COPY vite.config.js ./

# Build assets (CSS & JS)
RUN npm run build

# ==============================================================================
# Stage 2: PHP Application
FROM php:8.4-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    gettext \
    sqlite \
    sqlite-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    oniguruma-dev \
    && rm -rf /var/cache/apk/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_sqlite \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (untuk caching)
COPY composer.json composer.lock ./

# Install PHP dependencies (tanpa dev dependencies untuk production)
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy seluruh aplikasi
COPY . .

# Copy built assets dari node-builder stage
COPY --from=node-builder /app/public/build ./public/build

# Generate autoloader & optimize
RUN cp .env.deploy .env \
    && composer dump-autoload --optimize \
    && php artisan package:discover --ansi \
    && rm .env

# Buat direktori yang diperlukan
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    database

# Set permissions (running as root, jadi tidak perlu chown)
RUN chmod -R 775 storage bootstrap/cache database

# Copy template konfigurasi Nginx
COPY docker/nginx.conf.template /etc/nginx/templates/default.conf.template

# Copy konfigurasi Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy konfigurasi PHP
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Script untuk startup
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

# Expose port (Railway akan override ini)
EXPOSE 8080

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8080/health || exit 1

# Jalankan aplikasi
CMD ["/start.sh"]
