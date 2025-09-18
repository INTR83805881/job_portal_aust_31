# Use PHP 8.3 with Apache
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip unzip \
    curl \
    libzip-dev \
    npm \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy only composer files first (for caching)
COPY composer.json composer.lock ./
COPY package*.json vite.config.js ./

# Install PHP dependencies without running scripts yet
RUN composer install --no-scripts --optimize-autoloader
RUN npm install 



# Copy the rest of the project
COPY . .

RUN npm run build

# Run post-autoload scripts now that artisan exists
RUN composer run-script post-autoload-dump

# Expose port 8000 (Laravel serve)
EXPOSE 8000

# Start Laravel development server
CMD ["sh", "-c", "php artisan db:check-migrate && php artisan serve --host=0.0.0.0 --port=8000"]

