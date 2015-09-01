<?php

require_once './IEntidade.php';
require_once './ServiceDb.php';

class Aluno implements IEntidade{

    private $db;
    private $id;
    public $nome;
    public $nota;
    private $table = "alunos";
    
    function setId($id){
        $this->id = $id;
        return $this;
    }
    
    function getId(){
        return $this->id;
    }
    
    function setNome($nome){
        $this->nome = $nome;
        return $this;
    }
    
    function getNome(){
        return $this->nome;
    }
    
    function setNota($nota){
        $this->nota = $nota;
        return $this;
    }
       
    function getNota(){
        return $this->nota;
    }

    public function getTable() {
        return $this->table;
    }

}
