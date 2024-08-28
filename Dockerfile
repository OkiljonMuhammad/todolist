# Use an official PHP image as the base
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
&& docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
&& apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Copy the application files before running composer
COPY . /var/www

# Change the ownership of the files
RUN chown -R www-data:www-data /var/www

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Create a non-root user
RUN useradd -m -s /bin/bash appuser
USER appuser

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000

# Add a healthcheck
HEALTHCHECK --interval=30s --timeout=5s --start-period=5s --retries=3 CMD curl --fail http://localhost:9000 || exit 1

CMD ["php-fpm"]
