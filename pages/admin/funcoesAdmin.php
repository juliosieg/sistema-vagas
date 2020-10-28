<?php

include "../functions/conexao.php";

$funcao = $_GET['funcao'];

switch ($funcao) {

    case 'carregarDashboard':
        carregarDashboard();
        break;
    case 'carregarCandidaturas':
        carregarCandidaturas();
        break;

}

function carregarCandidaturas() {
    $conexao = new Conexao();
    $conexao->abreConexao();
    
    session_start();

    $retorno = [];

    if($_SESSION['id']) {
        $sql = ' SELECT v.id, v.cargo, vc.dt_candidatura, v.status 
        FROM vagas v
        INNER JOIN vagas_candidato vc ON vc.id_vaga = v.id
        WHERE vc.id_candidato = ' . $_SESSION['id'];
        $conexao->Executar($sql);

        $retorno = $conexao->MontarResultados();        
    }

    print_r(json_encode($retorno));

    $conexao->Fechar();
}

function carregarDashboard() {
    $conexao = new Conexao();
    $conexao->abreConexao();
    
    session_start();

    $sql = ' SELECT id FROM vagas';
    $conexao->Executar($sql);
    $qtdVagas = $conexao->ContarLinhas();

    $sql = ' SELECT id FROM candidatos';
    $conexao->Executar($sql);
    $qtdCandidatos = $conexao->ContarLinhas();

    $sql = ' SELECT id FROM vagas where status = 1';
    $conexao->Executar($sql);
    $qtdCandidatos = $conexao->ContarLinhas();

    $sql = ' SELECT * FROM candidatos where id = "' . $_SESSION['id'] . '"';
    $conexao->Executar($sql);
    if($conexao->ContarLinhas()){
        $resultado = $conexao->MontarResultados();
        $dtAtualizacaoDados = $resultado[0]['dt_atualizacao'] ? date("d/m/Y", strtotime($resultado[0]['dt_atualizacao'])) : '';
    }
    $retorno = [
        'qtdVagas' => $qtdVagas ?? 0,
        'qtdCandidatos' => $qtdCandidatos ?? 0,
        'qtdVagasCandidato' => $qtdCandidatos ?? 0,
        'dtAtualizacaoDados' => $dtAtualizacaoDados ?? ''
    ];

    print_r(json_encode($retorno));

    $conexao->Fechar();
}