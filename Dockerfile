FROM php:8.2-apache

# Install dependencies + MySQL extensions
RUN apt-get update && docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . /var/www/html

# Set permissions (optional if you upload files)
# RUN chown -R www-data:www-data /var/www/html

# Expose HTTP port
EXPOSE 80

CMD ["apache2-foreground"]
