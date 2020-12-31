# api_php_laravel
** Author: ** Jose Eduardo Tirado Verbel

## Requisitos
* Composer
* Laravel v.7
* MySql
##  Instrucciones de Instalacion.
1. Clonar el proyecto de la siguiente URL: https://github.com/jotive/api_php_laravel
2. Instalar dependencias con Composer:
    Desde la consola, dentro de la carpeta raiz, utilizar el siguiente comando: composer install
3. Crear en la carpeta raiz el archivo .env verificando los datos de la conexion a la Base de Datos.
DB_HOST=localhost
DB_DATABASE=api_bd
DB_USERNAME=api_user
DB_PASSWORD=api_pass

Es importante haber creado el usuario en el motor de Base de Datos MYSQL, y a su vez se debe crear una base de datos con el nombre indicado. Si se desea utilizar otros datos, es recomendable hacer los cambios en el archivo .env

4. Debemos hacer las migraciones correspondientes con el comando "php artisan migrate --seed" en la consola.
5. Por ultimo correremos el proyecto con el siguiente comando "php artisan serve"
6. El usuario para hacer las pruebas tiene los siguietes datos:
Mail: admin@mail.co
Pss: 123456
