FROM serversideup/php:8.4-unit

ENV SSL_MODE=mixed
ENV PHP_OPCACHE_ENABLE=1

USER root

RUN apt-get update && \
    apt-get install -y mysql-client && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN install-php-extensions pcntl opcache pdo pdo_mysql intl zip gd exif ftp bcmath

USER www-data

COPY --chown=www-data:www-data composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-scripts --no-autoloader --no-progress --ignore-platform-reqs

COPY --chown=www-data:www-data . .

RUN composer dump-autoload --optimize

RUN php /var/www/html/artisan storage:link
