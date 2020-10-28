<?php

date_default_timezone_set('America/Sao_Paulo');

include "../functions/conexao.php";

$funcao = $_GET['funcao'];

switch ($funcao) {

    case 'carregarBeneficios':
        carregarBeneficios();
        break;
    case 'carregarDisponibilidadesHorario':
        carregarDisponibilidadesHorario();
        break;
    case 'carregarTiposCNH':
        carregarTiposCNH();
        break;
    case 'carregarRegimeContrato':
        carregarRegimeContrato();
        break;
    case 'carregarEscolaridades':
        carregarEscolaridades();
        break;
    case 'carregarEstados':
        carregaEstados();
        break;
    case 'carregarCidades':
        carregarCidades();
        break;
    case 'carregarCidadesFiltro':
        carregarCidadesFiltro();
        break;
    case 'carregarVagas':
        carregarVagas();
        break;
    case 'carregarVaga':
        carregarVaga();
        break;
    case 'candidatarSe':
        candidatarSe();
        break;
    case 'removerCandidatura':
        removerCandidatura();
        break;
    case 'carregaInfoCandidatura':
        carregaInfoCandidatura();
        break;
}

function carregarVaga() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql  = ' SELECT *';
    $sql .= ' FROM vagas ';
    $sql .= ' WHERE id = ' . $_GET['idVaga'];
    $sql .= ' ORDER BY id desc ';

    $conexao->Executar($sql);
    $retorno = $conexao->MontarResultados();

    $sql  = ' SELECT *';
    $sql .= ' FROM vagas_beneficios ';
    $sql .= ' WHERE id_vaga = ' . $_GET['idVaga'];

    $conexao->Executar($sql);
    $retornoBeneficios = $conexao->MontarResultados();

    $arrBeneficios = [];
    foreach($retornoBeneficios as $beneficio) {
        array_push($arrBeneficios, $beneficio['id_beneficio']);
    }

    $retorno[0]['beneficios'] = implode(',', $arrBeneficios);

    print_r(json_encode($retorno));
    $conexao->Fechar();     
}

function carregarVagas() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $where = ' WHERE 1=1 ';

    if(isset($_GET['escolaridade']) and $_GET['escolaridade'] != '') {
        $where .= ' AND v.escolaridade = ' . $_GET['escolaridade'];
    }

    if(isset($_GET['regime_contrato']) and $_GET['regime_contrato'] != '') {
        $where .= ' AND v.reg_contrato = ' . $_GET['regime_contrato'];
    }

    if(isset($_GET['pcd']) and $_GET['pcd'] != '') {
        $where .= ' AND v.pcd = ' . $_GET['pcd'];
    }

    if(isset($_GET['estado']) and $_GET['estado'] != '') {
        $where .= ' AND v.estado = ' . $_GET['estado'];
    }

    if(isset($_GET['cidade']) and $_GET['cidade'] != '') {
        $where .= ' AND v.cidade = ' . $_GET['cidade'];
    }

    if(isset($_GET['salarioInicial']) and $_GET['salarioInicial'] != '' 
    and isset($_GET['salarioFinal']) and $_GET['salarioFinal'] != '') {
    
        $where .= ' AND v.salario BETWEEN \''.$_GET['salarioInicial'].'\' 
        AND \''.$_GET['salarioFinal'].'\'';
    
    } elseif(isset($_GET['salarioInicial']) and $_GET['salarioInicial'] != '') {
    
        $where .= ' AND v.salario >= "' . $_GET['salarioInicial'] . '"';
    
    } elseif(isset($_GET['salarioFinal']) and $_GET['salarioFinal'] != '') {
        
        $where .= ' AND v.salario <= "' . $_GET['salarioFinal'] . '"';
    
    }

    /*Apenas vagas abertas*/
    $where .= ' AND (status = 1 or status = 2)';

    $sql = ' SELECT v.id, v.cargo, v.salario, m.nome as cidade, m.Uf as uf, v.status, v.dt_insercao';
    $sql .= ' FROM vagas v LEFT JOIN municipio m on v.cidade = m.Id ';
    $sql .= $where;
    $sql .= ' ORDER BY v.id desc ';

    $conexao->Executar($sql);
    
    $vagas = $conexao->MontarResultados();

    session_start();

    foreach ($vagas as $key => $vaga) {

        $sql = ' SELECT * ';
        $sql .= ' FROM vagas_candidato ';
        $sql .= ' WHERE id_candidato = '.$_SESSION['id'].' AND id_vaga = ' . $vaga['id'];

        $conexao->Executar($sql);

        if($conexao->ContarLinhas() > 0) {
            $vagas[$key]['situacao'] = 1;
        } else {
            $vagas[$key]['situacao'] = 0;
        }

    }

    print_r(json_encode($vagas));
    $conexao->Fechar();
}

function carregarBeneficios() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT b.descricao FROM beneficios b INNER JOIN vagas_beneficios v ON
    b.id = v.id_beneficio WHERE v.id_vaga = '.$_GET['id'];
    $sql .= ' ORDER BY b.descricao ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();

}

function carregarDisponibilidadesHorario() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM disponibilidade_horario';
    $sql .= ' ORDER BY descricao ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();

}

function carregarTiposCNH() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM tipos_cnh';
    $sql .= ' ORDER BY descricao ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();

}

function carregarRegimeContrato() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM regime_contrato';
    $sql .= ' ORDER BY descricao ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();

}

function carregarEscolaridades() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM escolaridade';
    $sql .= ' ORDER BY descricao ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();

}

function carregaEstados() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM estado';
    $sql .= ' ORDER BY Nome ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();

}

function carregarCidades() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM municipio where Id = ' . $_GET['id'];
    
    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();

}

function carregarCidadesFiltro() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT m.Id, m.Nome FROM municipio m inner join estado e on e.Uf = m.Uf where e.id = ' . $_GET['idEstado'];
    
    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();

}

function candidatarSe() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    session_start();

    $sql = 'INSERT INTO vagas_candidato (id_vaga, id_candidato, dt_candidatura) 
    VALUES ('.$_POST['idVaga'].', '. $_SESSION['id'] .', "'.date('Y-m-d H:i:s').'")';
    $conexao->Executar($sql);

    $conexao->Fechar();
    echo '1';
}

function removerCandidatura() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    session_start();

    $sql = 'DELETE FROM vagas_candidato WHERE id_vaga = '.$_POST['idVaga'].' AND id_candidato = '. $_SESSION['id'];
    $conexao->Executar($sql);

    $conexao->Fechar();
    echo '1';
}

function carregaInfoCandidatura() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    session_start();

    $sql = ' SELECT dt_candidatura FROM vagas_candidato where id_vaga = ' . $_GET['id'] . ' AND id_candidato = ' . $_SESSION['id'];
    
    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();
}
