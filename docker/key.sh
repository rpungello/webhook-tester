#!/bin/sh
set -e

KEY=$(docker exec webhook-tester-app-1 php artisan key:generate --show | sed 's;/;\\/;g')

if grep -q "APP_KEY=" .env; then
    sed -i "s/APP_KEY=.*/APP_KEY=${KEY}/" .env
else
    echo "APP_KEY=${KEY}" >> .env
fi

