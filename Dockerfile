FROM serversideup/php:8.4-fpm-nginx

# Set environment variables
ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_MEMORY_CONSUMPTION=256
ENV PHP_OPCACHE_MAX_ACCELERATED_FILES=20000
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=0
ENV PHP_MAX_EXECUTION_TIME=300
ENV PHP_MEMORY_LIMIT=512M
ENV PHP_POST_MAX_SIZE=100M
ENV PHP_UPLOAD_MAX_FILESIZE=100M

# Switch to root for installations
USER root

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# Copy application files
COPY --chown=www-data:www-data . /var/www/html

# Switch to www-data user
USER www-data

# Set working directory
WORKDIR /var/www/html

# Install Composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Create storage and cache directories with proper permissions
RUN mkdir -p storage/logs storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache

# Switch back to root to set up supervisor
USER root

# Create supervisor config for Laravel queue worker
RUN echo '[program:laravel-queue]' > /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'process_name=%(program_name)s_%(process_num)02d' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'command=php /var/www/html/artisan queue:work --sleep=3 --tries=3 --max-time=3600' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'autostart=true' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'autorestart=true' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'stopasgroup=true' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'killasgroup=true' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'user=www-data' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'numprocs=1' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'redirect_stderr=true' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'stdout_logfile=/var/www/html/storage/logs/worker.log' >> /etc/supervisor/conf.d/laravel-queue.conf && \
    echo 'stopwaitsecs=3600' >> /etc/supervisor/conf.d/laravel-queue.conf

# Create startup script
RUN echo '#!/bin/bash' > /usr/local/bin/start.sh && \
    echo 'set -e' >> /usr/local/bin/start.sh && \
    echo '' >> /usr/local/bin/start.sh && \
    echo '# Run Laravel optimizations' >> /usr/local/bin/start.sh && \
    echo 'cd /var/www/html' >> /usr/local/bin/start.sh && \
    echo 'php artisan config:cache' >> /usr/local/bin/start.sh && \
    echo 'php artisan route:cache' >> /usr/local/bin/start.sh && \
    echo 'php artisan view:cache' >> /usr/local/bin/start.sh && \
    echo '' >> /usr/local/bin/start.sh && \
    echo '# Run migrations if needed' >> /usr/local/bin/start.sh && \
    echo 'php artisan migrate --force' >> /usr/local/bin/start.sh && \
    echo '' >> /usr/local/bin/start.sh && \
    echo '# Start supervisor for background jobs' >> /usr/local/bin/start.sh && \
    echo 'supervisord -c /etc/supervisor/supervisord.conf &' >> /usr/local/bin/start.sh && \
    echo '' >> /usr/local/bin/start.sh && \
    echo '# Start PHP-FPM and Nginx' >> /usr/local/bin/start.sh && \
    echo 'exec /usr/local/bin/docker-php-serversideup-entrypoint' >> /usr/local/bin/start.sh && \
    chmod +x /usr/local/bin/start.sh

# Switch back to www-data for runtime
USER www-data

# Expose port
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=40s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Use custom startup script
CMD ["/usr/local/bin/start.sh"]
