<?php require_once './header.php'; ?>

<?php if (!isset($_GET['modo'])): ?>

    <?php require_once './submenu.php'; ?>

<?php elseif ($_GET['modo'] != 'todos' && $_GET['modo'] != 'top3'): ?>
    <?php require_once './submenu.php'; ?>
<?php else: ?>
    <ul> 
        <table>
            <caption><?= $_GET['modo'] == 'todos' ? "Todos os alunos" : "3 Maiores notas"; ?></caption>
            <thead>
                <tr>
                    <td>C�digo</td>
                    <td>Nome</td>
                    <td>Nota</td>
                </tr>
            </thead>

            <tbody>
                <?php exibeAlunos($_GET['modo']); ?>
            </tbody>
        </table>
    </ul>
<?php
endif;

//Fun��o para retornar os alunos
function exibeAlunos($modo = "todos") {

    try {
        $conexao = new \PDO("mysql:host=localhost;dbname=escola", "root", "");
    } catch (Exception $ex) {
        die("N�o foi poss�vel estabelecer conex�o com o banco de dados"
                . " Erro:" . $ex->getCode());
    }

    $query = $_GET['modo'] == 'todos' ? "SELECT * FROM alunos ORDER BY id" : "SELECT * FROM alunos ORDER BY nota DESC limit 3";

    foreach ($conexao->query($query) as $alunos) {
        echo "<tr><td>{$alunos['id']}</td><td>{$alunos['nome']}</td><td>{$alunos['nota']}</td></tr>";
    }
}
