<?php
session_start();

require_once './Usuario.php';
require_once './ServiceDb.php';
?>

<!DOCTYPE html>
<html>
    <head><title>Cadastro de Alunos</title></head>
    <style>
        *{
            box-sizing: border-box;
        }
        legend{
            width: 100%;
            text-align: center;
        }
        fieldset{
            width: 100%;
            height: 100%;
        }
        form{
            height: 200px;
            width: 150px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin: -75px 0 0 -100px;
        }
    </style>
    <body>
        <?php
        if (isset($_SESSION['logado'])):
            header("location:index.php");
        elseif (isset($_POST['submit'])):
            $serviceDb = new ServiceDb(new Usuario());
            if ($serviceDb->validaUsuario($_POST['usuario'], $_POST['senha']) == true) {
                $_SESSION['logado'] = true;
                header("location:index.php");
            } else {
                setcookie('senha', true);
                header("location:login.php");
            }
        else: {
                ?>
                <form method="post" action="login.php">
                    <legend>Faça o login abaixo</legend>
                    <fieldset>

                        <label>Usuario: <input type="text" name="usuario"></label>
                        <label>Senha: <input type="password" name="senha"></label>
                        <p>
                            <input type="submit" name="submit" value="login">
                            <a href="index.php">Cancelar</a>
                        </p>
                        <?php
                        if (isset($_COOKIE['senha'])) {
                            echo "usuario ou senha inválida";
                            setcookie('senha', '');
                        }
                        ?>
                    </fieldset>
                </form>
                <?php
            }
        endif;
        ?>
    </body>
</html>