FROM dunglas/frankenphp

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV SERVER_NAME=:80
COPY . /app

RUN apt-get update && apt-get install -y npm 7zip \
 && install-php-extensions \
    pdo_mysql \
	pcntl \
    redis \
	opcache \
 && composer install && npm install \
 && chown -R www-data:www-data /app \
 && apt-get -y remove 7zip && apt-get -y autoremove && apt-get clean \
 && mv /app/docker/entrypoint.sh /usr/local/bin/docker-php-entrypoint \
 && chmod +x /usr/local/bin/docker-php-entrypoint

HEALTHCHECK --interval=5s --timeout=3s --retries=3 CMD php artisan status
