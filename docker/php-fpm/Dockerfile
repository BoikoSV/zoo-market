FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

RUN apk --no-cache add \
    libzip-dev \
    unzip

RUN docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN mv .env.example .env

RUN composer install --no-dev --optimize-autoloader

RUN php artisan key:generate

RUN chmod -R 777 /var/www/html

EXPOSE 9000

CMD ["php-fpm"]

