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

    $consulta_posicionamento = mysqli_query($conn, "SELECT containers FROM posicionamentos WHERE containers = '$containers' ");

    if(mysqli_num_rows($consulta_posicionamento) == 1) {
      $_SESSION['msg'] = "Esse container já está cadastrado para posicionamento, ou ja foi posicionado";
    } else {
      $solicitar_posicionamento =  mysqli_query($conn, "INSERT posicionamentos(containers, armazem, doca, prioridade, data_solicitado, data_realizado, solicitado_por) VALUES ('$containers','$armazem_responsavel','$doca','$prioridade', '$data_solicitado',null,'$usuario_email')");
      $_SESSION['msg'] = "Solicitação realizada com sucesso.";
    }
}

header("Location: ../posicionamento_armazem.php");