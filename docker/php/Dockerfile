FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /app

RUN apk add --no-cache \
    bash \
    curl \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    oniguruma-dev \
    mysql-client \
    icu-dev

# Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod 755 /usr/local/bin/install-php-extensions
RUN install-php-extensions pdo_mysql mbstring intl gd opcache



# Copy application files
COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN set -eux; \
	composer install --no-scripts --no-progress; \
	composer clear-cache

# Set permissions for Laravel
RUN chown -R www-data:www-data /app \
    && chmod -R 755 /app/storage \
    && chmod -R 755 /app/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
