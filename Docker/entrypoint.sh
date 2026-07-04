#!/bin/bash

if [ ! -f ".env" ]; then
    echo "Создаю .env из .env.example..."
    cp .env.example .env
fi

if [ ! -d "vendor" ]; then
    echo "Устанавливаю зависимости Composer..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if ! grep -q "APP_KEY=base64:" .env || [ -z "$(grep APP_KEY .env | cut -d= -f2)" ]; then
    echo "Генерирую ключ Laravel..."
    php artisan key:generate
fi

echo "Запускаю миграции базы данных..."
php artisan migrate --force 

echo "Запускаю веб-сервер..."
exec php artisan serve --host=0.0.0.0 --port=8000