#!/bin/sh
set -e
export DB_PATH="${DB_PATH:-/var/www/data/app.sqlite}"
php /var/www/db/seed.php
chown -R www-data:www-data /var/www/data
# Render provides $PORT; default to 80
sed -i "s/Listen 80/Listen ${PORT:-80}/; s/:80>/:${PORT:-80}>/" /etc/apache2/ports.conf /etc/apache2/sites-enabled/000-default.conf
exec apache2-foreground
