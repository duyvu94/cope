git clone https://github.com/laravel/laravel.git laravel-app
docker run --rm -v $(pwd):/app composer install
sudo chown -R $USER:$USER laravel-app
cp laravel-app/.env.example laravel-app/.env
docker-compose up -d
docker-compose exec app nano .env
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan config:cache