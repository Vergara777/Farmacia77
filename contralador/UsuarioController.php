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

}
?>
