FROM serversideup/php:8.2-fpm-nginx

# Switch to root to perform administration tasks
USER root

# Set the working directory
WORKDIR /var/www/html

# Copy all application files with proper permissions using the numeric UID/GID for www-data
COPY --chown=www-data:www-data . /var/www/html

# Install production dependencies, set web service permissions, and configure Nginx directories for non-root execution
RUN composer install --no-dev --optimize-autoloader --no-scripts && \
    php artisan storage:link && \
    chown -R www-data:www-data /var/www/html && \
    docker-php-serversideup-set-file-permissions --owner www-data:www-data --service nginx && \
    chown -R www-data:www-data /etc/nginx

# Copy custom entrypoint script to dynamically configure the Nginx listen port based on $PORT env var at startup
COPY --chown=www-data:www-data docker/99-set-nginx-port.sh /etc/entrypoint.d/99-set-nginx-port.sh
RUN sed -i 's/\r$//' /etc/entrypoint.d/99-set-nginx-port.sh && \
    chmod +x /etc/entrypoint.d/99-set-nginx-port.sh

# Expose the unprivileged port Nginx listens on so Railway routes traffic correctly
EXPOSE 8080

# Switch back to unprivileged user for secure runtime execution
USER www-data



