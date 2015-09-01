<?php
session_start();

if(isset($_SESSION['logado'])){
    unset($_SESSION['logado']);
    setcookie('senha','');
    session_destroy();
}

header("location:login.php");
