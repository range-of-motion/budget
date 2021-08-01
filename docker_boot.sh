#!/usr/bin/env bash

./wait-for-it.sh database2:3306 -- php artisan migrate
./wait-for-it.sh database2:3306 -- php artisan db:seed

php-fpm
