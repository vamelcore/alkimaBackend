<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to setup Laravel Project

All test task based on Laravel Framework. Development environment based on Docker. For setup project:

- Pull this repository.
- In command prompt setup docker:
```bash
docker compose build
docker compose up -d
```
- Create Database fro test task (testTask)
- Rename .env.example to .env
- Setup Laravel Framework:
```bash
docker compose exec -it app /bin/bash
composer install
php artisan migrate
```

## API Routes

Project has Swagger OA Documentation on link http://{IP_ADDRESS}/api

Check real development Swagger API for this test task on link: [http://144.24.251.173/api](http://144.24.251.173/api)

You can import Swagger JSON to Postman

## Console commands

For import categories from json-file, it should be placed in storage directory. 
```bash
php artisan command:parse:json:products {PATH_TO_FILE_IN_STORAGE.json}
```

Categories import example: /storage/import/json/categories.json
```bash
php artisan command:parse:json:products import/json/categories.json
```
Products import example: /storage/import/json/products.json
```bash
php artisan command:parse:json:products import/json/products.json
```

Please, pay attention, I used "categories" instead of "category" in import files for convention reasons.
