<?php
session_start();

require_once './lib/phpmailer.php';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
	echo "";
  } else {
	header("Location: ../../login.php");
	exit();
  }

date_default_timezone_set('America/Sao_Paulo');

// if ($area_user == 'Patio' or $permissao_user == 'Administrador') {
//     echo "";
// } else {
//     header("Location: dashboard.php");
// }

require_once '../../assets/conexao.php'; 

if(isset($_GET['id'])){
	$id = $_GET['id'];
    $data_solicitado = date("Y-m-d H:i:s");
    $nome = $_SESSION['nome'];

	$confirmar_posicionamento = mysqli_query($conn, "UPDATE posicionamentos SET data_realizado='$data_solicitado', realizado_por='$nome', status='Realizado' WHERE id = $id"); 
	
	$email_posc = mysqli_query($conn, "SELECT * FROM posicionamentos WHERE id = $id");
	$row_posc = mysqli_fetch_assoc($email_posc);
	
	$email = $row_posc['solicitado_por'];
	$titulo = "Seu container foi posicionado.";
	$mensagem = '<html><body><div class="container"><h4>Olá, ' . $row_posc['armazem'] . '</h4><p>Viemos notificar que seu container foi posicionado na doca ' . $row_posc['doca'] . ' com sucesso.</p><div class="alert alert-success" role="alert">Container: ' . $row_posc['containers'] . '</div></div></body></html>';

	enviar_email($email, $titulo, $mensagem);

	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "Posicionamento confirmado, já notificamos o armazem responsavel";
		header("Location: ../posicionamento_patio.php");
	}else{
		$_SESSION['msg'] = "Erro ao confirmar o posicionamento";
		header("Location: ../posicionamento_patio.php");
	}
} else if(isset($_GET['priorizar'])) {
    $id = $_GET['priorizar'];
	$nome = $_SESSION['nome'];

	$confirmar_posicionamento = mysqli_query($conn, "UPDATE posicionamentos SET prioridade_gestor='Sim', priorizado_por='$nome', status='Pendente - Prioridade Gestor' WHERE id = $id"); 
	
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "Posicionamento priorizado, já notificamos o patio";
		header("Location: ../posicionamento_patio.php");
	}else{
		$_SESSION['msg'] = "Erro ao confirmar o posicionamento";
		header("Location: ../posicionamento_patio.php");
	}
}