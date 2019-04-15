## Ganzory Queue Management System

This is the queue management application for Ganzory hospital.

## Technology Used

We used latest technologies for front-end and back-end like:
 
- Ubold Adminpanel
- Laravel framework
- Vue js
- Pusher & Laravel Websokets
- Laravel Echo

## Installation

Follow this steps:
 
- composer install
- npm install
- npm install --save laravel-echo pusher-js
- php artisan key:generate
- php artisan project:refresh
- php artisan migrate
- php artisan db:seed

## Configurations

Follow this steps:
 
- config => vars.php
- env => Database
- env => Pusher

## Run the application

Follow this steps:
 
- php artisan serve
- php artisan websockets:serve

## References
- https://laravel.com/
- https://docs.beyondco.de/laravel-websockets/
- https://yajrabox.com/docs/laravel-oci8/master
- https://vuejs.org/
- https://cli.vuejs.org/