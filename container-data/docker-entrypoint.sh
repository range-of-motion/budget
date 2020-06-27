#!/usr/bin/env sh

# this should allow the user to use artisan or start a shell in the container
# if either artisan or sh haven't been provided it will init the process supervisor
if [ "$1" == "artisan" ] || [ "$1" == "sh" ]
then
    exec "$@"
fi

exec /init
