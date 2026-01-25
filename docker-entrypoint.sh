#!/bin/bash
set -e

echo "=== Starting Laravel Application ==="

# Get database path from environment variable first (Render.com sets this), then .env file, default to /var/data/database.sqlite
if [ -n "$DB_DATABASE" ]; then
    DB_PATH="$DB_DATABASE"
    echo "Using DB_DATABASE from environment: $DB_PATH"
elif [ -f .env ] && grep -q "^DB_DATABASE=" .env; then
    DB_PATH=$(grep "^DB_DATABASE=" .env | cut -d '=' -f2- | sed 's/^[[:space:]]*//;s/[[:space:]]*$//' | sed "s/^['\"]//;s/['\"]$//")
    # Handle relative paths - convert to absolute
    if [[ "$DB_PATH" != /* ]]; then
        DB_PATH="/var/www/$DB_PATH"
    fi
    echo "Using DB_DATABASE from .env: $DB_PATH"
else
    DB_PATH="/var/data/database.sqlite"
    echo "Using default DB_DATABASE: $DB_PATH"
fi

# Create directory and database file if they don't exist
echo "=== Creating database at: $DB_PATH ==="
mkdir -p "$(dirname "$DB_PATH")"
touch "$DB_PATH"
chmod 664 "$DB_PATH"
chmod 775 "$(dirname "$DB_PATH")" || true

# Verify database file exists and is writable
if [ ! -f "$DB_PATH" ]; then
    echo "ERROR: Database file could not be created at $DB_PATH"
    exit 1
fi

if [ ! -w "$DB_PATH" ]; then
    echo "ERROR: Database file is not writable at $DB_PATH"
    exit 1
fi

echo "Database file exists and is writable: $DB_PATH"

# Update .env file with the correct absolute path
if [ -f .env ]; then
    if grep -q "^DB_DATABASE=" .env; then
        sed -i "s|^DB_DATABASE=.*|DB_DATABASE=$DB_PATH|g" .env
    else
        echo "DB_DATABASE=$DB_PATH" >> .env
    fi
    echo "Updated .env with DB_DATABASE=$DB_PATH"
else
    echo "WARNING: .env file not found!"
fi

# Ensure storage and cache directories exist and have correct permissions
echo "=== Setting up storage and cache directories ==="
mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache || true
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# Clear all caches
echo "=== Clearing caches ==="
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Generate application key if not set
echo "=== Generating application key ==="
if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    php artisan key:generate --force
    echo "Application key generated"
else
    echo "Application key already exists"
fi

# Run migrations
echo "=== Running migrations ==="
php artisan migrate --force || {
    echo "ERROR: Migrations failed!"
    echo "Database path: $DB_PATH"
    echo "Database exists: $([ -f "$DB_PATH" ] && echo 'yes' || echo 'no')"
    echo "Database writable: $([ -w "$DB_PATH" ] && echo 'yes' || echo 'no')"
    exit 1
}

# Run seeders (only if not already seeded, or force if needed)
echo "=== Running seeders ==="
php artisan db:seed --force || {
    echo "WARNING: Seeders failed, but continuing..."
}

# Optimize for production
echo "=== Optimizing for production ==="
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Display final status
echo "=== Application ready ==="
echo "Database: $DB_PATH"
echo "Starting server on 0.0.0.0:10000"

# Start the server
exec php artisan serve --host=0.0.0.0 --port=10000

