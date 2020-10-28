<?php

date_default_timezone_set('America/Sao_Paulo');

require '../../vendor/autoload.php';

include "../functions/conexao.php";

$conexao = new Conexao();
$conexao->abreConexao();

$id                 = $_POST['id'] ?? '';
$nome               = $_POST['nome'] ?? '';
$cpf                = $_POST['cpf'] ? limpaCPF_CNPJ($_POST['cpf']) : '';
$sexo               = $_POST['sexo'] ?? '';
$estado_civil       = $_POST['estadoCivil'] ?? '';
$naturalidade       = $_POST['naturalidade'] ?? '';
$email              = $_POST['email'] ?? '';
$data_nascimento    = $_POST['dt_nascimento'] ?? '';
$pcd                = $_POST['pcd'] ?? '';
$endereco           = $_POST['endereco'] ?? '';
$numero             = $_POST['numero'] ?? '';
$complemento        = $_POST['complemento'] ?? '';
$bairro             = $_POST['bairro'] ?? '';
$estado             = $_POST['estado'] ?? '';
$cidade             = $_POST['cidade'] ?? '';
$celular            = $_POST['celular'] ? limpaTelefone($_POST['celular']) : '';
$fixo               = $_POST['fixo'] ? limpaTelefone($_POST['fixo']) : '';
$linkedin           = $_POST['linkedin'] ?? '';
$facebook           = $_POST['facebook'] ?? '';
$blog               = $_POST['blog'] ?? '';
$area_interesse     = $_POST['area_interesse'] ?? '';
$nivel_interesse    = $_POST['nivel_interesse'] ?? '';
$observacoes        = $_POST['observacoes_candidato'] ?? '';

$arrEmpresas = [];
$arrEducacao = [];
$arrIdiomas  = [];

foreach($_POST as $key => $val) {
    if (strpos($key, 'atribuicoes_empresa_') !== false) {
        $idEmpresa = str_replace('atribuicoes_empresa_', '', $key);
        
        $objEmpresa = [
            'empresa'       => $_POST['empresa_'.$idEmpresa] ?? '',
            'cargo'         => $_POST['cargo_'.$idEmpresa] ?? '',
            'dtInicio'      => $_POST['dtInicioEmpresa_'.$idEmpresa] ?? '',
            'dtSaida'       => $_POST['dtFimEmpresa_'.$idEmpresa] ?? '',
            'atribuicoes'   => $_POST['atribuicoes_empresa_'.$idEmpresa] ?? '',
            'trabalhoAtual' => (isset($_POST['trabalhoAtual_'.$idEmpresa]) && $_POST['trabalhoAtual_'.$idEmpresa]) ? '1' : '0'
        ];

        array_push($arrEmpresas, $objEmpresa);
    
    }

    if (strpos($key, 'instituicao_') !== false) {
        $idInstituicao = str_replace('instituicao_', '', $key);
        
        $objFormacao = [
            'instituicao'       => $_POST['instituicao_'.$idInstituicao] ?? '',
            'curso'             => $_POST['curso_'.$idInstituicao] ?? '',
            'nivel'             => $_POST['nivel_'.$idInstituicao] ?? '',
            'dtInicioFormacao'  => $_POST['dtInicioFormacao_'.$idInstituicao] ?? '',
            'dtFimFormacao'     => $_POST['dtFimFormacao_'.$idInstituicao] ?? '',
        ];

        array_push($arrEducacao, $objFormacao);
    
    }

    if (strpos($key, 'nivel_idioma_') !== false) {
        $idIdioma = str_replace('nivel_idioma_', '', $key);
        
        $objIdioma = [
            'idioma'       => $_POST['idioma_'.$idIdioma] ?? '',
            'nivel'        => $_POST['nivel_idioma_'.$idIdioma] ?? ''
        ];

        array_push($arrIdiomas, $objIdioma);
    
    }
}

