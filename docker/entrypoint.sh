#!/bin/bash

appKey=$(awk -F= '$1 == "APP_KEY" {print $2}' .env)

if [ -z "$appKey" ]; then
  php artisan key:generate
fi

php artisan config:cache

databaseHost=$(php artisan tinker --execute="echo config('database.connections.mysql.host')")
databasePort=$(php artisan tinker --execute="echo config('database.connections.mysql.port')")

./docker/wait-for-it.sh $databaseHost:$databasePort -t 90 -- php artisan migrate --force

supervisord -n -c docker/supervisord.conf

exec "$@"
