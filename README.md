
### Installation Instructions
1. Create a MySQL database for the project
2. From the projects root run `cp .env.example .env`
3. Configure your `.env` file
4. Run `sudo composer update` from the projects root folder
5. From the projects root folder run `sudo chmod -R 755 ../laravel-auth`
6. From the projects root folder run `php artisan key:generate`
7. From the projects root folder run `php artisan migrate`
8. From the projects root folder run `composer dump-autoload`
9. From the projects root folder run `php artisan db:seed`
