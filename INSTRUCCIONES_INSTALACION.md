# 🔧 Instrucciones de Instalación - Sistema de Farmacia

## ✅ Paso 1: Configurar la Base de Datos

### 1.1 Crear la Base de Datos
```sql
-- Ejecuta esto en tu MySQL/phpMyAdmin
CREATE DATABASE IF NOT EXISTS `farmaciasistema` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `farmaciasistema`;
```

### 1.2 Ejecutar el Script de Tablas
1. Abre **phpMyAdmin** o tu cliente MySQL
2. Selecciona la base de datos `farmaciasistema`
3. Ve a la pestaña **SQL**
4. Copia y pega todo el contenido del archivo `database_structure.sql`
5. Haz clic en **Ejecutar**

### 1.3 Verificar las Tablas Creadas
Deberías ver estas tablas creadas:
- `tipo_us` (tipos de usuario)
- `usuario` (información de usuarios)

### 1.4 Campo Imagen de Perfil
Si tu tabla `usuario` ya existía antes, ejecuta este comando para agregar el campo de imagen:
```sql
ALTER TABLE usuario ADD COLUMN imagen_perfil VARCHAR(255) DEFAULT NULL;
```

---

## ✅ Paso 2: Verificar la Conexión

### 2.1 Credenciales de Base de Datos
En el archivo `modelo/Conexion.php`, verifica que las credenciales sean correctas:
```php
private $host = "localhost";
private $user = "FILANTROPO";          // ← Tu usuario MySQL
private $pass = "qwertyuiop777";       // ← Tu contraseña MySQL
private $port = 3306;
private $db = "farmaciasistema";       // ← Nombre de la BD
```

### 2.2 Usuarios de Prueba Creados
El script crea estos usuarios automáticamente:

| Usuario | Contraseña | DNI | Tipo |
|---------|------------|-----|------|
| admin | admin123 | admin | Administrador |
| Luis Vergara | password123 | 12345678 | Técnico |
| Maria González | password123 | 87654321 | Técnico |

---

## ✅ Paso 3: Configurar Permisos de Archivos

### 3.1 Crear Directorio de Imágenes
```bash
mkdir img/usuarios
chmod 755 img/usuarios
```

### 3.2 En Windows (XAMPP)
- Clic derecho en la carpeta `img/usuarios`
- Propiedades → Seguridad
- Dar permisos de escritura al usuario `IUSR` o `Everyone`

---

## ✅ Paso 4: Probar el Sistema

### 4.1 Iniciar Sesión
1. Ve a `index.php`
2. Usa las credenciales:
   - **DNI:** `admin`
   - **Contraseña:** `admin123`

### 4.2 Probar Funcionalidades
1. Una vez logueado, ve a **Datos Personales**
2. Haz clic en el botón **Editar** o en el botón de cámara 📷
3. Modifica tus datos y/o sube una imagen
4. Haz clic en **Guardar**
5. Recarga la página para verificar que los cambios persisten

---

## 🔧 Solución de Problemas

### Error de Conexión a BD
Si ves "Error de servidor":
1. Verifica que MySQL esté ejecutándose
2. Confirma las credenciales en `Conexion.php`
3. Asegúrate de que la base de datos `farmaciasistema` existe

### Error de Permisos de Archivos
Si las imágenes no se suben:
1. Verifica que la carpeta `img/usuarios/` existe
2. Dale permisos de escritura: `chmod 755 img/usuarios/`

### Campos Vacíos en Modal
Si el modal se abre vacío:
1. Verifica que el usuario esté logueado correctamente
2. Confirma que `$_SESSION['usuario']` tiene el ID correcto

### Imagen no Persiste
Si la imagen vuelve a `robert.jpg` al recargar:
1. Verifica que el campo `imagen_perfil` existe en la tabla `usuario`
2. Ejecuta: `ALTER TABLE usuario ADD COLUMN imagen_perfil VARCHAR(255) DEFAULT NULL;`

---

## 📁 Estructura de Archivos del Sistema

```
Farmacia/
├── css/
│   └── styles.css (estilos personalizados)
├── img/
│   ├── robert.jpg (imagen por defecto)
│   └── usuarios/ (imágenes de perfil subidas)
├── js/
│   └── usuario.js (funcionalidad de usuario)
├── modelo/
│   ├── Conexion.php (conexión a BD)
│   └── Usuario.php (modelo de usuario)
├── contralador/
│   └── UsuarioController.php (controlador de usuario)
├── vista/
│   ├── editar_datos_personales.php (página principal)
│   └── Layouts/ (plantillas comunes)
├── database_structure.sql (estructura de BD)
└── INSTRUCCIONES_INSTALACION.md (este archivo)
```

---

## 🎯 Funcionalidades Implementadas

✅ **Sistema de Login** con tipos de usuario  
✅ **Edición de datos personales** (teléfono, correo, residencia, etc.)  
✅ **Subida de imagen de perfil** con validaciones  
✅ **Preview en tiempo real** de la imagen seleccionada  
✅ **Validaciones de seguridad** (tipo y tamaño de archivo)  
✅ **Persistencia de datos** (los cambios se mantienen al recargar)  
✅ **Interfaz responsiva** con Bootstrap y AdminLTE  
✅ **Notificaciones** con SweetAlert2  

---

## 🔐 Configuración de Seguridad

### Validaciones de Imagen:
- **Tipos permitidos:** JPG, PNG, GIF
- **Tamaño máximo:** 2MB
- **Validación doble:** Cliente (JavaScript) y Servidor (PHP)
- **Nombres únicos:** `usuario_ID_timestamp.extension`

### Seguridad de Base de Datos:
- **Prepared Statements** para prevenir SQL Injection
- **Validación de tipos** de datos
- **Escape de caracteres** HTML

---

## 📞 Soporte

Si tienes problemas:
1. Verifica que todas las tablas se crearon correctamente
2. Confirma que puedes hacer login con `admin/admin123`
3. Revisa los logs de error de PHP/Apache
4. Asegúrate de que el servidor web tenga permisos de escritura

## 🚀 Próximos Pasos

Para expandir el sistema puedes:
- Agregar más campos al perfil de usuario
- Implementar roles y permisos más granulares
- Agregar auditoría de cambios
- Implementar autenticación de dos factores
- Agregar gestión de medicamentos y inventario