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

$id = $_POST['id-user'];
$login = $_POST['login'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$cargo = $_POST['cargo'];
$area = $_POST['area'];
$status = $_POST['status'];
$permissao = $_POST['permissao'];
$armazem = $_POST['armazem'];

$editar_usuario = mysqli_query($conn, "UPDATE web_login SET login='$login',nome='$nome',email='$email',cargo='$cargo',area='$area',status='$status',permissao='$permissao',armazem='$armazem' WHERE id='$id'");

header("Location: ../controle_usuario.php");