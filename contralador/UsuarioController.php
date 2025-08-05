<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once '../modelo/Usuario.php';
$usuario = new Usuario();

if($_POST['funcion'] == 'buscar_usuario'){
    $json = array();
    $usuario -> obtener_datos($_POST['datos']);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'nombre' => $objeto->nombre_us,
            'apellidos' => $objeto->apellidos_us,
            'dni' => $objeto->dni_us,
            'tipo' => $objeto->nombre_tipo,
            'edad' => $objeto->edad,
            'residencia' => $objeto->residencia_us,
            'sexo' => $objeto->sexo_us,
            'correo' => $objeto->correo_us,
            'telefono' => $objeto->telefono_us,
            'adicional' => $objeto->adicional_us,
            'imagen_perfil' => $objeto->imagen_perfil ?? '../img/robert.jpg'
        );
    }
    if (isset($json[0])) {
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } else {
        echo json_encode(null);
    }

} else if($_POST['funcion'] == 'capturar_datos') {
    try {
        $id_usuario = $_POST['id_usuario'];
        $usuario->obtener_datos($id_usuario);
        
        if (!empty($usuario->objetos)) {
            $datos = array(
             /*   'nombre' => $usuario->objetos[0]->nombre_us,
                'apellidos' => $usuario->objetos[0]->apellidos_us,
                'dni' => $usuario->objetos[0]->dni_us,
                'edad' => $usuario->objetos[0]->edad,   */
                'residencia' => $usuario->objetos[0]->residencia_us,
                'sexo' => $usuario->objetos[0]->sexo_us,
                'correo' => $usuario->objetos[0]->correo_us,
                'telefono' => $usuario->objetos[0]->telefono_us,
                'adicional' => $usuario->objetos[0]->adicional_us,
                'imagen_perfil' => $usuario->objetos[0]->imagen_perfil ?? '../img/robert.jpg'
            );
            echo json_encode($datos);
        } else {
            echo json_encode(['error' => 'No se encontraron datos del usuario']);
        }
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}else if($_POST['funcion'] == 'editar_usuario') {
    // Debug: Registrar todos los datos recibidos
    error_log("=== DEBUG EDITAR USUARIO ===");
    error_log("POST data: " . print_r($_POST, true));
    error_log("FILES data: " . print_r($_FILES, true));
    
    $id_usuario = $_POST['id_usuario'];
    $telefono = $_POST['telefono'];
    $residencia = $_POST['residencia'];
    $sexo = $_POST['sexo'];
    $adicional = $_POST['adicional'];
    $correo = $_POST['correo'];
    $nueva_imagen = null;
    
    try {
        error_log("Intentando editar usuario: " . $id_usuario);
        
        // Manejar subida de imagen si existe
        if (isset($_FILES['imagen'])) {
            error_log("Archivo recibido - Error: " . $_FILES['imagen']['error']);
            error_log("Archivo recibido - Tamaño: " . $_FILES['imagen']['size']);
            error_log("Archivo recibido - Tipo: " . $_FILES['imagen']['type']);
            error_log("Archivo recibido - Nombre: " . $_FILES['imagen']['name']);
            
            if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $imagen = $_FILES['imagen'];
                
                // Validar tipo de archivo de forma más simple
                $tipos_permitidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                $tipo_archivo = $imagen['type'];
                
                // También validar por extensión como backup
                $extension = strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));
                $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
                
                if (!in_array($tipo_archivo, $tipos_permitidos) && !in_array($extension, $extensiones_permitidas)) {
                    throw new Exception('Tipo de archivo no permitido. Solo se admiten JPG, PNG y GIF.');
                }
                
                // Validar tamaño (2MB máximo)
                if ($imagen['size'] > 2 * 1024 * 1024) {
                    throw new Exception('El archivo es muy grande. Máximo 2MB permitido.');
                }
                
                // Crear directorio de imágenes si no existe
                $directorio_imagenes = '../img/usuarios/';
                if (!file_exists($directorio_imagenes)) {
                    error_log("Creando directorio: " . $directorio_imagenes);
                    if (!mkdir($directorio_imagenes, 0755, true)) {
                        throw new Exception('No se pudo crear el directorio de imágenes.');
                    }
                }
                
                // Generar nombre único para la imagen
                $nombre_archivo = 'usuario_' . $id_usuario . '_' . time() . '.' . $extension;
                $ruta_completa = $directorio_imagenes . $nombre_archivo;
                $nueva_imagen = '../img/usuarios/' . $nombre_archivo;
                
                error_log("Intentando mover archivo a: " . $ruta_completa);
                
                // Mover archivo subido
                if (move_uploaded_file($imagen['tmp_name'], $ruta_completa)) {
                    error_log("Imagen subida exitosamente: " . $nueva_imagen);
                } else {
                    error_log("Error al mover archivo. Verificar permisos de carpeta.");
                    throw new Exception('Error al subir la imagen. Verificar permisos de carpeta.');
                }
            } else if ($_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
                error_log("Error en upload: " . $_FILES['imagen']['error']);
                throw new Exception('Error al subir el archivo. Código: ' . $_FILES['imagen']['error']);
            }
        }
        
        error_log("Llamando a usuario->editar con imagen: " . ($nueva_imagen ?? 'null'));
        $resultado = $usuario->editar($id_usuario, $telefono, $residencia, $sexo, $adicional, $correo, $nueva_imagen);
        error_log("Resultado de editar: " . print_r($resultado, true));
        
        if($resultado === true) {
            $respuesta = [
                'status' => 'success',
                'message' => 'editado',
                'data' => [
                    'id_usuario' => $id_usuario,
                    'telefono' => $telefono,
                    'residencia' => $residencia,
                    'sexo' => $sexo,
                    'correo' => $correo,
                    'adicional' => $adicional
                ]
            ];
            
            // Agregar ruta de nueva imagen si se subió
            if ($nueva_imagen) {
                $respuesta['nueva_imagen'] = $nueva_imagen;
            }
            
            error_log("Enviando respuesta exitosa: " . json_encode($respuesta));
            echo json_encode($respuesta);
        } else {
            error_log("Error al editar usuario: " . print_r($resultado, true));
            echo json_encode([
                'status' => 'error',
                'message' => 'No se pudo editar: ' . $resultado,
                'debug' => $resultado
            ]);
        }
    } catch(Exception $e) {
        error_log("Excepción al editar usuario: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
}
?>
