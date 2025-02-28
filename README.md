# Aras DSS Application
##### Step 1 - Clone repositori ke local device
```
git clone ... 
```
##### Step 2 - Update composer
```
composer update
```
##### Step 3 - Copy file .env
```
cp .env.example .env
```
##### Step 4  - Generate key application
```
php artisan key:generate
```
##### Step 5 - Run Migration
```
php artisan migrate
```
##### Step 6 - Run Seeder 
```
php artisan db:seed
```
##### Step 7 - Run Application
```
php artisan serve
```
