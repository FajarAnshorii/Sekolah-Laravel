FROM serversideup/php:8.2-fpm-nginx

# Switch to root to perform administration tasks
USER root

# Set the working directory
WORKDIR /var/www/html

# Copy all application files with proper permissions using the numeric UID/GID for webuser
COPY --chown=9999:9999 . /var/www/html

# Expose port 8080
EXPOSE 8080

# Install production dependencies as root, then ensure all files are owned by webuser using its numeric UID/GID (9999)
RUN composer install --no-dev --optimize-autoloader --no-scripts && \
    chown -R 9999:9999 /var/www/html

# Restore the default unprivileged user for the container
USER 9999
