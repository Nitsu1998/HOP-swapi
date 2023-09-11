# API HOP-swapi with Laravel

El siguiente proyecto es una extension de la API SWAPI para controlar el inventario de *starships* y *vehicles* contando con las siguientes caracteristicas:

* Migraciones con importación de los actuales *starships* y *vehicles* de SWAPI.
* Modelos para *starships* y *vehicles* con herencia.
* Manejo de inventario de cada *starships* y *vehicles* con sus rutas y controladores. 
* Validacion de datos en la *request* como tambien *excepciones* para la busqueda por ID.
* Documentacion de rutas con sus especificaciones y caracteristicas accediendo a "/api/documentation" una vez levantado el proyecto.

## Instrucciones para levantar proyecto:

* Clonar el proyecto con *git clone https://github.com/Nitsu1998/HOP-swapi.git*
* Ejecutar *composer install* dentro del proyecto.
* Craer base de datos (mysql) y abrir .env y cambiar el nombre de la base de datos (DB_DATABASE) al que tenga, el campo de nombre de usuario (DB_USERNAME) y contraseña (DB_PASSWORD) que correspondan a su configuración.
* Ejecutar *php artisan key:generate*
* Ejecutar las migraciones con *php artisan migrate*, tener en cuenta que cargara de la API SWAPI todos los *starships* y *vehicles*.
* Levantar el proyecto con *php artisan serve*

## Libreria:

* Se utilizo *l5-swagger* para la redaccion de la documentación. 

