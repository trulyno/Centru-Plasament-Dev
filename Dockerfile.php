FROM php:8.2-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    curl \
    git \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    ssmtp \
    mailx

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        mbstring \
        xml \
        zip \
        pdo \
        pdo_mysql \
        mysqli

# Configure ssmtp for email testing
COPY docker/ssmtp.conf /etc/ssmtp/ssmtp.conf

# Configure PHP to use ssmtp
RUN echo "sendmail_path = /usr/sbin/ssmtp -t" >> /usr/local/etc/php/conf.d/sendmail.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY src/ /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Create data directory with proper permissions
RUN mkdir -p /var/www/html/data/uploads && \
    chown -R www-data:www-data /var/www/html/data && \
    chmod -R 755 /var/www/html/data

EXPOSE 9000

CMD ["php-fpm"]
