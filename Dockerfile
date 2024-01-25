FROM php:8.2.12-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /app

RUN composer install

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
