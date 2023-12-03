#!/bin/sh

if [ ! -d "vendor" ]; then
  composer install
fi

if [ -f ".env" ] && [ ! -f ".migrated" ]; then
  php artisan key:generate
  php artisan migrate --seed
  touch .migrated
fi

exec php artisan octane:start
