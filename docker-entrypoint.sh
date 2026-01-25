#!/bin/bash
set -e

# Get database path from environment variable first (Render.com sets this), then .env file, default to /var/data/database.sqlite
if [ -n "$DB_DATABASE" ]; then
    DB_PATH="$DB_DATABASE"
elif [ -f .env ] && grep -q "^DB_DATABASE=" .env; then
    DB_PATH=$(grep "^DB_DATABASE=" .env | cut -d '=' -f2- | sed 's/^[[:space:]]*//;s/[[:space:]]*$//' | sed "s/^['\"]//;s/['\"]$//")
    # Handle relative paths - convert to absolute
    if [[ "$DB_PATH" != /* ]]; then
        DB_PATH="/var/www/$DB_PATH"
    fi
else
    DB_PATH="/var/data/database.sqlite"
fi

# Create directory and database file if they don't exist
echo "Creating database at: $DB_PATH"
mkdir -p "$(dirname "$DB_PATH")"
touch "$DB_PATH"
chmod 664 "$DB_PATH"

# Update .env file with the correct absolute path
if [ -f .env ]; then
    if grep -q "^DB_DATABASE=" .env; then
        sed -i "s|^DB_DATABASE=.*|DB_DATABASE=$DB_PATH|g" .env
    else
        echo "DB_DATABASE=$DB_PATH" >> .env
    fi
fi

# Generate application key if not set
php artisan key:generate --force || true

# Run migrations
php artisan migrate --force

# Run seeders
php artisan db:seed --force

# Start the server
exec php artisan serve --host=0.0.0.0 --port=10000

