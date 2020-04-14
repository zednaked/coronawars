set DB_DATABASE=coronawars
set DB_USERNAME=root
set DB_PASSWORD=
set DB_SOCKET=C:/wamp64/bin/mariadb/mariadb10.4.10/mariadb.sock

php artisan migrate
php artisan passport:keys