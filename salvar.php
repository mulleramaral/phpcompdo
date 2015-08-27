<?php

require_once './Conexao.php';
require_once './Aluno.php';

if ($_POST) {
//    print_r($_POST);
    if (!isset($_GET['tipo'])) {
        header("location:listar.php?modo=todos");
    } else {
        if ($_GET['tipo'] == 'editar') {
            $aluno = new Aluno(Conexao::getInstancia());
            $aluno->setId($_POST['id'])
                    ->setNome($_POST['nome'])
                    ->setNota($_POST['nota']);
            $aluno->Alterar();
        } else {
            $aluno = new Aluno(Conexao::getInstancia());
            $aluno->setNome($_POST['nome'])
                    ->setNota($_POST['nota']);
            $aluno->Inserir();
        }
        header("location:listar.php?modo=todos");
    }
} else {
    header("location:listar.php?modo=todos");
}