<?php
class Conexao extends PDO {
 
    private static $instancia;
    private $conn = "mysql:host=localhost; dbname=mao_de_obra; charset=utf8";
    private $usuario = "root";
    private $senha = "";
    public $handle = null;
 
    function __construct() {
        try {
            if ($this->handle == null) {
                $dbh = parent::__construct($this->conn, $this->usuario, $this->senha);
                $this->handle = $dbh;
                return $this->handle;
            }
        } catch (PDOException $e) {
            echo "a conexão falhou. Erro: " . $e->getMessage();
            return false;
        }
    }
    function __destruct() {
        $this->handle = NULL;
    }
}