//Verifica CPF já cadastrado
$sql = "SELECT * FROM candidatos where cpf = '".$cpf."' and id != '".$id."'";
$conexao->Executar($sql);
$linhas = $conexao->ContarLinhas();

if($linhas > 0) {
    $result[] = array("ret" => false, "msg" => "CPF já cadastrado em nossa base de dados.");
    echo json_encode($result);
}else{

    //Verifica e-mail já cadastrado
    $sql = "SELECT * FROM candidatos where email = '".$email."' and id != '".$id."'";
    $conexao->Executar($sql);
    $linhas = $conexao->ContarLinhas();

    if($linhas > 0) {
        $result[] = array("ret" => false, "msg" => "E-mail já cadastrado em nossa base de dados.");
        echo json_encode($result);
    } else {

        $sql = "UPDATE candidatos SET
                    nome = '".$nome."',
                    cpf = '".$cpf."',
                    sexo = '".$sexo."',
                    estado_civil = '".$estado_civil."',
                    naturalidade = '".$naturalidade."',
                    email = '".$email."',
                    data_nascimento = '".$data_nascimento."',
                    pcd = '".$pcd."',
                    endereco = '".$endereco."',
                    numero = '".$numero."',
                    complemento = '".$complemento."',
                    bairro = '".$bairro."',
                    estado = '".$estado."',
                    cidade = '".$cidade."',
                    celular = '".$celular."',
                    fixo = '".$fixo."',
                    linkedin = '".$linkedin."',
                    facebook = '".$facebook."',
                    blog = '".$blog."',
                    area_interesse = '".$area_interesse."',
                    nivel_interesse = '".$nivel_interesse."',
                    observacoes = '".$observacoes."', 
                    dt_atualizacao = '".date('Y-m-d H:i:s')."'
                    where id = $id
                ";

        $conexao->Executar($sql);

        $sql = "UPDATE usuarios SET
                email = '".$email."' 
                where id_candidato = $id";

        $conexao->Executar($sql);

        $sql = "DELETE FROM empresas_candidato WHERE id_candidato = $id";
        $conexao->Executar($sql);

        foreach($arrEmpresas as $empresa) {
            $sql = "INSERT INTO empresas_candidato (empresa, cargo, dtInicio, dtFim, atribuicoes, trabalhoAtual, id_candidato)
                VALUES ('".$empresa['empresa']."', '".$empresa['cargo']."', '".$empresa['dtInicio']."', '".$empresa['dtSaida']."', '".$empresa['atribuicoes']."', '".$empresa['trabalhoAtual']."', $id)";

            $conexao->Executar($sql);
        }

        $sql = "DELETE FROM formacoes_candidato WHERE id_candidato = $id";
        $conexao->Executar($sql);

        foreach($arrEducacao as $formacao) {
            $sql = "INSERT INTO formacoes_candidato (instituicao, curso, nivel, dtInicioFormacao, dtFimFormacao, id_candidato)
                VALUES ('".$formacao['instituicao']."', '".$formacao['curso']."', '".$formacao['nivel']."', '".$formacao['dtInicioFormacao']."', '".$formacao['dtFimFormacao']."', $id)";

            $conexao->Executar($sql);
        }

        $sql = "DELETE FROM idiomas_candidato WHERE id_candidato = $id";
        $conexao->Executar($sql);

        foreach($arrIdiomas as $idioma) {
            $sql = "INSERT INTO idiomas_candidato (idioma, nivel, id_candidato)
                VALUES ('".$idioma['idioma']."', '".$idioma['nivel']."', $id)";

            $conexao->Executar($sql);
        }
        
        $result[] = array("ret" => true, "msg" => "Cadastro alterado com sucesso!");
        echo json_encode($result);
    
    }
}

function limpaCPF_CNPJ($valor){
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    return $valor;
}

function limpaTelefone($valor){
    $valor = trim($valor);
    $valor = str_replace("(", "", $valor);
    $valor = str_replace(")", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace(" ", "", $valor);
    return $valor;
}