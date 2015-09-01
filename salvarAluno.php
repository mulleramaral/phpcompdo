<?php

require_once './Conexao.php';
require_once './Aluno.php';
require_once './ServiceDb.php';

if ($_POST) {
    if (!isset($_GET['tipo'])) {
        header("location:listarAluno.php?modo=todos");
    } else {
        if ($_GET['tipo'] == 'editar') {
            $aluno = new Aluno(Conexao::getInstancia());
            $aluno->setId($_POST['id'])
                    ->setNome($_POST['nome'])
                    ->setNota($_POST['nota']);
            $serviceDb = new ServiceDb($aluno);
            $serviceDb->Alterar();
        } else {
            $aluno = new Aluno(Conexao::getInstancia());
            $aluno->setNome($_POST['nome'])
                    ->setNota($_POST['nota']);
            $serviceDb = new ServiceDb($aluno);
            $serviceDb->Inserir($aluno);
        }
        header("location:listarAluno.php?modo=todos");
    }
} else {
    header("location:listaraluno.php?modo=todos");
}