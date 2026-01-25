#!/bin/bash
# Quick deployment check script
# Run this locally to test your deployment configuration

echo "=== Deployment Check Script ==="
echo ""

echo "1. Checking .env.example..."
if [ -f .env.example ]; then
    echo "✓ .env.example exists"
    echo "  DB_CONNECTION: $(grep '^DB_CONNECTION=' .env.example | cut -d'=' -f2)"
    echo "  DB_DATABASE: $(grep '^DB_DATABASE=' .env.example | cut -d'=' -f2)"
else
    echo "✗ .env.example not found!"
fi

echo ""
echo "2. Checking database configuration..."
if [ -f config/database.php ]; then
    echo "✓ config/database.php exists"
    if grep -q "database_path('database.sqlite')" config/database.php; then
        echo "✓ SQLite default path configured"
    fi
else
    echo "✗ config/database.php not found!"
fi

echo ""
echo "3. Checking storage directories..."
for dir in storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache; do
    if [ -d "$dir" ]; then
        echo "✓ $dir exists"
    else
        echo "✗ $dir missing (will be created at runtime)"
    fi
done

echo ""
echo "4. Checking Dockerfile..."
if [ -f dockerfile ]; then
    echo "✓ dockerfile exists"
    if grep -q "docker-entrypoint.sh" dockerfile; then
        echo "✓ Entrypoint script configured"
    fi
    if grep -q "composer install" dockerfile; then
        echo "✓ Composer install configured"
    fi
else
    echo "✗ dockerfile not found!"
fi

echo ""
echo "5. Checking entrypoint script..."
if [ -f docker-entrypoint.sh ]; then
    echo "✓ docker-entrypoint.sh exists"
    if [ -x docker-entrypoint.sh ]; then
        echo "✓ Entrypoint script is executable"
    else
        echo "⚠ Entrypoint script is not executable (will be fixed in Dockerfile)"
    fi
    if grep -q "DB_DATABASE" docker-entrypoint.sh; then
        echo "✓ Database path handling configured"
    fi
else
    echo "✗ docker-entrypoint.sh not found!"
fi

echo ""
echo "6. Checking Person model..."
if [ -f app/Models/Person.php ]; then
    echo "✓ app/Models/Person.php exists (correct case)"
elif [ -f app/Models/person.php ]; then
    echo "⚠ app/Models/person.php exists (lowercase - will be renamed in Docker)"
else
    echo "✗ Person model not found!"
fi

echo ""
echo "=== Check Complete ==="
echo ""
echo "To test locally:"
echo "  1. docker build -t test-app ."
echo "  2. docker run -p 10000:10000 test-app"
echo "  3. Check http://localhost:10000"
echo ""
echo "To check logs in deployment:"
echo "  - Render.com: Check build logs and runtime logs"
echo "  - Look for '=== Starting Laravel Application ===' messages"
echo "  - Check for database path and permission messages"

