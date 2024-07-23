#!/bin/sh
set -e

cd /app

# If this is the first time the container is being run, build the frontend assets
if [ ! -d "/app/public/build" ]; then
	npm run build
fi

php artisan migrate --force --isolated

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- frankenphp run "$@"
fi

exec "$@"
