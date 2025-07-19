#!/usr/bin/env bash

# Start the Laravel development server in the background
php artisan serve --host=0.0.0.0 --port=8000 &

# Optimize Laravel
php artisan optimize:clear
php artisan optimize

# Create storage symlink
php artisan storage:link

# Keep the container running
wait
