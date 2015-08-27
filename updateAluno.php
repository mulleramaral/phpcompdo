<?php
require_once './header.php';
require_once './Conexao.php';
require_once './Aluno.php';

if (!isset($_GET['operacao'])) {
    $operacao = "inserir";
    $titulo = "Inserindo Aluno";
} else {
    $operacao = $_GET['operacao'];
    if ($operacao != 'inserir' && $operacao != 'editar') {
        header("location:index.php");
    } elseif ($operacao == 'editar') {
        $titulo = "Editando Aluno";
        $aluno = (new Aluno(Conexao::getInstancia()))->Get($_GET['id']);
    }
    else{
        $titulo = "Inserindo Aluno";
    }
}
?>


<section>
    <form method="POST" action="salvar.php?tipo=<?= $operacao; ?>">
        <fieldset>
            <legend><?= $titulo; ?></legend>

            <label>Código: <input type="text" name="id" readonly value="<?= isset($aluno) ? str_pad($aluno['id'], 4, '0', STR_PAD_LEFT) : ""; ?>"></label>
            <br/>

            <label>Nome: <input type="text" name="nome" value="<?= isset($aluno) ? $aluno['nome'] : "" ?>"></label>
            <br/>

            <label>Nota: <input type="number" name="nota" min="0" max="10" value="<?= isset($aluno) ? $aluno['nota'] : "" ?>"></label>
            <br/>
        </fieldset>
        <input type="submit" name="submit" value="Enviar">
    </form>
</section>

<?php
require_once './footer.php';
