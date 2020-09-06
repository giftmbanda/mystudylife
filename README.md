
### Installation Instructions
1. Create a MySQL database for the project
2. From the projects root run `cp .env.example .env`
3. Configure your `.env` file
4. Run `sudo composer update` from the projects root folder
5. From the projects root folder run `php artisan key:generate`
6. From the projects root folder run `php artisan migrate`
7. From the projects root folder run `composer dump-autoload`
8. From the projects root folder run `php artisan db:seed`
