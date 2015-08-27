<?php

class Conexao {

    public static $instancia;
    
    public static function getInstancia() {
        if(!isset(self::$instancia)){
            try {
                self::$instancia = new \PDO("mysql:host=localhost;dbname=escola", "root", "");
            } catch (\PDOException $ex) {
                die("N�o foi poss�vel estabeler conex�o.Erro:" . $ex->getCode());
            }
        }
        
        return self::$instancia;
    }

}
