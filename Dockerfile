FROM serversideup/php:8.2-fpm-nginx

# Switch to root to perform administration tasks
USER root

# Set the working directory
WORKDIR /var/www/html

# Copy all application files with proper permissions using the numeric UID/GID for webuser
COPY --chown=9999:9999 . /var/www/html

# Expose port 8080
EXPOSE 8080

# Install production dependencies, set web service permissions, and configure Nginx directories for non-root execution
RUN composer install --no-dev --optimize-autoloader --no-scripts && \
    chown -R 9999:9999 /var/www/html && \
    docker-php-serversideup-set-file-permissions --owner 9999:9999 --service nginx

# Switch back to the unprivileged user for safe execution in restricted container environments like Railway
USER 9999
