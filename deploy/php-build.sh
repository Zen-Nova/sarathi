#!/bin/bash
set -e

# php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
# php composer-setup.php
# php -r "unlink('composer-setup.php');"

rm -rf vendor

composer install --no-interaction --prefer-dist --optimize-autoloader
php artisan migrate --force
# php artisan operations:process
