<?php

class Conexao {

    public static $instancia;
    
    public static function getInstancia() {
        if(!isset(self::$instancia)){
            try {
                self::$instancia = new \PDO("mysql:host=localhost;dbname=escola", "root", "");
            } catch (\PDOException $ex) {
                die("Não foi possível estabeler conexão.Erro:" . $ex->getCode());
            }
        }
        
        return self::$instancia;
    }

}
