<?php
require_once './header.php';
require_once './Usuario.php';
require_once './Aluno.php';
require_once './ServiceDb.php';
$serviceDb = new ServiceDb(new Usuario());
?>

<section>
    <table>
        <caption>Usuarios</caption>
        <thead>
        <th>Código</th>
        <th>Usuario</th>
        <th></th>
        <th></th>
        </thead>
        <tbody>

            <?php foreach ($serviceDb->listar() as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td><td><?= $usuario['usuario']; ?></td>
                    <td><a href="updateUsuario.php?operacao=editar&id=<?= $usuario['id'] ?>">editar</a></td>
                    <?php
                    if (isset($_SESSION['logado'])):
                        ?>
                        <td><a href = "updateUsuario.php?operacao=excluir&id=<?= $usuario['id'] ?>">remover</a></td>
                        <?php
                    endif;
                    ?>

                </tr>
            <?php endforeach;
            ?>
        </tbody>
    </table>
    <a href="updateUsuario.php?operacao=inserir">Inserir</a>
</section>

<?php
require_once './footer.php';

