<?php
require_once './header.php';
require_once './Conexao.php';
require_once './Usuario.php';
require_once './ServiceDb.php';

if (!isset($_GET['operacao'])) {
    $operacao = "inserir";
    $titulo = "Inserindo Usuario";
} else {
    $operacao = $_GET['operacao'];
    if ($operacao != 'inserir' && $operacao != 'editar' && $operacao != 'excluir') {
        header("location:usuarios.php");
    } elseif ($operacao == 'editar') {
        $titulo = "Editando Usuario";
        $serviceDb = new ServiceDb(new Usuario());
        $usuario = $serviceDb->Get($_GET['id']);
    } elseif($operacao == 'excluir'){
        $titulo = "Excluindo Usuario";
        $serviceDb = new ServiceDb(new Usuario());
        $serviceDb->Remover($_GET['id']);
        header("location:usuarios.php");
    }
    else {
        $titulo = "Inserindo Usuario";
    }
}
?>

<section>
    <form method="POST" action="salvarUsuario.php?tipo=<?= $operacao; ?>">
        <fieldset>
            <legend><?= $titulo; ?></legend>

            <label>Código: <input type="text" name="id" readonly value="<?= isset($usuario) ? str_pad($usuario['id'], 4, '0', STR_PAD_LEFT) : ""; ?>"></label>
            <br/>

            <label>Usuario: <input type="text" name="usuario" value="<?= isset($usuario) ? $usuario['usuario'] : "" ?>"></label>
            <br/>

            <label>Senha: <input type="password" name="senha" min="0" max="10" value="<?= isset($usuario) ? $usuario['senha'] : "" ?>"></label>
            <br/>
        </fieldset>
        <input type="submit" name="submit" value="Enviar">
    </form>
</section>

<?php
require_once './footer.php';
