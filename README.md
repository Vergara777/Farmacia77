## Proyecto Farmacia — Documentación

### Descripción
Aplicación web para la gestión de una farmacia con autenticación de usuarios, administración de usuarios y módulos de catálogo. Usa un patrón MVC simple en PHP (directorios `modelo/`, `contralador/`, `vista/`) y AdminLTE para UI.

### Tecnologías
- **Backend**: PHP 7.4+ (compatible con PHP 8.x)
- **Base de datos**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript, AdminLTE
- **Servidor local recomendado**: WAMP/XAMPP (Windows)

### Requisitos previos
- PHP 7.4 o superior habilitado
- MySQL/MariaDB en ejecución
- Extensiones PHP comunes habilitadas: `mysqli`
- Servidor web local (WAMP/XAMPP) configurado para servir el directorio `Farmacia/`

### Instalación y configuración rápida
Consulta también `INSTRUCCIONES_INSTALACION.md` para una guía detallada.

1) Clona o copia el proyecto en tu raíz web (por ejemplo, `C:/wamp64/www/Farmacia`).
2) Crea una base de datos (por ejemplo, `farmacia_db`).
3) Importa el esquema inicial:
   - Archivo: `database_structure.sql`
4) Configura la conexión a BD en `modelo/Conexion.php` (host, usuario, clave, nombre de BD).
5) Inicia el servidor y accede a `http://localhost/Farmacia/`.

### Estructura del proyecto

```text
Farmacia/
  contralador/          # Controladores PHP (login, usuarios)
  css/                  # Estilos y AdminLTE
  img/                  # Imágenes de la app y usuarios
  js/                   # Scripts de frontend (login, usuarios)
  modelo/               # Modelos PHP (DB, Usuario)
  vista/                # Vistas PHP (layouts, catálogos, formularios)
  index.php             # Punto de entrada
  database_structure.sql# Esquema de base de datos
  INSTRUCCIONES_INSTALACION.md
  skite                 # Changelog resumido
```

### Módulos principales
- **Autenticación**
  - Controlador: `contralador/LoginControllers.php`
  - Vista: `vista/logout.php`, `contralador/logout.php`
  - Script: `js/login.js`

- **Usuarios**
  - Modelo: `modelo/Usuario.php`
  - Controlador: `contralador/UsuarioController.php`
  - Script: `js/usuario.js`
  - Imágenes de perfil: `img/usuarios/`

- **Catálogo técnico/administrativo**
  - Vistas: `vista/tec_catalogo.php`, `vista/adm_catalogo.php`
  - Layouts: `vista/Layouts/header.php`, `vista/Layouts/nav.php`, `vista/Layouts/footer.php`

### Base de datos
- Importa `database_structure.sql` para crear las tablas iniciales.
- Ajusta credenciales en `modelo/Conexion.php`.
- Si cambias el nombre de la base de datos, asegúrate de actualizarlo en el código.

### Flujo de autenticación (resumen)
1) El usuario envía credenciales desde el formulario de login (UI con AdminLTE).
2) `contralador/LoginControllers.php` valida contra la base de datos usando `modelo/Conexion.php` y `modelo/Usuario.php`.
3) Se inician variables de sesión y se redirige a las vistas correspondientes según el rol.
4) `contralador/logout.php` destruye la sesión y redirige al inicio de sesión.

### Estilos y UI
- Basado en AdminLTE (`css/adminlte.min.css`, `js/adminlte.min.js`).
- Estilos personalizados en `css/styles.css`.

### Scripts de frontend
- `js/login.js`: Manejo de envío del formulario de login, validaciones básicas.
- `js/usuario.js`: Acciones de usuarios (crear, editar, listar, manejo de avatar, etc.).

### Buenas prácticas de desarrollo
- Mantén el patrón MVC: lógica en `contralador/`, acceso a datos en `modelo/`, presentación en `vista/`.
- Sanitiza entradas del usuario y usa sentencias preparadas.
- Evita mezclar HTML y consultas SQL en las vistas.
- Centraliza configuración de BD en `modelo/Conexion.php` (no dupliques credenciales).

### Ejecución en Windows (WAMP)
1) Inicia Apache y MySQL desde WAMP.
2) Coloca el proyecto dentro de `www/`.
3) Importa `database_structure.sql` con phpMyAdmin.
4) Abre `http://localhost/Farmacia/` en tu navegador.

### Solución de problemas comunes
- Pantalla en blanco: habilita `display_errors` y revisa `modelo/Conexion.php`.
- Error de conexión a BD: revisa host/usuario/clave/nombre de BD.
- Archivos estáticos no cargan: valida rutas relativas en layouts y permisos de archivos.

### Seguridad
- No subas `.sql` con datos sensibles.
- Asegura que `img/usuarios/` no permita ejecutar scripts.
- Valida y sanea todos los campos de formularios.

### Documentación relacionada
- Guía de instalación detallada: `INSTRUCCIONES_INSTALACION.md`
- Historial de cambios resumido: `skite`

### Licencia
Si este proyecto requiere una licencia, indica aquí los términos. Por defecto, todos los derechos reservados.


