<?php
session_start();
if(!isset($_SESSION['logado'])){
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="ISO-8859-1">
        <title></title>
        <style>
            body{
                font-family: sans-serif;
            }
            #logout{
                float: right;
                position: absolute;
                top: 10px;
                right: 15px;
                list-style: none;
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
        <h1>School of Net</h1>
        
        <ul id="logout">
            <li><a href="logout.php">Sair</a></li>
        </ul>
        
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="usuarios.php">Listar usuarios</a></li>
                <?php require_once './submenu.php'; ?>
            </ul>
        </nav>
        
        