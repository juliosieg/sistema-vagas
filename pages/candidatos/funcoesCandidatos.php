<?php

date_default_timezone_set('America/Sao_Paulo');

include "../functions/conexao.php";

$funcao = $_GET['funcao'];

switch ($funcao) {

    case 'carregarCandidatos':
        carregarCandidatos();
        break;
    case 'carregarAreas':
        carregarAreas();
        break;
    case 'carregarNiveis':
        carregarNiveis();
        break;
    case 'carregarIdiomas':
        carregarIdiomas();
        break;
    case 'carregarNiveisIdiomas':
        carregarNiveisIdiomas();
        break;
}

function carregarAreas() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM areas_interesse';
    $sql .= ' ORDER BY area ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();
}

function carregarNiveis() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM niveis_interesse';
    $sql .= ' ORDER BY nivel ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();
}

function carregarIdiomas() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM idiomas';
    $sql .= ' ORDER BY idioma ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();
}

function carregarNiveisIdiomas() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM niveis_idiomas';
    $sql .= ' ORDER BY nivel';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();
}

function carregarCandidatos() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $where = ' WHERE 1=1 ';

    if(isset($_GET['status']) and $_GET['status'] != '') {
        $where .= ' AND status = ' . $_GET['status'];
    }

    if(isset($_GET['dtCadastroInicial']) and $_GET['dtCadastroInicial'] != '' 
    and isset($_GET['dtCadastroFinal']) and $_GET['dtCadastroFinal'] != '') {
    
        $where .= ' AND dt_insercao BETWEEN CAST(\''.$_GET['dtCadastroInicial'].'\' AS DATE) 
        AND CAST(\''.$_GET['dtCadastroFinal'].'\' AS DATE)';
    
    } elseif(isset($_GET['dtCadastroInicial']) and $_GET['dtCadastroInicial'] != '') {
    
        $where .= ' AND dt_insercao >= "' . $_GET['dtCadastroInicial'] . '"';
    
    } elseif(isset($_GET['dtCadastroFinal']) and $_GET['dtCadastroFinal'] != '') {
        
        $where .= ' AND dt_insercao <= "' . $_GET['dtCadastroFinal'] . '"';
    
    }

    if(isset($_GET['salarioInicial']) and $_GET['salarioInicial'] != '' 
    and isset($_GET['salarioFinal']) and $_GET['salarioFinal'] != '') {
    
        $where .= ' AND salario BETWEEN \''.$_GET['salarioInicial'].'\' 
        AND \''.$_GET['salarioFinal'].'\'';
    
    } elseif(isset($_GET['salarioInicial']) and $_GET['salarioInicial'] != '') {
    
        $where .= ' AND salario >= "' . $_GET['salarioInicial'] . '"';
    
    } elseif(isset($_GET['salarioFinal']) and $_GET['salarioFinal'] != '') {
        
        $where .= ' AND salario <= "' . $_GET['salarioFinal'] . '"';
    
    }

    $sql = ' SELECT c.id, c.nome, a.area, n.nivel, c.linkedin, c.facebook, c.blog, c.dt_atualizacao';
    $sql .= ' FROM candidatos c ';
    $sql .= ' INNER JOIN areas_interesse a ON a.id = c.area_interesse ';
    $sql .= ' INNER JOIN niveis_interesse n ON n.id = c.nivel_interesse ';
    $sql .= $where;
    $sql .= ' ORDER BY c.nome ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar(); 
}
