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

date_default_timezone_set('America/Sao_Paulo');

if ($area_user == 'Patio' or $permissao_user == 'Administrador') {
    echo "";
} else {
    header("Location: dashboard.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$ids = json_decode(file_get_contents("php://input"), true);

	foreach ($ids as $id) {
		$nome = $_SESSION['nome'];
	
		$priorizar_posicionamento = mysqli_query($conn, "UPDATE posicionamentos SET prioridade_gestor='Sim', priorizado_por='$nome', status='Pendente - Prioridade Gestor' WHERE id = $id"); 
	}
	// Envia a notificação
	$_SESSION['msg'] = "Posicionamentos priorizados com sucesso!";

	header('Content-Type: application/json');
 	echo json_encode(['message' => 'Posicionamentos confirmados com sucesso!']);
}