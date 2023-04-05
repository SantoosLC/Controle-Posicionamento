<?php
session_start();

require_once '../../assets/conexao.php';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: ../../login.php");
    exit();
}

if ($permissao_user == 'Administrador') {
    echo "";
} else {
    header("Location: dashboard.php");
}

$login = $_POST['login'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cargo = $_POST['cargo'];
$area = $_POST['area'];
$status = $_POST['status'];
$permissao = $_POST['permissao'];
$armazem = $_POST['armazem'];

$enviar_usuario = mysqli_query($conn, "INSERT web_login(login,nome,email,senha,cargo,area,status,permissao,armazem) VALUES ('$login','$nome','$email','$senha','$cargo','$area','$status','$permissao','$armazem')");

header("Location: ../controle_usuario.php");