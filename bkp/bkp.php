<?php

try {
    $conexao = new \PDO("mysql:host=localhost;dbname=pdo", "root", "");
    
//    $query = "show tables";
//    Usado para inserções ou update
//    $resultado = $conexao->exec($query);
    
    $query = "select * from clientes where id=:id";
    
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(":id","1");
    $stmt->execute();
    
    print_r($stmt->fetchAll());
    
} catch (\PDOException $ex) {
    echo "Não foi possível estabeler a conexão com o banco de dados.Erro:" . $ex->getCode();
}
