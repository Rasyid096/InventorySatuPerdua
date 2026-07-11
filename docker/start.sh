#!/bin/sh
set -e

echo "[start] running as $(id)"
export PORT="${PORT:-8080}"
echo "[start] using PORT=${PORT}"

echo "[start] rendering nginx config from template"
envsubst '${PORT}' < /etc/nginx/templates/default.conf.template > /etc/nginx/http.d/default.conf

echo "[start] preparing writable Laravel directories"
mkdir -p \
  /var/www/html/bootstrap/cache \
  /var/www/html/storage/app/public \
  /var/www/html/storage/framework/cache/data \
  /var/www/html/storage/framework/sessions \
  /var/www/html/storage/framework/views \
  /var/www/html/storage/logs
chown -R www-data:www-data /var/www/html/bootstrap/cache /var/www/html/storage
chmod -R ug+rwX /var/www/html/bootstrap/cache /var/www/html/storage

if [ ! -f /var/www/html/.env ] && [ -f /var/www/html/.env.deploy ]; then
  echo "[start] .env not found, copying .env.deploy -> .env"
  cp /var/www/html/.env.deploy /var/www/html/.env
fi

if [ -z "$APP_KEY" ] && grep -q "^APP_KEY=$" /var/www/html/.env 2>/dev/null; then
  echo "[start] generating APP_KEY"
  php /var/www/html/artisan key:generate --force || true
fi

echo "[start] clearing and caching config/routes/views"
php /var/www/html/artisan config:clear || true
php /var/www/html/artisan route:clear || true
php /var/www/html/artisan view:clear || true
php /var/www/html/artisan config:cache || true
php /var/www/html/artisan route:cache || true
php /var/www/html/artisan view:cache || true

echo "[start] running migrations (safe)"
php /var/www/html/artisan migrate --force || true

echo "[start] restoring PHP-FPM ownership after Artisan commands"
chown -R www-data:www-data /var/www/html/bootstrap/cache /var/www/html/storage
chmod -R ug+rwX /var/www/html/bootstrap/cache /var/www/html/storage

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
