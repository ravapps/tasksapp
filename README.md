

## About this app installation



create  the folder on your machine
<br>
open cmd on windows machine  and move to created folder
<br>
git clone https://github.com/ravapps/tasksapp.git


<br>

Move to tasksapp folder 


<br>





Create a database in mysql



<br>Check system have  > Php8.0.13




<br>composer install




<br>rename .env.example to .env


<br>

Change following in .env file

<br>DB_CONNECTION=mysql

<br>DB_HOST=127.0.0.1

<br>DB_PORT=3306

<br>DB_DATABASE=tasksapp

<br>DB_USERNAME=root

<br>DB_PASSWORD=



<br>


<br>php artisan key:generate
<br>php artisan migrate


<br>php artisan serve
