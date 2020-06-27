#!/usr/bin/env sh

if [ "$1" == "artisan" ] || [ "$1" == "sh" ]
then
    exec "$@"
fi

exec /init
