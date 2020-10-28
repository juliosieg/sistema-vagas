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
    case 'carregarCurriculo':
        carregarCurriculo();
        break;
    case 'carregarExperienciasCandidato':
        carregarExperienciasCandidato();
        break;
    case 'carregarIdiomasCandidato':
        carregarIdiomasCandidato();
        break;
    case 'carregarEscolaridadeCandidato':
        carregarEscolaridadeCandidato();
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

    if(isset($_GET['area']) and $_GET['area'] != '' and $_GET['area'] != 'null') {
        $where .= ' AND c.area_interesse = ' . $_GET['area'];
    }

    if(isset($_GET['nivel']) and $_GET['nivel'] != '' and $_GET['nivel'] != 'null') {
        $where .= ' AND c.nivel_interesse = ' . $_GET['nivel'];
    }

    if(isset($_GET['idioma']) and $_GET['idioma'] != '' and $_GET['idioma'] != 'null') {
        $where .= ' AND ic.idioma = ' . $_GET['idioma'];
    }

    if(isset($_GET['nivel_idioma']) and $_GET['nivel_idioma'] != '' and $_GET['nivel_idioma'] != 'null') {
        $where .= ' AND ic.nivel = ' . $_GET['nivel_idioma'];
    }

    if(isset($_GET['estado']) and $_GET['estado'] != '' and $_GET['estado'] != 'null') {
        $where .= ' AND c.estado = ' . $_GET['estado'];
    }

    if(isset($_GET['cidade']) and $_GET['cidade'] != '' and $_GET['cidade'] != 'null') {
        $where .= ' AND c.cidade = ' . $_GET['cidade'];
    }

    $sql = ' SELECT c.id, c.nome, a.area, n.nivel, c.linkedin, c.facebook, c.blog, c.dt_atualizacao';
    $sql .= ' FROM candidatos c ';
    $sql .= ' INNER JOIN areas_interesse a ON a.id = c.area_interesse ';
    $sql .= ' INNER JOIN niveis_interesse n ON n.id = c.nivel_interesse ';
    $sql .= ' INNER JOIN idiomas_candidato ic ON ic.id_candidato = c.id ';
    $sql .= $where;
    $sql .= ' GROUP BY c.id ORDER BY c.nome ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar(); 
}

function carregarCurriculo() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $id = $_GET['id'] ?? '';
    
    if ($id != '') {

        $sql = ' SELECT c.id, c.nome, c.cpf, c.sexo, c.estado_civil, c.naturalidade, 
        c.email, c.data_nascimento, c.pcd, c.endereco, c.numero, c.complemento, c.bairro, 
        c.estado, c.cidade, c.celular, c.fixo, c.linkedin, c.facebook, c.blog, c.area_interesse, 
        c.nivel_interesse, c.observacoes';
        $sql .= ' FROM candidatos c ';
        $sql .= ' WHERE c.id = ' . $id;
        
        $conexao->Executar($sql);
        print_r(json_encode($conexao->MontarResultados()));
        $conexao->Fechar(); 

    }

}

function carregarExperienciasCandidato() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $id = $_GET['id'] ?? '';
    
    if ($id != '') {

        $sql = ' SELECT e.id, e.empresa, 
        e.cargo, e.dtInicio, e.dtFim, e.atribuicoes, e.trabalhoAtual';
        $sql .= ' FROM empresas_candidato e ';
        $sql .= ' WHERE e.id_candidato = ' . $id;

        $conexao->Executar($sql);
        print_r(json_encode($conexao->MontarResultados()));
        $conexao->Fechar(); 

    }
}

function carregarIdiomasCandidato() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $id = $_GET['id'] ?? '';
    
    if ($id != '') {

        $sql = ' SELECT ic.id, ic.idioma, ic.nivel ';
        $sql .= ' FROM idiomas_candidato ic ';
        $sql .= ' WHERE ic.id_candidato = ' . $id;

        $conexao->Executar($sql);
        print_r(json_encode($conexao->MontarResultados()));
        $conexao->Fechar(); 

    }

}

function carregarEscolaridadeCandidato() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $id = $_GET['id'] ?? '';
    
    if ($id != '') {

        $sql = ' SELECT id, instituicao, curso, nivel, dtInicioFormacao, dtFimFormacao ';
        $sql .= ' FROM formacoes_candidato ';
        $sql .= ' WHERE id_candidato = ' . $id;

        $conexao->Executar($sql);
        print_r(json_encode($conexao->MontarResultados()));
        $conexao->Fechar(); 

    }

}
