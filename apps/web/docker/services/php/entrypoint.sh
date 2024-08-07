#!/bin/sh

php artisan storage:link
php artisan migrate --force
php artisan db:seed
npm run build

if command -v supervisord >/dev/null 2>&1; then
    /usr/bin/supervisord -n
else
    echo "Supervisor is not installed. Starting php-fpm directly."
    php-fpm
fi
