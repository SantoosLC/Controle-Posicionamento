<?php

// Conexão com o banco de dados

    $servidor = "185.245.180.1"; // Servidor
    $usuario = "lksa8668_multilog"; // Usuario DB
    $senha = "Qwerty@747"; // Senha DB
    $db = "lksa8668_multilog"; // Nome do Banco de Dados

    $conn = mysqli_connect($servidor, $usuario, $senha, $db);

// Consultas MySql

date_default_timezone_set('America/Sao_Paulo');

$today = date("Y-m-d");

    // dashboard.php

        $dados_posicionamento_hoje = mysqli_query($conn, "SELECT * FROM posicionamentos WHERE DATE_FORMAT(data_realizado, '%Y-%m-%d') = '$today'");
        $row_dados_posicionamento_hoje = mysqli_fetch_all($dados_posicionamento_hoje, MYSQLI_ASSOC);

        // Prioridade Gestor

        $prioridade_sim = 0;

        foreach ($row_dados_posicionamento_hoje as $row) {

            if ($row['prioridade_gestor'] == "Sim" ) {
                $prioridade_sim++;
            }
        }

        $media_horario_hoje = mysqli_query($conn, "SELECT TIME_FORMAT(AVG(TIMEDIFF(data_realizado, data_solicitado)), '%H:%i:%s') AS media_de_hoje FROM posicionamentos");
        $row_media_horario_hoje = mysqli_fetch_assoc($media_horario_hoje);

        // Chart Js - Posicionamentos Realizados

        $posicionamentos_mensais = mysqli_query($conn, "SELECT MONTH(data_realizado) AS mes, COUNT(*) AS total FROM posicionamentos GROUP BY mes");

        $labels = array();
        $data = array();

        while ($row = mysqli_fetch_assoc($posicionamentos_mensais)) {
            $labels[] = $row['mes'];
            $data[] = $row['total'];
        }

        // Permissao Usuario 
        if(isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $permissao_sql = mysqli_query($conn,"SELECT permissao,area,armazem FROM web_login WHERE id = $id");
            $row_permissao = mysqli_fetch_assoc($permissao_sql);
            $permissao_user = $row_permissao['permissao'];
            $area_user = $row_permissao['area'];
            $armazem_responsavel = $row_permissao['armazem'];
        } else {
           echo "";
        }
        
        
