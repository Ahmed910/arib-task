# Arib Installation Instructions

Follow these steps to get your development environment set up on your local machine:

# 1. Direct Installation
01. Install composer packages
```bash
composer install --ignore-platform-reqs
composer dump-autoload
```

02. Create database
```bash
mysql -u root -p
CREATE DATABASE arib;
QUIT;
```

03. Migrate database
```bash
vim .env
php artisan config:clear
php artisan migrate
php artisan db:seed
```

05. Change files/folders permissions
```bash
sudo chown -R www-data:www-data .
sudo find . -type f -exec chmod 644 {} \;
sudo find . -type d -exec chmod 755 {} \;
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

06. Link storage
```bash
php artisan storage:link
```
