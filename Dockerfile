FROM dunglas/frankenphp

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV SERVER_NAME=:80
COPY . /app

RUN apt-get update && apt-get install -y npm 7zip

RUN install-php-extensions \
    pdo_mysql \
	pcntl \
    redis \
	opcache

RUN composer install && npm install

RUN chown -R www-data:www-data /app
RUN apt-get -y remove npm 7zip && apt-get -y autoremove && apt-get clean

HEALTHCHECK --interval=5s --timeout=3s --retries=3 CMD php artisan status
