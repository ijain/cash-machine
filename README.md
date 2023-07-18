#### Cash Machine

The project is using Sqlite database. The database is located here: database/database.sqlite

cp .env.dev .env
composer install
php artisan migrate
php artisan serve

Go to the address generate by `php artisan serve` command, for example: http://127.0.0.1:8000
