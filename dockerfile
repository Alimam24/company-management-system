FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Fix case-sensitive file naming issues (Windows to Linux)
# Rename person.php to Person.php if it exists (case-sensitive filesystem fix)
RUN if [ -f app/Models/person.php ] && [ ! -f app/Models/Person.php ]; then \
        mv app/Models/person.php app/Models/Person.php; \
    fi

# Copy and set permissions for entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Create SQLite database file and ensure proper permissions
# Create both possible database locations (Render.com uses /var/data, standard uses /var/www/database)
RUN mkdir -p database /var/data storage/framework/{sessions,views,cache} storage/logs && \
    touch database/database.sqlite /var/data/database.sqlite && \
    chmod 664 database/database.sqlite /var/data/database.sqlite && \
    chmod -R 775 storage bootstrap/cache /var/data

# Copy .env.example to .env
# Use /var/data/database.sqlite for Render.com compatibility, fallback to /var/www/database/database.sqlite
RUN cp .env.example .env && \
    if grep -q "^DB_DATABASE=" .env; then \
        sed -i 's|^DB_DATABASE=.*|DB_DATABASE=/var/data/database.sqlite|g' .env; \
    else \
        echo "DB_DATABASE=/var/data/database.sqlite" >> .env; \
    fi

# Install PHP dependencies and regenerate autoloader
RUN composer install --no-dev --optimize-autoloader && \
    composer dump-autoload --optimize

# Expose port
EXPOSE 10000

# Use entrypoint scriptFROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Fix case-sensitive file naming issues (Windows to Linux)
# Rename person.php to Person.php if it exists (case-sensitive filesystem fix)
RUN if [ -f app/Models/person.php ] && [ ! -f app/Models/Person.php ]; then \
        mv app/Models/person.php app/Models/Person.php; \
    fi

# Copy and set permissions for entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Create SQLite database file and ensure proper permissions
# Create both possible database locations (Render.com uses /var/data, standard uses /var/www/database)
RUN mkdir -p database /var/data storage/framework/{sessions,views,cache} storage/logs && \
    touch database/database.sqlite /var/data/database.sqlite && \
    chmod 664 database/database.sqlite /var/data/database.sqlite && \
    chmod -R 775 storage bootstrap/cache /var/data

# Copy .env.example to .env
# Use /var/data/database.sqlite for Render.com compatibility, fallback to /var/www/database/database.sqlite
RUN cp .env.example .env && \
    if grep -q "^DB_DATABASE=" .env; then \
        sed -i 's|^DB_DATABASE=.*|DB_DATABASE=/var/data/database.sqlite|g' .env; \
    else \
        echo "DB_DATABASE=/var/data/database.sqlite" >> .env; \
    fi

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port
EXPOSE 10000

# Use entrypoint script
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]