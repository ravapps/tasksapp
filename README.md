

## About this app installation

create  the folder on your machine

Unzip the zip file

Create a database in mysql

Change following in .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tasksapp
DB_USERNAME=root
DB_PASSWORD=


Check system have  > Php8.0.13


php artisan migrate

php artisan serve
