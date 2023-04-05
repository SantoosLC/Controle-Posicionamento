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

        $media_horario_hoje = mysqli_query($conn, "SELECT TIME_FORMAT(AVG(TIMEDIFF(data_realizado, data_solicitado)), '%H:%i:%s') AS media_de_hoje FROM posicionamentos WHERE DATE_FORMAT(data_solicitado, '%Y-%m-%d') = '$today'");
        $row_media_horario_hoje = mysqli_fetch_assoc($media_horario_hoje);

        // Chart Js - Posicionamentos Realizados

        $sql_chart = mysqli_query($conn,"SELECT MONTH(data_solicitado) AS mes, COUNT(containers) AS total_posicionamentos FROM posicionamentos GROUP BY MONTH(data_solicitado)");
        
        // Preparar os dados para serem usados no gráfico
        $meses = array();
        $posicionamentos = array();

        if (mysqli_num_rows($sql_chart) > 0) {
            while($result_chart = mysqli_fetch_assoc($sql_chart)) {
                $meses[] = date('M', mktime(0, 0, 0, $result_chart['mes'], 1));
                $posicionamentos[] = $result_chart['total_posicionamentos'];
            }
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

        // Métricas

        // Posicionamentos ontem e hoje
            // Recuperar o valor de ontem
            $ontem = date('Y-m-d', strtotime('-1 day'));
            $sql_metrica_ontem = mysqli_query($conn,"SELECT COUNT(containers) as total FROM posicionamentos WHERE DATE_FORMAT(data_solicitado, '%Y-%m-%d') = '$ontem'");
            $valor_ontem = mysqli_fetch_assoc($sql_metrica_ontem);
            
            // Recuperar o valor de hoje
            $sql_metrica_hoje = mysqli_query($conn, "SELECT COUNT(containers) as total FROM posicionamentos WHERE DATE_FORMAT(data_solicitado, '%Y-%m-%d') = '$today'");
            $valor_hoje = mysqli_fetch_assoc($sql_metrica_hoje);

            // // Calcular a mudança percentual
            $aumento_percentual = ($valor_hoje['total'] - $valor_ontem['total']) / $valor_ontem['total'] * 100;

        // Posicionamentos priorizados

            // Recuperar o valor de ontem
            $sql_prioridade_ontem = mysqli_query($conn,"SELECT COUNT(prioridade_gestor) as total FROM posicionamentos WHERE DATE_FORMAT(data_solicitado, '%Y-%m-%d') = '$ontem' and prioridade_gestor = 'Sim'");
            $valor_prioridade_ontem = mysqli_fetch_assoc($sql_prioridade_ontem);
            
            // Recuperar o valor de hoje
            $sql_prioridade_hoje = mysqli_query($conn, "SELECT COUNT(prioridade_gestor) as total FROM posicionamentos WHERE DATE_FORMAT(data_solicitado, '%Y-%m-%d') = '$today' and prioridade_gestor = 'Sim'");
            $valor_prioridade_hoje = mysqli_fetch_assoc($sql_prioridade_hoje);

            // // Calcular a mudança percentual
            if($valor_prioridade_ontem['total'] == 0) {
                $aumento_percentual_pos_pri = ($valor_prioridade_hoje['total'] - $valor_prioridade_ontem['total']) / $valor_prioridade_hoje['total'] * 100;
            } else {
                $aumento_percentual_pos_pri = ($valor_prioridade_hoje['total'] - $valor_prioridade_ontem['total']) / $valor_prioridade_ontem['total'] * 100;
            }


        
        

