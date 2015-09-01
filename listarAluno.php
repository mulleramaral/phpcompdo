<?php
require_once './header.php';
require_once './Aluno.php';
require_once './ServiceDb.php';
?>

<form action="listarAluno.php" method="POST">
    <fieldset>
        <legend>Pesquisar</legend>
        <label>Nome: <input type="text" name="nome"></label>
        <input type="submit" name="pesquisar" value="pesquisar">
    </fieldset>
</form>

<br/>

<?php if (isset($_POST['nome'])): ?>
    <h2>Resultado da pesquisa por: <?= $_POST['nome']; ?></h2>
    <table>
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
            <?php exibeAlunos(); ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if (!isset($_GET['modo'])): ?>

    <?php require_once './submenu.php'; ?>

<?php elseif ($_GET['modo'] != 'todos' && $_GET['modo'] != 'top3'): ?>
    <?php require_once './submenu.php'; ?>
<?php else: ?>
    <h2><?= $_GET['modo'] == 'todos' ? "Todos os alunos" : "3 Maiores notas"; ?></h2>
    <table>
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

    if (isset($_POST['nome'])) {
        $filtros = array(
            'filtro' => " nome like ?",
            'valor' => $_POST['nome'] . "%"
        );
        $serviceDb = new ServiceDb(new Aluno());
        foreach ($serviceDb->listarPor($filtros) as $alunos) {
            echo "<tr><td>{$alunos['id']}</td><td>{$alunos['nome']}</td><td>{$alunos['nota']}</td>"
            . "<td><a href='updateAluno.php?operacao=editar&id={$alunos['id']}'>Editar</a></td>"
            . "<td><a href='updateAluno.php?operacao=excluir&id={$alunos['id']}'>Excluir</a></td></tr>";
        }
    } else {
        $order = $_GET['modo'] == 'todos' ? "ORDER BY id" : " ORDER BY nota DESC limit 3";
        $aluno = new Aluno();
        $serviceDb = new ServiceDb($aluno);
        foreach ($serviceDb->listar($order) as $alunos) {
            echo "<tr><td>{$alunos['id']}</td><td>{$alunos['nome']}</td><td>{$alunos['nota']}</td>"
            . "<td><a href='updateAluno.php?operacao=editar&id={$alunos['id']}'>Editar</a></td>"
            . "<td><a href='updateAluno.php?operacao=excluir&id={$alunos['id']}'>Excluir</a></td></tr>";
        }
    }
}
