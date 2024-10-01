# Prueba Técnica - José Joaquín Ariza

![Logotipo de Soluciones Informáticas MJ](https://solucionesinformaticasmj.com/wp-content/uploads/2024/04/logo-simj-24.svg)

Este proyecto es una prueba técnica realizada para Soluciones Informáticas MJ. La aplicación está construida con el framework Laravel y tiene como objetivo gestionar proyectos y tareas para usuarios registrados.

## Descripción

La aplicación permite gestionar proyectos y asignar tareas a través de un calendario visual. Está pensada para facilitar el registro y seguimiento de tareas, ofreciendo funcionalidades adicionales para administradores. Incluye características como la autenticación de usuarios, un CRUD de usuarios con permisos específicos, y la generación de informes en formato PDF.

## Características

- **Autenticación de Usuarios**: Registro e inicio de sesión utilizando el sistema por defecto de Laravel.
- **Gestión de Usuarios (CRUD)**: Creación, edición y eliminación de usuarios, con asignación de roles (Usuario y Administrador). Funcionalidades basadas en AJAX.
- **Gestión de Proyectos**: Solo los administradores pueden añadir nuevos proyectos, que luego se listan ordenados por la última fecha de uso.
- **Calendario de Tareas**: Calendario interactivo donde los usuarios pueden arrastrar y soltar proyectos para agregar tareas. Las tareas se guardan y cargan mediante AJAX.
- **Generación de Informes PDF**: Informes de tareas agrupadas por proyecto, con filtros para proyecto, fecha y usuario. Incluye el tiempo de cada tarea y el tiempo total asignado al proyecto.

## Tecnologías Utilizadas

- **Backend**: Laravel 11, PHP 8+
- **Base de Datos**: MySQL/MariaDB
- **Frontend**: Bootstrap 4, AdminLTE 3, Blade Templates
- **Interacción**: jQuery, AJAX
- **Otros**: Moment.js para el manejo de fechas y horas

## Instalación

Para instalar y ejecutar el proyecto en tu máquina local, sigue los siguientes pasos:

**1.** Clona el repositorio desde GitHub:
```
> git clone https://github.com/josxdev/simj_project_josejariza
> cd simj_project_josejariza
```

**2.** Instala las dependencias de Composer:
```
> composer install
```

**3.** Usa el archivo `.env` y configura tus credenciales de base de datos:


**4.** Genera la clave de la aplicación:
```
> php artisan key
```

**5.** Ejecuta las migraciones para crear las tablas en la base de datos:
```
> php artisan migrate
```

**6.** Inicia el servidor local:
```
> php artisan serve
```

## Uso

- **Inicio de Sesión**: Los usuarios pueden registrarse y acceder mediante el formulario de autenticación.
- **Gestión de Usuarios**: Los administradores tienen acceso a la gestión de usuarios, donde pueden agregar, editar o eliminar usuarios.
- **Añadir Proyectos**: Los administradores pueden añadir nuevos proyectos utilizando una ventana modal.
- **Calendario de Tareas**: Los usuarios pueden arrastrar proyectos al calendario para registrar tareas y ver el progreso.
- **Generar Informe PDF**: Los informes se pueden generar según los filtros seleccionados.

## Contacto

Para reportar problemas o solicitar nuevas funcionalidades, puedes contactarme a través de mi perfil de GitHub o mi email.
