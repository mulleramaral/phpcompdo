<?php
require_once './header.php';
require_once './Aluno.php';
?>

<?php if (!isset($_GET['modo'])): ?>

    <?php require_once './submenu.php'; ?>

<?php elseif ($_GET['modo'] != 'todos' && $_GET['modo'] != 'top3'): ?>
    <?php require_once './submenu.php'; ?>
<?php else: ?>
    <table>
        <caption><?= $_GET['modo'] == 'todos' ? "Todos os alunos" : "3 Maiores notas"; ?></caption>
        <thead>
            <tr>
                <td>Código</td>
                <td>Nome</td>
                <td>Nota</td>
                <td></td>
                <td></td>
            </tr>
        </thead>

        <tbody>
            <?php exibeAlunos($_GET['modo']); ?>
        </tbody>
    </table>
<?php
endif;
?>
<a href="updateAluno.php?operacao=inserir">Inserir</a>

<?php

//Função para retornar os alunos
function exibeAlunos($modo = "todos") {

    try {
        $conexao = new \PDO("mysql:host=localhost;dbname=escola", "root", "");
    } catch (Exception $ex) {
        die("Não foi possível estabelecer conexão com o banco de dados"
                . " Erro:" . $ex->getCode());
    }

    $order = $_GET['modo'] == 'todos' ? "ORDER BY id" : " ORDER BY nota DESC limit 3";

    foreach ((new Aluno($conexao))->listar($order) as $alunos) {
        echo "<tr><td>{$alunos['id']}</td><td>{$alunos['nome']}</td><td>{$alunos['nota']}</td><td><a href='updateAluno.php?operacao=editar&id={$alunos['id']}'>Editar</a></td></tr>";
    }
}
