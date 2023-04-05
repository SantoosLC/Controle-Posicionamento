<?php
session_start();

require_once '../../assets/conexao.php'; 

    $login = $_SESSION['primeiro_login'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar-senha'];

    if($senha != $confirmar_senha) {
        $_SESSION['error_senha'] = 'As senhas não correspondem';
        header("Location: ../../primeiro_login.php");
    } else {
        $atualizar_usuario = mysqli_query($conn, "UPDATE web_login SET senha='$senha', primeiro_login=1 WHERE login='$login'");
        header("Location: ../../login.php");
    }
?>