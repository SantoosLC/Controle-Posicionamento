<?php
session_start();

require_once '../../assets/conexao.php';
require_once './lib/phpmailer.php';

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

$select_usuario = mysqli_query($conn, "SELECT * FROM web_login WHERE login='$login'");
$row_user = mysqli_fetch_assoc($select_usuario);

$titulo = "Parabéns, seu usuario foi criado.";

$mensagem = '<html><body><div class="container"><h4>Olá, ' . $row_user['nome'] . '</h4><p> Parabéns, seu usuario na plataforma de posicionamentos foi criado. Segue informações: <br> Usuario: '. $row_user['login'] . ' | Senha: '. $row_user['senha'] . ' </div></div></body></html>';

enviar_email($email, $titulo, $mensagem);

header("Location: ../controle_usuario.php");