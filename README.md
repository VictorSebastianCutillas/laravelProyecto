composer create-project laravel/laravel Proyecto

sudo chown -R $(whoami) Proyecto

cd Proyecto/

php artisan serve

sudo composer install

php artisan make:migration create_alumno_table

php artisan migrate

php artisan make:seeder AlumnoSeeder

php artisan db:seed o php artisan db:seed --class=AlumnoSeeder

php artisan make:controller AlumnoController

php artisan make:middleware AsegurarIdNumericoEnteroPositivo

