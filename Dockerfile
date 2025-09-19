FROM serversideup/php:8.4-unit

ENV SSL_MODE=mixed

USER root

RUN install-php-extensions exif

USER www-data

COPY --chown=www-data:www-data composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-scripts --no-autoloader --no-progress --ignore-platform-reqs

COPY --chown=www-data:www-data . .

RUN composer dump-autoload --optimize

RUN php /var/www/html/artisan storage:link
