#!/bin/sh
set -e

if [ ! -d "/app/public/build" ]; then
	cd /app
	npm run build
fi

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- frankenphp run "$@"
fi

exec "$@"
