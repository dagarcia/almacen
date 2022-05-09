# Práctica de almacén

## Descripción

Práctica de almacén back y front

## Requerimientos

Debe tener instalado 
[git](https://git-scm.com/), [docker](https://docs.docker.com/engine/install/), [docker-compose](https://docs.docker.com/compose/install/) y [composer](https://getcomposer.org/download/)

## Componentes

1. PHP 7.4 (como modulo de Apache) [imagen base](https://hub.docker.com/_/php)
2. MySQL 8.0 [imagen base](https://hub.docker.com/_/mysql)

## Framework PHP

* Symfony 5.4

## Biblioteca JavaScript

* React 18

## Instalación (construir e iniciar los contenedores por primera vez)

Luego de clonarse o descargarse el código del proyecto desde el repo, ejecutar:

### Iniciar contenedores docker
Dentro del directorio raiz del proyecto (donde se encuentra el archivo docker-compose.yml)

```bash
docker-compose up
```

Este proceso tarda algunos minutos

### Dependencias Symfony
Dentro del directorio html

```bash
composer install
```
También se puede ejecutar el comando desde dentro del container apache, que ya cuenta con composer.

## Base de datos

El script de base de datos se encuentra en la carpeta 'database'. Este script se ejecutará automaticamente al iniciar los contenedores.

## API

Las rutas de API son:

http://localhost:8088/public/productos/ -> Método GET: obtiene todos los productos
http://localhost:8088/public/productos/{id} -> Método GET: obtiene el producto con el id especificado
http://localhost:8088/public/productos/ -> Método POST: registra un producto con los datos del body

### Formato de body para crear productos:

Televisor:
{
  "categoria": "Televisor",
  "nombre": "String",
  "sku": "String",
  "marca": "String",
  "costo": "String" o Float,
  "tipo_pantalla": "LCD"|"LED"|"OLED",
  "tamanio_pantalla": "50"
}

Zapatos:
{
  "categoria": "Zapatos",
  "nombre": "String",
  "sku": "String",
  "marca": "String",
  "costo": "String" o Float,
  "material": "Piel"|"Plástico",
  "talle": "40"
}

Laptop:
{
  "categoria": "Laptop",
  "nombre": "String",
  "sku": "String",
  "marca": "String",
  "costo": "String" o Float,
  "procesador": "Intel"|"AMD",
  "memoria_ram": "16GB"
}

## Front

Para probar el front se debe ingresar la url "http://localhost:8088/public/almacen/index.html" en el navegador.
Esto mostrará una pantalla con un menú y un mensaje de "404 not found", hacer click en "Almacén" del menú para que tome correctamente la url del front.
El código fuente del front (react) se encuentra en la carpeta "front"

