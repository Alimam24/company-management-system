# Deployment Troubleshooting Guide

## 500 Server Error - Diagnostic Checklist

### 1. Check .env and Database Path

**In Render.com logs, look for:**
```
=== Starting Laravel Application ===
Using DB_DATABASE from .env: /var/data/database.sqlite
Database file exists and is writable: /var/data/database.sqlite
```

**Common issues:**
- Database path not set correctly
- .env file not created properly
- Database path is relative instead of absolute

**Fix:** The entrypoint script now automatically:
- Detects database path from environment or .env
- Creates the database file if it doesn't exist
- Updates .env with the correct absolute path

### 2. Ensure SQLite File Exists

**Check in logs:**
```
=== Creating database at: /var/data/database.sqlite ===
Database file exists and is writable: /var/data/database.sqlite
```

**If you see errors:**
- `ERROR: Database file could not be created` - Permission issue
- `ERROR: Database file is not writable` - Permission issue

**Fix:** The entrypoint script creates the database at runtime with proper permissions.

### 3. Permissions

**The entrypoint script now:**
- Creates storage directories with 775 permissions
- Sets database file to 664 permissions
- Attempts to set ownership (may fail in some environments, which is OK)

**Check logs for:**
```
=== Setting up storage and cache directories ===
```

### 4. Artisan Commands at Runtime (Not Build Time)

✅ **All artisan commands now run at runtime in the entrypoint script:**
- `php artisan config:clear`
- `php artisan key:generate --force`
- `php artisan migrate --force`
- `php artisan db:seed --force`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`

**This ensures:**
- Database is created and migrated at container startup
- Application key is generated
- Caches are cleared and rebuilt
- Everything is fresh on each deployment

### 5. Logs to Check

**In Render.com, check:**

1. **Build Logs:**
   - Look for composer install errors
   - Check for file permission issues
   - Verify Person.php model is created

2. **Runtime Logs:**
   - Look for the startup sequence:
     ```
     === Starting Laravel Application ===
     === Creating database at: ...
     === Setting up storage and cache directories ===
     === Clearing caches ===
     === Generating application key ===
     === Running migrations ===
     === Running seeders ===
     === Optimizing for production ===
     === Application ready ===
     ```

3. **Laravel Logs:**
   - Check `storage/logs/laravel.log` in the container
   - Look for specific error messages
   - Check for database connection errors

**To access logs in Render.com:**
- Go to your service → Logs tab
- Check both "Build Logs" and "Runtime Logs"
- Look for error messages or stack traces

### 6. Quick Local Test

**Test the Docker build locally:**

```bash
# Build the image
docker build -t test-app .

# Run the container
docker run -p 10000:10000 test-app

# In another terminal, check logs
docker logs <container-id>

# Test the application
curl http://localhost:10000
```

**Or use the check script:**
```bash
chmod +x check-deployment.sh
./check-deployment.sh
```

## Common 500 Error Causes

### 1. Missing APP_KEY
**Symptom:** Blank page or 500 error
**Fix:** Entrypoint script now generates it automatically

### 2. Database Connection Error
**Symptom:** "Database file does not exist" or "SQLSTATE[HY000]"
**Fix:** Entrypoint script creates database at runtime

### 3. Permission Errors
**Symptom:** "Permission denied" in logs
**Fix:** Entrypoint script sets proper permissions

### 4. Cache Issues
**Symptom:** Old configuration cached
**Fix:** Entrypoint script clears all caches before starting

### 5. Missing Dependencies
**Symptom:** "Class not found" errors
**Fix:** Composer install runs in Dockerfile, autoloader is regenerated

## Debugging Steps

1. **Check Render.com logs** for the startup sequence
2. **Look for ERROR messages** in the entrypoint script output
3. **Verify database path** is correct and file exists
4. **Check permissions** on storage and database directories
5. **Review Laravel logs** in `storage/logs/laravel.log`
6. **Test locally** with Docker to reproduce the issue

## What Was Fixed

✅ Enhanced entrypoint script with:
- Better error handling and logging
- Database path detection and creation
- Permission setup
- Cache clearing and optimization
- Detailed status messages

✅ Improved Dockerfile:
- Better permission handling
- Storage directory creation
- Case-sensitive file fixes

✅ Added diagnostic tools:
- `check-deployment.sh` script for local testing
- This troubleshooting guide

## Next Steps

1. Deploy the updated code
2. Check Render.com logs for the startup sequence
3. Look for any ERROR messages
4. If still getting 500 error, check `storage/logs/laravel.log` for specific Laravel errors
5. Share the error messages from logs for further debugging

