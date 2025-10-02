#!/bin/bash
set -e

# Run composer install if vendor is missing
if [ ! -d "vendor" ]; then
    echo "No vendor directory found, running composer install..."
    if [ "$APP_ENV" = "production" ]; then
        su -s /bin/bash www-data -c "composer install --no-dev --optimize-autoloader"
    else
        su -s /bin/bash www-data -c "composer install --optimize-autoloader"
    fi
fi

# Setup environment file if missing
if [ ! -f ".env" ]; then
    echo "No .env file found, copying from .env.example..."
    su -s /bin/bash www-data -c "cp .env.example .env"
    # Generate app key (only if artisan exists)
    if [ -f "artisan" ]; then
        echo "Running php artisan key:generate..."
        su -s /bin/bash www-data -c "php artisan key:generate"
    fi
fi

su -s /bin/bash www-data -c "php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\""
su -s /bin/bash www-data -c "php artisan migrate --graceful --ansi"


exec "$@"
