# API HOP-swapi with Laravel

El siguiente proyecto es una extension de la API SWAPI para controlar el inventario de *starships* y *vehicles* contando con las siguientes caracteristicas:

* Migraciones con importacion de los actuales *starships* y *vehicles* de SWAPI.
* Modelos para *starships* y *vehicles* con herencia.
* Manejo de inventario de cada *starships* y *vehicles* con sus rutas y controladores. 
* Validacion de datos en la *request* como tambien *excepciones* para la busqueda por ID.
* Documentacion de rutas con sus especificaciones y caracteristicas accediendo a "/api/documentation" una vez levantado el proyecto.

## Instrucciones para levantar proyecto:

* Clonar el proyecto con git clone https://github.com/Nitsu1998/HOP-swapi.git
* Craer base de datos y configurar .env, solamente sera necesario poner el nombre de la base de datos en el caso de ser local.
* Correr las migraciones con *php artisan migrate*, tener en cuenta que cargara de la API SWAPI todos los *starships* y *vehicles*.
* Levantar el proyecto con *php artisan serve*

## Libreria:

* Se utilizo *l5-swagger* para la redaccion de la documentacion. 

