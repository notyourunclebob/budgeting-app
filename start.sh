#!/bin/bash

# Run composer install if vendor directory is missing
if [ ! -d "vendor" ]; then
    echo "📦 Running local composer install..."
    composer install
fi

# Start Sail in the background
echo "🛳️ Starting Laravel Sail..."
./vendor/bin/sail up -d

# Wait for MySQL to be ready
echo "⏳ Waiting for MySQL to be healthy..."

MYSQL_CONTAINER=$(docker compose ps -q mysql)

until [ "$(docker inspect -f '{{.State.Health.Status}}' $MYSQL_CONTAINER)" == "healthy" ]; do
  sleep 1
done


echo "✅ MySQL is ready."

# Run migrations
echo "🗃️ Running migrations..."
./vendor/bin/sail artisan migrate

# Check if node_modules exists before running npm install
if [ ! -d "node_modules" ]; then
    echo "📦 Installing npm packages..."
    ./vendor/bin/sail npm install
fi

# Compile front-end assets
echo "🛠️ Running npm dev build..."
./vendor/bin/sail npm run dev
