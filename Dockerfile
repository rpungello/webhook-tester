FROM dunglas/frankenphp

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV SERVER_NAME=:80

RUN apt-get update && apt-get install -y npm

RUN install-php-extensions \
    pdo_mysql \
	pcntl \
    redis \
	opcache

COPY . /app
RUN composer install
RUN npm install

RUN chown -R www-data:www-data /app
RUN apt-get -y remove npm && apt-get -y autoremove && apt-get clean
