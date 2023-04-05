<?php

function loc_cntr($containers) {
    $file = fopen('requests/planilha/estoque_em_container_cheio.csv', 'r');
    $headers = fgetcsv($file, 0, ';');
    $data_info_cntr = array();
    while ($row = fgetcsv($file, 0, ';')) {
        $data_info_cntr[] = array_combine($headers, $row);
    }
    fclose($file);

    $localizacao = '';
    foreach ($data_info_cntr as $info_cntr) {
        if (in_array($info_cntr['Container'], $containers)) {
            $localizacao = $info_cntr['Dep'] . '-' . $info_cntr['Ar'] . '-' . $info_cntr['Endereco'];
        }
    }
    return $localizacao;
}

function cliente_cntr($containers) {
    $file = fopen('requests/planilha/estoque_em_container_cheio.csv', 'r');
    $headers = fgetcsv($file, 0, ';');
    $data_info_cntr = array();
    while ($row = fgetcsv($file, 0, ';')) {
        $data_info_cntr[] = array_combine($headers, $row);
    }
    fclose($file);

    $cliente = '';
    foreach ($data_info_cntr as $info_cntr) {
        if (in_array($info_cntr['Container'], $containers)) {
            $cliente = $info_cntr['Nome'];
        }
    }
    return $cliente;
}