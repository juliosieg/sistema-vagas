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
    case 'salvarVaga':
        salvarVaga();
        break;
    case 'carregarVagas':
        carregarVagas();
        break;
    case 'excluirVaga':
        excluirVaga();
        break;
    case 'carregarVaga':
        carregarVaga();
        break;
    case 'alterarStatus':
        alterarStatus();
        break;
    case 'verCandidatos':
        verCandidatos();
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

    $sql = ' SELECT id, cargo, salario, status, dt_insercao';
    $sql .= ' FROM vagas ';
    $sql .= $where;
    $sql .= ' ORDER BY id desc ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();
}

function carregarBeneficios() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM beneficios';
    $sql .= ' ORDER BY descricao ';

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

    $sql = ' SELECT * FROM estado where id = ' . $_GET['idEstado'];
    $conexao->Executar($sql);
    $result = $conexao->MontarResultados();

    $sql = ' SELECT * FROM municipio where Uf = "' . $result[0]['Uf'] . '"';
    $sql .= ' ORDER BY Nome ';
    $conexao->Executar($sql);
    
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();

}

function excluirVaga() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = 'UPDATE vagas SET status = 5 WHERE id = ' . $_POST['idVaga'];
    $conexao->Executar($sql);

    $conexao->Fechar();
    echo '1';
}

function salvarVaga() {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $id = $_POST['id'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $salario = ($_POST['salario'] ? str_replace(',', '.', str_replace(".", "", $_POST['salario'])) : '');
    $disp_horario = $_POST['disp_horario'] ?? '';
    $pcd = $_POST['pcd'] ?? '';
    $cnh = $_POST['cnh'] ?? '';
    $reg_contrato = $_POST['reg_contrato'] ?? '';
    $tempo_experiencia = $_POST['tempo_experiencia'] ?? '';
    $escolaridade = $_POST['escolaridade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $desc_vaga = $_POST['descricao'] ?? '';
    $responsabilidades = $_POST['responsabilidades'] ?? '';
    $atribuicoes = $_POST['atribuicoes'] ?? '';
    $obs_cargo = $_POST['obs_cargo'] ?? '';
    $beneficios = $_POST['beneficios'] ?? [];
    
    if($id == ''){
        //Nova vaga
        $sql = "
        INSERT INTO vagas (
            cargo, salario, disp_horario, pcd, tipo_cnh, reg_contrato, tempo_experiencia, escolaridade, estado,
            cidade, descricao_vaga, responsabilidades, atribuicoes, observacoes, dt_insercao, status
        )
        VALUES (
            '".$cargo."', '".$salario."', '".$disp_horario."', '".$pcd."', 
            '".$cnh."', '".$reg_contrato."', '".$tempo_experiencia."', '".$escolaridade."', '".$estado."',
            '".$cidade."', '".$desc_vaga."', '".$responsabilidades."', '".$atribuicoes."', '".$obs_cargo."',
            '".date('Y-m-d H:i:s')."', 1
        )";

        $resultado = $conexao->Executar($sql);

        if($resultado != '1') {

            echo $resultado;
            return;

        } else {

            $sql = ' SELECT MAX(id) as id FROM vagas';
            $conexao->Executar($sql);
            $resultado = $conexao->MontarResultados();

            foreach($beneficios as $beneficio) {
                $sql = "
                INSERT INTO vagas_beneficios (
                    id_vaga, id_beneficio
                )
                VALUES (
                    '".$resultado[0]['id']."', 
                    '".$beneficio."'
                )";

                $conexao->Executar($sql);
            }
        }

        echo '1';

    } else if ($id != '') {

        //Atualizar vaga
        $sql = "
        UPDATE vagas
        SET
            cargo = '".$cargo."',
            salario = '".$salario."',
            disp_horario = '".$disp_horario."',
            pcd = '".$pcd."',
            tipo_cnh = '".$cnh."',
            reg_contrato = '".$reg_contrato."',
            tempo_experiencia = '".$tempo_experiencia."',
            escolaridade = '".$escolaridade."',
            estado = '".$estado."',
            cidade = '".$cidade."',
            descricao_vaga = '".$desc_vaga."',
            responsabilidades = '".$responsabilidades."',
            atribuicoes = '".$atribuicoes."',
            observacoes = '".$obs_cargo."'
        WHERE id = '".$id."'";

        $resultado = $conexao->Executar($sql);

        if($resultado != '1') {

            echo $resultado;
            return;

        } else {

            $sql = ' DELETE FROM vagas_beneficios where id_vaga = ' . $id;
            $conexao->Executar($sql);

            foreach($beneficios as $beneficio) {
                $sql = "
                INSERT INTO vagas_beneficios (
                    id_vaga, id_beneficio
                )
                VALUES (
                    '".$id."', 
                    '".$beneficio."'
                )";

                $conexao->Executar($sql);
            }
        }

        echo '1';
    }
    
}

function alterarStatus() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = 'UPDATE vagas SET status = '. $_POST['status'] . ' WHERE id = ' . $_POST['idVaga'];
    $conexao->Executar($sql);

    $conexao->Fechar();
    echo '1';
}

function verCandidatos() {
    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = ' SELECT * FROM vagas_candidato vc INNER JOIN candidatos c on c.id = vc.id_candidato';
    $sql .= ' WHERE vc.id_vaga = '.$_POST['idVaga'];
    $sql .= ' ORDER BY c.nome ';

    $conexao->Executar($sql);
    print_r(json_encode($conexao->MontarResultados()));
    $conexao->Fechar();
}