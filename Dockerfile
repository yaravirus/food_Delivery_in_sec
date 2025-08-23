# Use official PHP with Apache
FROM php:8.2-apache

# Install dependencies and PHP extensions (MySQLi, PDO)
RUN apt-get update && docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (needed for .htaccess / pretty URLs)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . /var/www/html

# Fix permissions (optional, if you upload files)
# RUN chown -R www-data:www-data /var/www/html

# Expose the port dynamically (Railway will set $PORT)
EXPOSE ${PORT}

# Patch Apache to listen on Railway's $PORT and start it
CMD ["sh", "-c", "sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-enabled/000-default.conf && apache2-foreground"]
