-- Base de datos para el sistema de farmacia
-- Ejecuta este script en tu base de datos 'farmaciasistema'

-- Crear tabla tipo_us (tipos de usuario)
CREATE TABLE IF NOT EXISTS `tipo_us` (
  `id_tipo_us` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(50) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_tipo_us`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertar tipos de usuario básicos
+
-*INSERT INTO `tipo_us` (`id_tipo_us`, `nombre_tipo`, `descripcion`) VALUES
(1, 'Administrador', 'Usuario con permisos completos del sistema'),
(2, 'Técnico', 'Usuario técnico con permisos limitados'),
(3, 'Usuario', 'Usuario básico del sistema');

-- Crear tabla usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_us` varchar(100) NOT NULL,
  `apellidos_us` varchar(100) NOT NULL,
  `dni_us` varchar(20) NOT NULL UNIQUE,
  `edad` int(3) DEFAULT NULL,
  `telefono_us` varchar(20) DEFAULT NULL,
  `residencia_us` text DEFAULT NULL,
  `sexo_us` enum('Masculino','Femenino','Otro') DEFAULT 'Masculino',
  `correo_us` varchar(100) DEFAULT NULL,
  `adicional_us` text DEFAULT NULL,
  `contraseña_us` varchar(255) NOT NULL,
  `us_tipo` int(11) NOT NULL DEFAULT 3,
  `imagen_perfil` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuario_tipo` (`us_tipo`),
  CONSTRAINT `fk_usuario_tipo` FOREIGN KEY (`us_tipo`) REFERENCES `tipo_us` (`id_tipo_us`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Si tu tabla usuario ya existe sin el campo imagen_perfil, ejecuta este comando:
-- ALTER TABLE usuario ADD COLUMN imagen_perfil VARCHAR(255) DEFAULT NULL;

-- Insertar usuario administrador de ejemplo
-- Usuario: admin, Contraseña: admin123
INSERT INTO `usuario` (`nombre_us`, `apellidos_us`, `dni_us`, `edad`, `telefono_us`, `residencia_us`, `sexo_us`, `correo_us`, `adicional_us`, `contraseña_us`, `us_tipo`) VALUES
('Administrador', 'Sistema', 'admin', 30, '+57 123456789', 'Calle Principal 123', 'Masculino', 'admin@farmacia.com', 'Usuario administrador del sistema', 'admin123', 1);

-- También puedes crear usuarios de ejemplo para pruebas
INSERT INTO `usuario` (`nombre_us`, `apellidos_us`, `dni_us`, `edad`, `telefono_us`, `residencia_us`, `sexo_us`, `correo_us`, `adicional_us`, `contraseña_us`, `us_tipo`) VALUES
('Luis', 'Vergara', '12345678', 25, '+57 987654321', 'Carrera 15 #45-67', 'Masculino', 'luis@email.com', 'Estudiante del SENA', 'password123', 2),
('Maria', 'González', '87654321', 28, '+57 555123456', 'Avenida 20 #12-34', 'Femenino', 'maria@email.com', 'Técnica en farmacia', 'password123', 2);