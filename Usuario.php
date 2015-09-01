<?php

require_once './IEntidade.php';

class Usuario implements IEntidade {

    private $id;
    public $usuario;
    public $senha;
    private $table = "usuarios";

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function getId() {
        return $this->id;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
        return $this;
    }

    function getUsuario() {
        return $this->usuario;
    }
    
    function getSenha(){
        return $this->senha;
    }
    
    function setSenha($senha){
        $this->senha = $senha;
        return $this;
    }

    function getTable() {
        return $this->table;
    }

}
