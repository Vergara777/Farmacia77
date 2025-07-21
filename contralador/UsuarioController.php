<?php
include_once '../modelos/usuario.php';
$usuario = new Usuario();
if($_POST['funcion'] == 'buscar_usuario'){
    $usuario -> obtener_datos($_POST['datos']);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'nombre' => $objeto['nombre_us'],
            'apellidos' => $objeto['apellidos_us'],
            'dni' => $objeto['dni_us'],
            'tipo' => $objeto['nombre_tipo'],
            'edad' => $objeto['edad'],
            'residencia' => $objeto['residencia_us'],
            'sexo' => $objeto['sexo_us'],
            'correo' => $objeto['correo_us'],
            'telefono' => $objeto['telefono_us'],
            'adicional' => $objeto['adicional_us']
        );

}
}
?>