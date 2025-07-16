FROM php:8.2-fpm-alpine

# Install nginx and other dependencies
RUN apk add --no-cache nginx curl

# Copy source files
COPY src/ /var/www/html/
COPY nginx.conf /etc/nginx/http.d/default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Create directories for nginx
RUN mkdir -p /run/nginx

# Create startup script
RUN echo '#!/bin/sh' > /start.sh && \
    echo 'php-fpm -D' >> /start.sh && \
    echo 'nginx -g "daemon off;"' >> /start.sh && \
    chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
