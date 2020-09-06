#MyStudyLife
A student attendance register system, the web app allows a student to log their class attendance via a GPS enabled smart phone. The student turn on GPS/Location on their device, logs in and select "Attend" for the module being lectured that their present at. The system checks the student's Device GPS Coordinate against the assigned Vanues's GPS coordinates, and checks the student's Device GPS Coordinate ping time against the Subject's assigned attendance time then process the attendance. This project is developed with Laravel and it makes use of MySQL database.

### Installation Instructions
1. Create a MySQL database for the project
2. From the projects root run `cp .env.example .env`
3. Configure your `.env` file
4. Run `sudo composer update` from the projects root folder
5. From the projects root folder run `php artisan key:generate`
6. From the projects root folder run `php artisan migrate`
7. From the projects root folder run `composer dump-autoload`
8. From the projects root folder run `php artisan db:seed`
9. From the projects root folder run `php artisan serve`
