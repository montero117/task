# Task Management App

Este es un sistema de gestión de tareas desarrollado con Laravel Sail.

## Requisitos

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- Git

## Instalación

1. Clona este repositorio:

   ```bash
   git clone https://github.com/montero117/task.git

2. Navega al directorio de la aplicación:

   ```bash
   cd task
   
3. instalar Sail usando el administrador de paquetes Composer. Por supuesto, estos pasos suponen que su entorno de desarrollo local existente le permite instalar dependencias de Composer:
     ```bash
    composer require laravel/sail --dev

4. Una vez instalado Sail, puede ejecutar el sail:install comando de php artisan. Este comando publicará docker-compose.yml el archivo de Sail en la raíz de su aplicación y modificará su .env con las variables de entorno requeridas para conectarse a los servicios de Docker:
    
     ```bash
    php artisan sail:install

6. Finalmente, puedes iniciar el container: 
     ```bash
    ./vendor/bin/sail up

8. ejecutar la migracion de la base de datos en laravel sail
    ```bash
   ./vendor/bin/sail php artisan migrate
7.Accede a la aplicación en tu navegador:
http://localhost

## Uso
La aplicación se encuentra ahora en ejecución en http://localhost.
![image](https://github.com/montero117/task/assets/41376332/181a1dfc-a84a-4c3f-88a7-20d87112f869)

