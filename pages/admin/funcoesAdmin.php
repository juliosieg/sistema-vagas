<?php

include "../functions/conexao.php";

$funcao = $_GET['funcao'];

switch ($funcao) {

    case 'carregarDashboard':
        carregarDashboard();
        break;

}

function carregarDashboard() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT id FROM vagas';
    $conexao->Executar($sql);
    $qtdVagas = $conexao->ContarLinhas();

    $sql = ' SELECT id FROM candidatos';
    $conexao->Executar($sql);
    $qtdCandidatos = $conexao->ContarLinhas();

    $retorno = [
        'qtdVagas' => $qtdVagas ?? 0,
        'qtdCandidatos' => $qtdCandidatos ?? 0
    ];

    print_r(json_encode($retorno));

    $conexao->Fechar();
}