FROM php:8.2-fpm-alpine

# Install nginx and other dependencies
RUN apk add --no-cache nginx curl

# Copy source files
COPY src/ /var/www/html/

# Remove default nginx configurations and copy our custom one
RUN rm -f /etc/nginx/nginx.conf /etc/nginx/conf.d/* /etc/nginx/http.d/*
COPY nginx-render.conf /etc/nginx/http.d/default.conf

# Create a minimal nginx.conf
RUN echo 'user nginx;' > /etc/nginx/nginx.conf && \
    echo 'worker_processes auto;' >> /etc/nginx/nginx.conf && \
    echo 'error_log /var/log/nginx/error.log notice;' >> /etc/nginx/nginx.conf && \
    echo 'pid /var/run/nginx.pid;' >> /etc/nginx/nginx.conf && \
    echo 'events { worker_connections 1024; }' >> /etc/nginx/nginx.conf && \
    echo 'http { include /etc/nginx/mime.types; include /etc/nginx/http.d/*.conf; }' >> /etc/nginx/nginx.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Create directories for nginx
RUN mkdir -p /run/nginx /var/log/nginx

# Create startup script
RUN echo '#!/bin/sh' > /start.sh && \
    echo 'php-fpm -D' >> /start.sh && \
    echo 'nginx -g "daemon off;"' >> /start.sh && \
    chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
