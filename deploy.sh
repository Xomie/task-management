#!/usr/bin/env bash

# Start the Laravel development server in the background
php artisan serve --host=0.0.0.0 --port=8000 &

# Optimize Laravel
php artisan optimize:clear
php artisan optimize

# Create storage symlink
php artisan storage:link

# Self-ping loop to keep service awake (every 5 minutes)
(
  while true
  do
    echo "Pinging to stay awake..."
    curl -s https://task-management-lox5.onrender.com/ping > /dev/null
    sleep 300
  done
) &

# Keep the container running
wait
