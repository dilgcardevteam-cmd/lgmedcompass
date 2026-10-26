FROM serversideup/php:8.3-fpm-nginx

# 1. Install Node.js (needed for npm run build)
USER root
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# 2. Set the working directory
WORKDIR /var/www/html

# 3. Copy application code
COPY --chown=www-data:www-data . .

# 4. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 5. Install JS dependencies and BUILD assets
RUN npm install && npm run build

# 6. Final Permissions & Migration Script
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    mkdir -p /etc/entrypoint.d && \
    echo "php artisan migrate --force --seed" > /etc/entrypoint.d/migrate.sh && \
    chmod +x /etc/entrypoint.d/migrate.sh

# 7. SWITCH BACK to www-data
USER www-data