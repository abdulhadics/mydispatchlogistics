#!/bin/bash

# MyDispatch Logistics - Deployment Script
# Run this script to prepare your application for production deployment

echo "🚀 MyDispatch Logistics - Production Deployment Script"
echo "=================================================="

# Check if required files exist
echo "📋 Checking required files..."

required_files=(
    "config/config.php"
    "database/schema.sql"
    ".htaccess"
    "pages/404.php"
    "pages/500.php"
)

for file in "${required_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing - Please create this file"
        exit 1
    fi
done

# Create uploads directory if it doesn't exist
echo "📁 Creating uploads directory..."
mkdir -p uploads
chmod 755 uploads

# Create error log file
echo "📝 Creating error log file..."
touch error.log
chmod 644 error.log

# Check PHP version
echo "🐘 Checking PHP version..."
php_version=$(php -r "echo PHP_VERSION;")
echo "PHP Version: $php_version"

if [[ $(php -r "echo version_compare(PHP_VERSION, '7.4.0', '>=');") == "1" ]]; then
    echo "✅ PHP version is compatible"
else
    echo "❌ PHP version must be 7.4 or higher"
    exit 1
fi

# Generate a random secret key
echo "🔐 Generating secret key..."
secret_key=$(php -r "echo bin2hex(random_bytes(32));")
echo "Generated secret key: $secret_key"
echo "Please update this in config/config.php"

# Check database connection (optional)
echo "🗄️  Testing database connection..."
if php -r "
try {
    require_once 'config/config.php';
    require_once 'config/database.php';
    \$db = getDB();
    echo 'Database connection successful';
} catch (Exception \$e) {
    echo 'Database connection failed: ' . \$e->getMessage();
    exit(1);
}
"; then
    echo "✅ Database connection test passed"
else
    echo "⚠️  Database connection test failed - Please check your database credentials"
fi

# Create backup of config file
echo "💾 Creating backup of config file..."
cp config/config.php config/config.php.backup
echo "✅ Backup created: config/config.php.backup"

# Display deployment checklist
echo ""
echo "📋 DEPLOYMENT CHECKLIST:"
echo "========================"
echo "1. ✅ Update config/config.php with production settings:"
echo "   - APP_URL: https://yourdomain.com"
echo "   - Database credentials from your hosting provider"
echo "   - Secret key: $secret_key"
echo ""
echo "2. ✅ Upload all files to your web server:"
echo "   - Upload to public_html or www directory"
echo "   - Maintain folder structure"
echo ""
echo "3. ✅ Set up database:"
echo "   - Create database in hosting control panel"
echo "   - Import database/schema.sql via phpMyAdmin"
echo "   - Update admin password"
echo ""
echo "4. ✅ Configure server:"
echo "   - Ensure .htaccess file is uploaded"
echo "   - Set proper file permissions (644 for files, 755 for directories)"
echo "   - Enable SSL certificate"
echo ""
echo "5. ✅ Test your website:"
echo "   - Visit your domain"
echo "   - Test user registration/login"
echo "   - Test contact form"
echo "   - Test admin panel"
echo ""
echo "🎉 Deployment preparation complete!"
echo ""
echo "Next steps:"
echo "- Update config/config.php with your production settings"
echo "- Upload files to your web server"
echo "- Set up database and test"
echo ""
echo "For detailed instructions, see DEPLOYMENT.md"
