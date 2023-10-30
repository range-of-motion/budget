#!/bin/bash

appKey=$(awk -F= '$1 == "APP_KEY" {print $2}' .env)

if [ -z "$appKey" ]; then
  php artisan key:generate
fi

php artisan config:cache

php artisan migrate --force

supervisord -n -c docker/supervisord.conf

exec "$@"
