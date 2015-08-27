<?php

try {
    $conexao = new \PDO("mysql:host=localhost;dbname=pdo", "root", "");
    
//    $query = "show tables";
//    Usado para inser��es ou update
//    $resultado = $conexao->exec($query);
    
    $query = "select * from clientes where id=:id";
    
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(":id","1");
    $stmt->execute();
    
    print_r($stmt->fetchAll());
    
} catch (\PDOException $ex) {
    echo "N�o foi poss�vel estabeler a conex�o com o banco de dados.Erro:" . $ex->getCode();
}
