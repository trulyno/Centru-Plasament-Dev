# Use PHP with Apache image as base
FROM php:8.2-apache

# Enable required Apache modules
RUN a2enmod rewrite headers

# Install any required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy site files to Apache document root
COPY site/ /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80

# Default command starts Apache
CMD ["apache2-foreground"]
