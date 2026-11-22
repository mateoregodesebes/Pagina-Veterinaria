## Instalación

1. Clonar el repositorio:

```sh
git clone https://github.com/mateoregodesebes/Pagina-Veterinaria
```

> **Nota:** Es recomendable clonar el repositorio en la carpeta que use nuestra aplicación de localhosting para levantar la página. Por ejemplo: en la carpeta /htdocs de XAMPP, en el caso de que estemos usando XAMPP. De manera que podamos modificar el código que usa la aplicación de localhosting más rapido.

2. Ejecutar XAMPP o alguna de las variantes.

3. Iniciar los modulos de Apache y MySQL

4. Instalar las dependencias de PHP desde la raíz del repositorio:

```sh
composer install
```

5. Crear el archivo `includes/.env` con los datos de conexión. No se versiona porque está en `.gitignore`:

```ini
DB_HOST=127.0.0.1
DB_USERNAME=root
DB_PASSWORD=
```

6. Importar la base de datos desde `docs/veterinarias_db.sql` a través del PHPMyAdmin o algun similar.

> **Nota:** El dump está generado con MariaDB 10.4.32 y PHP 8.2.12, usa InnoDB con claves foráneas y crea cinco tablas: `atenciones`, `mascotas`, `personas`, `roles` y `servicios`. Incluye datos de prueba: no importarlo sobre una base que ya contenga información real.
>
> Clientes y personal comparten la tabla `personas`. Un cliente se identifica con `rol_id IS NULL` y un miembro del personal con `rol_id` entre 1 y 4.

7. Si la base viene de una versión anterior del proyecto, verificar que `personas` tenga las columnas `is_verified`, `verification_token_hash`, `verification_expires_at`, `reset_token_hash` y `reset_token_expires_at`. El código actual no funciona con el esquema antiguo de las tablas `clientes` y `personal`.

8. Ingresar a http://localhost/Pagina-Veterinaria/public/index.php
