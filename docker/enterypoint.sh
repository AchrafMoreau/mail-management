#!/bin/bash



if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for $APP_ENV"
    cp .env.example .env
else
    echo "env file exist"
fi


npm install
npm run build

php artisan config:clear
php artisan migrate
php artisan key:generate
php artisan db:seed
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan link:storage


php artisan serve --port=${APP_PORT:-8080} --host=0.0.0.0 --env=.env

exec docker-php-entrypoint "$@"