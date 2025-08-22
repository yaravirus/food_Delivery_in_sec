# Dockerfile (at repo root)
FROM php:8.2-apache

# Needed for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite (if you use .htaccess / pretty URLs)
RUN a2enmod rewrite

# (Optional) set DocumentRoot to /var/www/html/public
# RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Copy your app
COPY . /var/www/html

# (Optional) permissions if you write to storage/uploads
# RUN chown -R www-data:www-data /var/www/html

# Expose the port your app listens on
EXPOSE 80
