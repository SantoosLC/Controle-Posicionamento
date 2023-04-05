<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
	echo "";
  } else {
	header("Location: ../../login.php");
	exit();
  }

date_default_timezone_set('America/Sao_Paulo');

if ($area_user == 'Patio' or $permissao_user == 'Administrador') {
    echo "";
} else {
    header("Location: dashboard.php");
}

require_once '../../assets/conexao.php'; 

if(isset($_GET['id'])){
	$id = $_GET['id'];
    $data_solicitado = date("Y-m-d H:i:s");
    $nome = $_SESSION['nome'];

	$confirmar_posicionamento = mysqli_query($conn, "UPDATE posicionamentos SET data_realizado='$data_solicitado', realizado_por='$nome', status='Realizado' WHERE id = $id"); 
	
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "Posicionamento confirmado, já notificamos o armazem responsavel";
		header("Location: ../posicionamento_patio.php");
	}else{
		$_SESSION['msg'] = "Erro ao confirmar o posicionamento";
		header("Location: ../posicionamento_patio.php");
	}
} else if(isset($_GET['priorizar'])) {
    $id = $_GET['priorizar'];

	$confirmar_posicionamento = mysqli_query($conn, "UPDATE posicionamentos SET prioridade_gestor='Sim', status='Pendente - Prioridade Gestor' WHERE id = $id"); 
	
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "Posicionamento priorizado, já notificamos o patio";
		header("Location: ../posicionamento_patio.php");
	}else{
		$_SESSION['msg'] = "Erro ao confirmar o posicionamento";
		header("Location: ../posicionamento_patio.php");
	}
}