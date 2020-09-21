# ShoppingListApi

Backend API to manage your shopping list, written with Laravel.
Manage your shopping list and share them with your family and flatmates.

## Why is this so awesome?

-   **Multiple shopping lists** | You can create multiple shopping lists.
-   **Share shopping lists** | You can share shopping lists with a view clicks click with other users or via Social Media (Telegram, E-Mail, etc.).
-   **Desktop and mobile apps** | They are comming soon...
-   **Sync with other devices** | Sync with other devices at your account.
-   **Offline editing** | Manage your lists offline and sync them after you connected to the internet.

## Getting Started

Get the latest [release](https://git.narrenhaus.ch/Narrenhaus/ShoppingListApi/releases) or clone the repo with

```
git clone https://git.narrenhaus.ch/Narrenhaus/ShoppingListApi.git
```

### Prerequisites

-   LAMP Stack (only on production)
-   Requirements for [laravel](https://laravel.com/docs)
-   Composer

### Installing

-   Copy .env.example to .env and modify it to your needs
-   Generate an app key `php artisan key:generate`
-   Migrate the database `php artisan migrate`
-   Install composer dependencies `composer install`
-   Add following to your crontab:

```
  0  6  *  *  * www-data   cd /path-to-the-project && php artisan cleanup >> /dev/null 2>&1
```

-   Run the server `php artisan serve`

## Deployment

-   Install the software as above described
-   Optimize autoloader `composer install --optimize-autoloader --no-dev`
-   Enable caching

```
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Update

-   Get the latest source (see [Getting Started](#getting-started))
-   Migrate the database `php artisan migrate`
-   Install composer packages `composer install`

## IDE helpers

You get better IDE IntelliSense support with the [laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper) package.

You need to generate the helpers by yourself:

```bash
composer run ide-helper:generate
```

After that, you should run the commands from [Testing / Code Quality](#testing-/-code-quality).

## Testing / Code Quality

-   Run static code analytics `composer run phpstan`
-   Run PHP Coding Standards Fixer `composer run php-cs-fixer`

## Built With

-   [barryvdh/laravel-cors](https://github.com/barryvdh/laravel-cors) - Adds CORS (Cross-Origin Resource Sharing) headers support in your Laravel application
-   [laravel/laravel](https://github.com/laravel/laravel) - A PHP framework for web artisans.
-   [laravel/telescope](https://github.com/laravel/telescope) - Laravel Telescope is an elegant debug assistant for the Laravel framework.
-   [nunomaduro/larastan](https://github.com/nunomaduro/larastan) - Adds static analysis to Laravel improving developer productivity and code quality
-   [stechstudio/Laravel-PHP-CS-Fixer](https://github.com/stechstudio/Laravel-PHP-CS-Fixer) - Artisan Command for FriendsOfPHP/PHP-CS_Fixer
-   [laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper) - Laravel IDE Helper

## Authors

-   **Benjamin Ammann** - _Initial work_ - [ammannbe](https://github.com/ammannbe)

## License

This project is licensed under the AGPLv3 or later - see the [LICENSE](LICENSE) file for details
