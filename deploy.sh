#!/bin/bash
echo "Deploying Laravel Test Application..."
docker-compose up -d --build
docker-compose exec app composer install
docker-compose exec app cp .env.example .env
docker-compose exec app php artisan key:generate
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app php artisan migrate:fresh --seed
docker-compose exec app npm install
docker-compose exec app npm run build
echo "Deployment completed! Visit http://localhost"
