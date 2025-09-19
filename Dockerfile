# Use PHP 8.4 FPM Alpine for smaller image size
FROM php:8.4-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache git curl libpng-dev libxml2-dev zip unzip oniguruma-dev libzip-dev freetype-dev libjpeg-turbo-dev mysql-client

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip opcache

# Install Redis extension
RUN apk add --no-cache $PHPIZE_DEPS && pecl install redis && docker-php-ext-enable redis && apk del $PHPIZE_DEPS

# Copy composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create www user and set permissions
RUN addgroup -g 1000 -S www && adduser -u 1000 -D -S -G www www

# PHP production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Copy custom PHP configuration
COPY <<EOF $PHP_INI_DIR/conf.d/laravel.ini
; Performance settings
opcache.enable=1
opcache.enable_cli=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=20000
opcache.revalidate_freq=0
opcache.validate_timestamps=0
opcache.save_comments=1
opcache.fast_shutdown=1

; General settings
upload_max_filesize = 100M
post_max_size = 100M
memory_limit = 512M
max_execution_time = 300
max_input_vars = 3000

; Session settings
session.cookie_httponly = 1
session.cookie_secure = 1
session.use_strict_mode = 1
EOF

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --prefer-dist

# Create startup script
COPY <<'EOF' /usr/local/bin/start.sh
#!/bin/sh
set -e

echo "Starting Laravel application..."

echo "Running database migrations..."
php artisan migrate --force

echo "Running Laravel optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan optimize

# Clear any existing cache that might conflict
php artisan queue:restart

echo "Setting proper permissions..."
chown -R www:www /var/www/html
chmod -R 755 /var/www/html
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

echo "Starting Laravel queue workers in background..."
su -s /bin/sh www -c "php /var/www/html/artisan queue:work --sleep=3 --tries=3 --max-time=3600" &
su -s /bin/sh www -c "php /var/www/html/artisan queue:work --sleep=3 --tries=3 --max-time=3600" &

echo "Starting PHP-FPM..."
exec php-fpm -F
EOF

# Make startup script executable
RUN chmod +x /usr/local/bin/start.sh

# Create required directories
RUN mkdir -p storage/logs \
    && mkdir -p bootstrap/cache

# Set proper permissions
RUN chown -R www:www /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage \
    && chmod -R 775 bootstrap/cache

# Expose PHP-FPM port
EXPOSE 9000

# Health check - check if PHP-FPM is running
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD pgrep php-fpm || exit 1

# Start the application
CMD ["/usr/local/bin/start.sh"]
