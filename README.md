# Installation

1. run `composer install`
2. Copy `.env` from `.env.example`
3. Make sure you create database first (then update the `.env` file)
4. run `php artisan migrate` or `php artisan migrate:fresh`
7. start server by running `php -S 127.0.0.1:8000