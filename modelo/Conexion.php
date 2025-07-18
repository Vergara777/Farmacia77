<?php
class Conexion{
    private $host = "localhost";
    private $user = "FILANTROPO";
    private $pass = "qwertyuiop777";
    private $port = 3306;
    private $db = "farmaciasistema";
    private $charset = "utf8";
    public $pdo = null;
    private $atributes = [
        PDO::ATTR_CASE => PDO::CASE_LOWER,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];
    Function __construct(){
        $this ->pdo = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db};charset={$this->charset}", $this->user, $this->pass, $this->atributes);
}
        }
?>