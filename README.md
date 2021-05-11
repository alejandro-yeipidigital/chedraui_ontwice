# Pepsico - Sabritas y Chedraui con Luis Miguel

## Requisitos
Los requerimientos necesarios para que el proyecto funcione son los siguientes:

- Linux, distibución utilizada por nosotros Ubuntu Server 18.04.03 LTS
- MySQL 5.7
    - CREATE USER 'sabritas'@'localhost' IDENTIFIED WITH mysql_native_password BY 'definido_por_l2a'; 
- PHP >= 7.4
    * Composer para poder emplear la carpeta vendor (https://getcomposer.org/download/)
- Apache2 o NGINX
    - En caso de Apache2 tener activo modo rewrite
    - En caso de Nginx dentro del sites-available tener la siguiente linea
        - location / {try_files $uri $uri/ /index.php?$query_string;}

Ahora para hacer funcionar el proyecto cuando es un dominio se puede hacer apuntando el dominio a la carpeta public, por ejemplo si el proyecto se encuentra en **/home/sabritas/public_html/**, entonces el site.conf debe estar apuntado a **/home/sabritas/public_html/public**.

## Configuración del Proyecto
Para ejecutar el proyecto es necesario ocupar composer de la siguiente manera:

- Posicionarse en la carpeta raíz del proyecto (/html) 
- Ejecutar 
    ````
    composer install
    ````
- Ejecutar los siguientes comandos:
    ````
    chown -R www-data:www-data bootstrap
    ````
    ````
    chmod -R 755 bootstrap
    ````
    ````
    chown -R www-data:www-data storage
    ````

- Permisos para Archivos **640**
- Permisos para Carpetas **750**

- Copiar el contenido del archivo .env.example a un nuevo archivo .env 
    ````
    cp .env.example .env
    ````

- Ejecutar:
    ````
    php artisan key:generate
    ````

### Configuración archivo .env
Líneas a cambiar:
````
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
ASSET_URL=http://localhost
````

Quedando de la siguiente manera con los cambios:
````
APP_ENV=production
APP_DEBUG=false
APP_URL=definido_por_l2a_con_https_sin_la_ultima_/
ASSET_URL=definido_por_l2a_con_https_sin_la_ultima_/
````

Modificar la frecuencia de creación del archivo de logs a daily:
`````
LOG_CHANNEL=daily
`````

### Configuración de Mails
Para la configuración del envío de mails es necesario agregar los siguientes valores dentro del archivo .env y configurar los accesos de acuerdo al provedor de mails que utilice L2A:
````
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
````

### Configuración de BD
Para configurar la Base de Datos se hace desde el .env que se acaba de copiar:
````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sabritas
DB_USERNAME=definido_por_l2a
DB_PASSWORD=definido_por_l2a
````

### Crear enlace simbólico de la carpeta storage
Para que el proyecto funcione correctamente es necesario generar un enlace simbólico de la carpeta storage a la carpeta public. Ejecutar:

````
php artisan storage:link
````

## Generar tablas dentro de la BD
Para generar tablas y el llenado de los datos es necesario ejecutar el siguiente comando:    
````
php artisan migrate --seed
````

# ACTUALIZACIÓN DE BASE DE DATOS - AJUSTES 
Necesitamos que se corran los siguientes comandos en la raíz del proyecto para actualizar unos campos en base de datos

````
composer dump-autoload
````

````
php artisan migrate:refresh --seed
````
