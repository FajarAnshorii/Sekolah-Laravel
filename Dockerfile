FROM serversideup/php:8.2-fpm-nginx

# Switch to root to perform administration tasks
USER root

# Set the working directory
WORKDIR /var/www/html

# Copy all application files with proper permissions using the numeric UID/GID for webuser
COPY --chown=9999:9999 . /var/www/html

# Install production dependencies, set web service permissions, and configure Nginx directories for non-root execution
RUN composer install --no-dev --optimize-autoloader --no-scripts && \
    chown -R 9999:9999 /var/www/html && \
    docker-php-serversideup-set-file-permissions --owner 9999:9999 --service nginx && \
    chown -R 9999:9999 /etc/nginx

# Copy custom entrypoint script to dynamically configure the Nginx listen port based on $PORT env var at startup
COPY --chown=9999:9999 docker/99-set-nginx-port.sh /etc/entrypoint.d/99-set-nginx-port.sh
RUN sed -i 's/\r$//' /etc/entrypoint.d/99-set-nginx-port.sh && \
    chmod +x /etc/entrypoint.d/99-set-nginx-port.sh

# Switch back to unprivileged user for secure runtime execution
USER 9999



