<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel Tests

Examen practico.
Mauricio López Cházaro.

Utilizando Laravel 10.10 y filament 3.0.

## Preparación de la base de datos

```DROP DATABASE IF EXISTS examen_practico;```
```CREATE DATABASE examen_practico```
```CHARACTER SET utf8mb4```
```COLLATE utf8mb4_0900_ai_ci;```

```CREATE USER 'lrv_examen'@'localhost' IDENTIFIED BY 'VQJUynF0nIk7CPmLvEkIJfioUs2Bd5IQlxp0sO1KOBSDjIx3IliFths97mAUFBnndplP0gSuRTfaKD4r9bt+Og';```
```GRANT ALL PRIVILEGES ON examen_practico.* TO 'lrv_examen'@'localhost';```
```FLUSH PRIVILEGES;```

## Instalación de Paquetes
```composer install```<br />
```npm i```<br />

## Migraciones
```php artisan migrate```<br />
```php artisan make:filament-user```<br />
```php artisan db:seed```<br />

## Lanzamiento del proyecto
```php artisan serve```
```npm run dev```
