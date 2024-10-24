# Laravel ADmin Lte

## Description
Implementasi AdminLte dengan laravel

## Requirements
- PHP >= 8.2
- Composer
- Laravel >= 11.x
- Database (MySQL, Sqlite)

## Installation

Follow these steps to set up the project on your local machine:
   ```bash
   git clone https://github.com/Ryxena/adminlte-11.git
   cd adminlte-11
   composer install && npm i
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed

