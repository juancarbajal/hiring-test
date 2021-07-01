# Sistema de examen virtual 

## Url de acceso 
http://<host>/index.php?t=<id de candidato>
ejm:
http://miweb.com/index.php?t=123456789

## Examen
El examen se guarda en la carpeta template en formato html. Ver archivo template/README.mk

## Requisitos de sistema 
- php 5 o superior
- Sqlite 3

## Pasos de instalación 
- Create base de datos data/hiring.sdb con el script data/hiring.sql
- Create examen en html en la carpeta template. Revisar el archivo template/README.mk para mayor detalle. 
- Modificar el archivo index.php para que apunte al archivo template creado. 
- Levantar la aplicación en un servidor web y realizar la primera prueba con http://<host>/index.php?t=123456789

#nginx
server {
    listen 80;
    server_name test-hiring.fitcoapp.net;
    error_log /var/log/nginx/test-hiring.log;
    client_body_buffer_size      256k;
    client_max_body_size         2G;
    client_header_buffer_size    4k;
    large_client_header_buffers  8 4k;
    output_buffers               4 32k;
    postpone_output              1460;

    location / {
        root /root/hiring-test;
           #try_files $uri $uri/ /index.php?$query_string;
            index index.php;

            location ~ \.php$ {
                try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include fastcgi_params;
        }

     }

     error_page 500 502 503 504 /50x.html;
     location = /50x.html {
        root /var/static/html;
        internal;
     }

}