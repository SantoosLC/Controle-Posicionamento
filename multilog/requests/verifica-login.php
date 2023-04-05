<?php
session_start();
require_once '../../assets/conexao.php';

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$primeiro_login = mysqli_query($conn,"SELECT * FROM web_login WHERE login = '$usuario' AND senha = '$senha' AND status = 'aprovado' AND primeiro_login = 0");

$status = mysqli_query($conn,"SELECT * FROM web_login WHERE login = '$usuario'");
$status_row = mysqli_fetch_array($status);

$sql_login = mysqli_query($conn,"SELECT * FROM web_login WHERE login = '$usuario' AND senha = '$senha' AND status = 'aprovado' AND primeiro_login = 1");
$dados = mysqli_fetch_array($sql_login);

if(mysqli_num_rows($primeiro_login) == 1) {
  $_SESSION['primeiro_login'] = $usuario;
  header("Location: ../../primeiro_login.php");
  exit();
} else if (mysqli_num_rows($sql_login) == 1) {

  $_SESSION['usuario'] = $usuario;
  $_SESSION['senha'] = $senha;
  $_SESSION['id'] = $dados['id'];
  $_SESSION['nome'] = $dados['nome'];
  $_SESSION['cargo'] = $dados['cargo'];
  $_SESSION['foto'] = $dados['foto'];
  $_SESSION['email'] = $dados['email'];
  $_SESSION['armazem'] = $dados['armazem'];
  $_SESSION['usuario_logado'] = true;

  $_SESSION['login_success'] = "Entrando, aguarde...";
  header('Location: ../../login.php');
  exit();

} else if($status_row['status'] == "Pendente") {
  $_SESSION['login_error'] = "Usuario não aprovado, entre em contato com algum administrador";
  header('Location: ../../login.php');
  exit();
}else {
    $_SESSION['login_error'] = "Email ou Senha inválidos.";
    header('Location: ../../login.php');
    exit();
}

mysqli_close($conn);
?>