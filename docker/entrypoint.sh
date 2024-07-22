#!/bin/sh
set -e

# If this is the first time the container is being run, build the frontend assets
if [ ! -d "/app/public/build" ]; then
	cd /app
	npm run build
fi

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- frankenphp run "$@"
fi

exec "$@"
