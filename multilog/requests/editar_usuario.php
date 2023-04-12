<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
	echo "";
  } else {
	header("Location: ../../login.php");
	exit();
  }
require_once '../../assets/conexao.php';

date_default_timezone_set('America/Sao_Paulo');

// SQL
$id = $_SESSION['id'];

$nome = $_POST['nome'];
$senha = $_POST['senha'];
$foto = $_POST['foto'];

$_SESSION['nome'] = $nome;
$_SESSION['senha'] = $senha;
$_SESSION['foto'] = $foto;

$editar_user = mysqli_query($conn, "UPDATE web_login SET nome='$nome', senha='$senha', foto='$foto' WHERE id = $id"); 


header("Location: ../meu_perfil.php");