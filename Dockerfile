# Use official PHP + Apache image
FROM php:8.2-apache

# Enable Apache rewrite (needed for Laravel/Symfony/WordPress pretty URLs)
RUN a2enmod rewrite

# Copy app files into the web root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# If using Composer (for frameworks)
RUN apt-get update && apt-get install -y unzip git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader || true

# Expose port 80 for Render
EXPOSE 80

# Default CMD (Apache is already configured)
