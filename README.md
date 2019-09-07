# ShoppingListApi

Backend API to manage your shopping list, written with Laravel.
Manage your shopping list and share them with your family and flatmates.

## Why is this so awesome?

- **Multiple shopping lists** | You can create multiple shopping lists.
- **Share shopping lists** | You can share shopping lists with a view clicks click with other users or via Social Media (Telegram, E-Mail, etc.).
- **Desktop and mobile apps** | They are comming soon...
- **Sync with other devices** | Sync with other devices at your account.
- **Offline editing** | Manage your lists offline and sync them after you connected to the internet.

## Getting Started

Get the latest [release](https://git.narrenhaus.ch/Narrenhaus/ShoppingListApi/releases) or clone the repo with
```
git clone https://git.narrenhaus.ch/Narrenhaus/ShoppingListApi.git
```

### Prerequisites

- LAMP Stack (only on production)
- Requirements for [laravel](https://laravel.com/docs)
- Composer

### Installing

- Copy .env.example to .env and modify it to your needs
- Generate an app key `php artisan key:generate`
- Migrate the database `php artisan migrate`
- Install composer dependencies `composer install`
- Add following to your crontab:
```
  0  6  *  *  * www-data   cd /path-to-the-project && php artisan cleanup >> /dev/null 2>&1
```
- Run the server `php artisan serve`

## Deployment

- Install the software as above described
- Optimize autoloader `composer install --optimize-autoloader --no-dev`
- Enable caching

```
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Update

- Get the latest source (see [Getting Started](#getting-started))
- Migrate the database `php artisan migrate`
- Install composer packages `composer install`

## Built With

* [laravel/laravel](https://github.com/laravel/laravel) - A PHP framework for web artisans
* [Askedio/laravel-soft-cascade](https://github.com/Askedio/laravel-soft-cascade) - Cascade Delete & Restore when using Laravel SoftDeletes

## Authors

* **Benjamin Ammann** - *Initial work* - [ammannbe](https://github.com/ammannbe)

## License

This project is licensed under the AGPLv3 or later - see the [LICENSE](LICENSE) file for details
