# TESTE

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development  purposes.

### Prerequisites

- [php 7.2+](https://www.rosehosting.com/blog/how-to-install-php-7-2-on-ubuntu-16-04/)
- [laravel 5.2](https://laravel.com/docs/5.2)
- [mysql](https://dev.mysql.com/doc/refman/8.0/en/linux-installation.html)

### Installing

1 - Install Dependencies

```
$ composer install 
```
2 - Create [.env](https://github.com/laravel/laravel/blob/master/.env.example) file and change **DB_DATABASE** variable to **teste**
```
DB_DATABASE=imovesys
```
3 - Run migrations to database
```
$ php artisan migrate
```
4 - Run seeders to database
```
$ php artisan db:seed
```
5 - Generate encrypt key
```
$ php artisan key:generate
```
