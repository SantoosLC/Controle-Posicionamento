<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $arquivo = $_FILES["arquivo"]["tmp_name"];
    $nome = $_FILES["arquivo"]["name"];

    $info = pathinfo($nome);
    if ($info['filename'] != 'estoque_em_container_cheio') {
        $_SESSION['msg_arquivo'] = 'Relatório invalido, precisamos que o nome do arquivo seja: estoque_em_container_cheio';
    } else {
        $destino = "planilha/" . $nome;
        move_uploaded_file($arquivo, $destino);
        $_SESSION['msg_arquivo'] = "Arquivo enviado com sucesso!";
    }

}

header("location: ../dashboard.php");