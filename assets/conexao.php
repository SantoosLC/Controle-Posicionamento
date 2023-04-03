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


        // Métricas

        // Recuperar o valor de ontem
        // $ontem = date('Y-m-d', strtotime('-1 day'));
        // $query = "SELECT container FROM posicionamentos WHERE DATE_FORMAT(data_solicitado, '%Y-%m-%d') = '$ontem'";
        // $result = mysqli_query($conn, $query);
        // $valor_ontem = mysqli_fetch_assoc($result);

        // Recuperar o valor de hoje
        // $hoje = date('Y-m-d');
        // $query = "SELECT valor FROM metricas WHERE DATE(datahora) = '$hoje'";
        // $result = $mysqli->query($query);
        // $valor_hoje = $result->fetch_assoc()['valor'];

        // // Calcular a mudança percentual
        // $aumento_percentual = ($valor_hoje - $valor_ontem) / $valor_ontem * 100;

        // echo "Aumento percentual desde ontem: " . round($aumento_percentual) . "%";
        
        

