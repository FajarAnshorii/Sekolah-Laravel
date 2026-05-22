FROM serversideup/php:8.2-fpm-nginx

# Switch to root to perform administration tasks
USER root

# Set the working directory
WORKDIR /var/www/html

# Copy all application files with proper permissions
COPY --chown=webuser:webuser . /var/www/html

# Expose port 8080
EXPOSE 8080

# Switch back to the non-root webuser
USER webuser

# Install production dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts


