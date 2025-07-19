FROM php:8.2-fpm-alpine

# Install system and PHP dependencies
RUN apk add --no-cache \
    bash curl zip unzip git \
    php8-pecl-intl \
    php8-mysqli \
    php8-mbstring \
    php8-xml \
    php8-bcmath \
    php8-curl \
    php8-soap \
    php8-zip \
    oniguruma-dev \
    icu-dev \
    && docker-php-ext-install pdo pdo_mysql intl bcmath

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend
WORKDIR /var/www/frontend
RUN apk add --no-cache nodejs npm && \
    npm install && npm run build

WORKDIR /var/www
RUN chmod -R 775 storage bootstrap/cache

# Copy start script
COPY deploy.sh ./deploy.sh
RUN chmod +x ./deploy.sh

CMD ["./deploy.sh"]
