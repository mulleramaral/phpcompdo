<?php

class Aluno {

    private $db;
    private $id;
    private $nome;
    private $nota;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }
    
    public function Inserir(){
        $query = "INSERT INTO alunos(nome,nota) values(:nome,:nota)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':nota', $this->nota);
        $stmt->execute();
    }
    
    function Alterar(){
        $query = "update alunos set nome = :nome , nota = :nota WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':nota', $this->nota);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();
    }
    
    function Remover($id){
        $query = "DELETE FROM alunos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
    
    function listar($order){
        $query = "SELECT * FROM alunos " . $order;
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    function Get($id){
        $query = "SELECT * FROM alunos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
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
}
