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

if ($area_user == 'Armazem' or $permissao_user == 'Administrador') {
  echo "";
} else {
  header("Location: dashboard.php");
}

// SQL

$usuario_email = $_SESSION['email'];

$container = $_POST['container'];
$doca = $_POST['doca'];
$prioridade = $_POST['prioridade'];

$data_solicitado = date("Y-m-d H:i:s");

foreach ($container as $containers) {
    $containers = strtoupper($containers);
    $solicitar_posicionamento =  mysqli_query($conn, "INSERT posicionamentos(containers, armazem, doca, prioridade, data_solicitado, data_realizado, solicitado_por) VALUES ('$containers','$armazem_responsavel','$doca','$prioridade', '$data_solicitado',null,'$usuario_email')");
}

header("Location: ../posicionamento_armazem.php");