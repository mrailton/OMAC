#!/bin/bash
set -e

# Wait for database to be ready (optional, but recommended)
echo "Waiting for database..."
until php artisan migrate:status > /dev/null 2>&1; do
    echo "Database not ready, waiting..."
    sleep 2
done

# Run Laravel commands
echo "Running Laravel migrations and optimization..."
php artisan migrate --force
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize

echo "Laravel setup complete, starting server..."

# Start the original command
exec "$@"
