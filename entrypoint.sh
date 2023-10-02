#!/bin/bash

su - www-data << 'EOF'
    composer install --no-dev --no-interaction

    npm install
    npm run build

    cp .env.docker .env

    php artisan storage:link
EOF

appKey=$(awk -F= '$1 == "APP_KEY" {print $2}' .env)

if [ -z "$appKey" ]; then
  php artisan key:generate
fi

php artisan config:cache

php artisan migrate --force

supervisord -n -c docker/supervisord.conf

exec "$@"
