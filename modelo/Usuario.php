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
        $sql = "SELECT * FROM usuario INNER JOIN tipo_us ON us_tipo = id_tipo_us WHERE id_usuario = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchAll();
    }
    function editar($id_usuario, $telefono, $residencia, $sexo, $adicional, $correo, $imagen_perfil = null) {
        try {
            // Construir la consulta dinámicamente dependiendo si hay imagen o no
            if ($imagen_perfil !== null) {
                $sql = "UPDATE usuario SET
                        telefono_us = :telefono,
                        residencia_us = :residencia,
                        sexo_us = :sexo,
                        adicional_us = :adicional,
                        correo_us = :correo,
                        imagen_perfil = :imagen_perfil
                        WHERE id_usuario = :id_usuario";
            } else {
                $sql = "UPDATE usuario SET
                        telefono_us = :telefono,
                        residencia_us = :residencia,
                        sexo_us = :sexo,
                        adicional_us = :adicional,
                        correo_us = :correo
                        WHERE id_usuario = :id_usuario";
            }
            
            $query = $this->acceso->prepare($sql);
            $query->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $query->bindParam(':residencia', $residencia, PDO::PARAM_STR);
            $query->bindParam(':sexo', $sexo, PDO::PARAM_STR);
            $query->bindParam(':adicional', $adicional, PDO::PARAM_STR);
            $query->bindParam(':correo', $correo, PDO::PARAM_STR);
            $query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            
            if ($imagen_perfil !== null) {
                $query->bindParam(':imagen_perfil', $imagen_perfil, PDO::PARAM_STR);
            }
            
            // Ejecutar la consulta y verificar el resultado
            if($query->execute()) {
                if($query->rowCount() > 0) {
                    return true;
                } else {
                    error_log("No se modificaron filas. ID Usuario: $id_usuario");
                    return "No se encontró el usuario o los datos son idénticos";
                }
            } else {
                $error = $query->errorInfo();
                error_log("Error SQL: " . print_r($error, true));
                return "Error en la consulta: " . $error[2];
            }
        } catch(PDOException $e) {
            error_log("PDOException: " . $e->getMessage());
            return "Error de base de datos: " . $e->getMessage();
        }
    }
}
?>