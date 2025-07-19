FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash curl zip unzip git icu-dev oniguruma-dev libxml2-dev libzip-dev \
    nodejs npm \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        bcmath \
        intl \
        xml \
        zip \
        soap

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files
COPY . .

# Install Laravel PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend
WORKDIR /var/www/frontend
RUN npm install && npm run build

# Set back to Laravel root
WORKDIR /var/www

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Deploy script
COPY deploy.sh ./deploy.sh
RUN chmod +x ./deploy.sh

CMD ["./deploy.sh"]
