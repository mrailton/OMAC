#!/bin/bash
set -e

# Wait for database to be ready
echo "Waiting for database connection..."
until php artisan tinker --execute="DB::connection()->getPdo();" > /dev/null 2>&1; do
    echo "Database not ready, waiting..."
    sleep 3
done
echo "Database connection established."

# Wait for Redis to be ready
echo "Checking Redis connection..."
until php artisan tinker --execute="Redis::ping()" > /dev/null 2>&1; do
    echo "Redis not ready, waiting..."
    sleep 2
done
echo "Redis connection established."

# Clear any existing cache
echo "Clearing existing cache..."
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# Cache application for performance
echo "Caching application for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Create storage link if it doesn't exist
if [ ! -L /var/www/html/public/storage ]; then
    echo "Creating storage link..."
    php artisan storage:link
fi

# Set proper permissions for Laravel
echo "Setting proper permissions..."
chown -R unit:unit /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "Laravel application ready for production!"

# Start the original command
exec "$@"
