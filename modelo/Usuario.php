<?php
include_once "Conexion.php";

class Usuario{
    private $acceso;
    var $objetos;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function Loguearse($dni, $pass){
        $sql = "SELECT * FROM usuario INNER JOIN tipo_us ON us_tipo = id_tipo_us WHERE dni_us = :dni AND contraseña_us = :pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dni' => $dni, ':pass' => $pass));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function obtener_datos($id){
        $sql = "SELECT * FROM usuario INNER JOIN tipo_us ON us_tipo = id_tipo_us and id_usuario = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchAll();
        // Devolver los datos en formato JSON para el controlador
        echo json_encode($this->objetos);
    }
}
?>