<?php

require_once './Conexao.php';
require_once './Usuario.php';
require_once './ServiceDb.php';

if (isset($_POST)) {
    print_r($_POST);
    echo "<br/>";
    print_r($_GET);

    if (!isset($_GET['tipo'])) {
        header("location:usuarios.php");
        echo "tipo não foi definido";
    } else {
        $serviceDb = new ServiceDb(new Usuario());
        if ($_GET['tipo'] == 'editar') {
            $usuario = new Usuario();
            $usuario->setId($_POST['id'])
                    ->setUsuario($_POST['usuario'])
                    ->setSenha($_POST['senha']);
            $serviceDb = new ServiceDb($usuario);
            $serviceDb->Alterar();
        } else {
            $usuario = new Usuario();
            $usuario->setUsuario($_POST['usuario'])
                    ->setSenha($_POST['senha']);
            $serviceDb = new ServiceDb($usuario);
            $serviceDb->Inserir($aluno);
        }
        header("location:usuarios.php");
    }
} else {
    header("location:usuarios.php");
}