#!/bin/bash

appKey=$(awk -F= '$1 == "APP_KEY" {print $2}' .env)

if [ -z "$appKey" ]; then
  php artisan key:generate
fi

php artisan config:cache

databaseHost=$(awk -F= '$1 == "DB_HOST" {print $2}' .env)
databasePort=$(awk -F= '$1 == "DB_PORT" {print $2}' .env)

./docker/wait-for-it.sh $databaseHost:$databasePort -t 90 -- php artisan migrate --force

supervisord -n -c docker/supervisord.conf

exec "$@"
