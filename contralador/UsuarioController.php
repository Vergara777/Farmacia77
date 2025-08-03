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
            'adicional' => $objeto->adicional_us
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
                'adicional' => $usuario->objetos[0]->adicional_us
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
    $id_usuario = $_POST['id_usuario'];
    $telefono = $_POST['telefono'];
    $residencia = $_POST['residencia'];
    $sexo = $_POST['sexo'];
    $adicional = $_POST['adicional'];
    $correo = $_POST['correo'];
    
    try {
        // Agregar logging para debug
        error_log("Intentando editar usuario: " . $id_usuario);
        
        $resultado = $usuario->editar($id_usuario, $telefono, $residencia, $sexo, $adicional, $correo);
        
        if($resultado === true) {
            echo json_encode([
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
            ]);
        } else {
            error_log("Error al editar usuario: " . print_r($resultado, true));
            echo json_encode([
                'status' => 'error',
                'message' => 'No se pudo editar',
                'debug' => $resultado
            ]);
        }
    } catch(Exception $e) {
        error_log("Excepción al editar usuario: " . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
}
?>
