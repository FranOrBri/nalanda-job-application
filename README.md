# Nalanda Tech Challenge Laravel

Este repositorio contiene el proyecto Backend Technical Challenge de Nalanda realizado con una estructura básica de Docker Compose para
gestionar un proyecto Laravel 10.x Nginx y MySql.

## Instalación
- `make build` para construir los servicios
- `make start` para arrancar los contenedores
- `make ssh-be` para acceder al bash del contenedor php

(comprueba otros objetivos en `Makefile` con `make help`)

## Configuración
- Instalar dependencias
```
composer isntall
```

- Lanzar migraciones de doctrine
```
php artisan do:mi:di
php artisan do:mi:mi -n
```


- Para crear la BD de testing hay que hacer lo siguiente:
Cambiar en el .env `DB_DATABASE=nalanda_job_application_db_test` lanzar los comandos (no he conseguido hacer que las migraciones de doctrine y los tests lean .env.testing)

```
make restart
make testing-db
make ssh-be
php artisan do:mi:mi -n
```

Cuando se haya acabado de probar los tests modificar el .env a su estado  anterior y volver a lanzar `make restart`

## Detalles

Lo primero ha sido crear un nuevo proyecto en git, y hacer uso de un esqueleto para montar proyectos. Con la ayuda de
un makefile se gestiona Docker con los contenedores de PHP 8.1, un servidor web Nginx y un gestor de base de datos MySQL 8.0

Al ser un proyecto API con separación de responsabilidades he decidido afrontarlo con Arquitectura Hexagonal y DDD (Domain-Driven Design).

El proyecto en sí esta bajo el directorio src y dentro de él se encuentran los contextos acotados:
- Recruitment: creación de candidaturas y gestión de candidaturas

Con las carpetas `Application`, `Domain` e `Infrastructure`

En `Domain`
- Entities: con las entidades del dominio `Applicant` y `Recruiter`, mapeadas con Doctrine por atributos PHP 8.
- ValueObjects: con los objetos inmutables para aportar integridad a las entidades.
- Contracts\Repositories: con las interfaces de los repositorios desacoplados de su implementación.

En `Application`
- DTOs: objetos simples que sirven para transportar datos entre las capas.
- UseCases: para la implementación de la lógica de negocio o casos de uso específicos del sistema.

En `Infrastructure`
- Controllers: con las clases encargadas de gestionar las peticiones a la applicación
- Repositories: con las implementaciones concretas de las interfaces de la capa de Dominio para el acceso a BD. En mi caso con Doctrine.
- Routes: donde definimos las rutas por las que se accede a los controladores.
- Validators: componentes para validar las peticiones que llegan a los controladores. En mi caso no he implementado ninguna.

Para el testing he hecho los test unitarios del método que valida las candidaturas. Para el test de integración he
comprobado la respuesta y el acceso a BD del enpoint para crear candidatos.

También he agregado el fichero `Nalanda.postman_collection.json` para importar en Postman con las distintas llamadas a 
los endpoints ya creadas.

## Por último

Me hubiese gustado implemntar CQRS y Eventos de Dominio aunque este ultimo creo que no era inecesario y aumentaba aún más el
tiempo y la complejidad para mí.

Como apunte final simplemente destacar que no soy experto en Laravel si lo soy en Symfony y he intentado aplicar mis conocimientos
para hacer un simil de lo que haría en Symfony. Hay algunas cosas que he ido aprendiendo sobre la marcha y otras que he dejado atrás
por falta de tiempo, aún así ha sido un reto interesante y con el que he aprendido bastante.
