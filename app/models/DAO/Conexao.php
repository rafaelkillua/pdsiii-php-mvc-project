<?php

class Conexao {
    
    private static $configConexao;
    private $conexao;
    
    private function __construct($hostBanco, $nomeBanco, $usuario, $senha) {
        try {
            $this->conexao = 
                    new PDO("mysql:host=$hostBanco;dbname=$nomeBanco;charset=utf8", 
                            $usuario, $senha);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public static function getInstancia($hostBanco, $nomeBanco, $usuario, $senha) {
        if (!isset(self::$configConexao)) {
            self::$configConexao = new Conexao($hostBanco, $nomeBanco, $usuario, $senha);
        }
        return self::$configConexao;
    }
    
    public function getConexao() {
        return $this->conexao;
    }
}
