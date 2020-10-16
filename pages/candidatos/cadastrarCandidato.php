<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('America/Sao_Paulo');

require '../../vendor/autoload.php';

include "../functions/conexao.php";

$mail = new PHPMailer(true);

$conexao = new Conexao();
$conexao->abreConexao();

$senha = generateRandomString(8);
$senhaCriptografada = hash('whirlpool', $senha);

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
        $id = str_replace('atribuicoes_empresa_', '', $key);
        
        $objEmpresa = [
            'empresa'       => $_POST['empresa_'.$id] ?? '',
            'cargo'         => $_POST['cargo_'.$id] ?? '',
            'dtInicio'      => $_POST['dtInicioEmpresa_'.$id] ?? '',
            'dtSaida'       => $_POST['dtFimEmpresa_'.$id] ?? '',
            'atribuicoes'   => $_POST['atribuicoes_empresa_'.$id] ?? '',
            'trabalhoAtual' => (isset($_POST['trabalhoAtual_'.$id]) && $_POST['trabalhoAtual_'.$id]) ? '1' : '0'
        ];

        array_push($arrEmpresas, $objEmpresa);
    
    }

    if (strpos($key, 'instituicao_') !== false) {
        $id = str_replace('instituicao_', '', $key);
        
        $objFormacao = [
            'instituicao'       => $_POST['instituicao_'.$id] ?? '',
            'curso'             => $_POST['curso_'.$id] ?? '',
            'nivel'             => $_POST['nivel_'.$id] ?? '',
            'dtInicioFormacao'  => $_POST['dtInicioFormacao_'.$id] ?? '',
            'dtFimFormacao'     => $_POST['dtFimFormacao_'.$id] ?? '',
        ];

        array_push($arrEducacao, $objFormacao);
    
    }

    if (strpos($key, 'nivel_idioma_') !== false) {
        $id = str_replace('nivel_idioma_', '', $key);
        
        $objIdioma = [
            'idioma'       => $_POST['idioma_'.$id] ?? '',
            'nivel'        => $_POST['nivel_idioma_'.$id] ?? ''
        ];

        array_push($arrIdiomas, $objIdioma);
    
    }
}

//Verifica CPF já cadastrado
$sql = "SELECT * FROM candidatos where cpf = '".$cpf."'";
$conexao->Executar($sql);
$linhas = $conexao->ContarLinhas();

if($linhas > 0) {
    $result[] = array("ret" => false, "msg" => "CPF já cadastrado em nossa base de dados.");
    echo json_encode($result);
}else{

    //Verifica e-mail já cadastrado
    $sql = "SELECT * FROM candidatos where email = '".$email."'";
    $conexao->Executar($sql);
    $linhas = $conexao->ContarLinhas();

    if($linhas > 0) {
        $result[] = array("ret" => false, "msg" => "E-mail já cadastrado em nossa base de dados.");
        echo json_encode($result);
    } else {

        $sql = "INSERT INTO candidatos (nome, cpf, sexo, estado_civil, naturalidade, 
                email, data_nascimento, pcd, endereco, numero, complemento, bairro, 
                estado, cidade, celular, fixo, linkedin, facebook, blog, area_interesse, 
                nivel_interesse, observacoes, dt_atualizacao) 
                VALUES ('".$nome."', '".$cpf."', ".$sexo.", ".$estado_civil.", '".$naturalidade."',
                '".$email."', '".$data_nascimento."', ".$pcd.", '".$endereco."', '".$numero."',
                '".$complemento."', '".$bairro."', ".$estado.", ".$cidade.", '".$celular."',
                '".$fixo."', '".$linkedin."', '".$facebook."', '".$blog."', ".$area_interesse.",
                '".$nivel_interesse."', '".$observacoes."', '".date('Y-m-d H:i:s')."')";

        echo $sql;

        $conexao->Executar($sql);

        $sql = "INSERT INTO usuarios (email, senha, senha_alterada, senha_provisoria, tipo_perfil)
                VALUES ('".$email."', '".$senhaCriptografada."', 1, '".$senhaCriptografada."', 2)";

        $conexao->Executar($sql);

        $sql = "SELECT MAX(id) as maxId FROM candidatos";
        $conexao->Executar($sql);
        $resultado = $conexao->MontarResultados();

        $idCandidato = $resultado[0]['maxId'];

        foreach($arrEmpresas as $empresa) {
            $sql = "INSERT INTO empresas_candidato (empresa, cargo, dtInicio, dtFim, atribuicoes, trabalhoAtual, id_candidato)
                VALUES ('".$empresa['empresa']."', '".$empresa['cargo']."', '".$empresa['dtInicio']."', '".$empresa['dtSaida']."', '".$empresa['atribuicoes']."', '".$empresa['trabalhoAtual']."', $idCandidato)";

            $conexao->Executar($sql);
        }

        foreach($arrEducacao as $formacao) {
            $sql = "INSERT INTO formacoes_candidato (instituicao, curso, nivel, dtInicioFormacao, dtFimFormacao, id_candidato)
                VALUES ('".$formacao['instituicao']."', '".$formacao['curso']."', '".$formacao['nivel']."', '".$formacao['dtInicioFormacao']."', '".$formacao['dtFimFormacao']."', $idCandidato)";

            $conexao->Executar($sql);
        }

        foreach($arrIdiomas as $idioma) {
            $sql = "INSERT INTO idiomas_candidato (idioma, nivel, id_candidato)
                VALUES ('".$idioma['idioma']."', '".$idioma['nivel']."', $idCandidato)";

            $conexao->Executar($sql);
        }

        try {
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.hostinger.com.br';                
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'nao-responda@linkpessoas.com.br';                     
            $mail->Password   = 'Link@321';           
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom('nao-responda@linkpessoas.com.br', 'Link Pessoas');
            $mail->addAddress($email); 

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Novo Cadastro';
            $mail->Body    = 'Olá, seu cadastro foi concluído com sucesso. <br> Utilize a senha abaixo para fazer o seu primeiro login no sistema da Link Pessoas e Negócios.
            <br> A senha provisória é: <b>'.$senha.'</b>';

            $mail->send();

            $result[] = array("ret" => true, "msg" => "Cadastro efetuado com sucesso! Uma senha provisória foi enviada ao seu e-mail. Redirecionando...");
            echo json_encode($result);

        } catch (Exception $e) {
            $result[] = array("ret" => false, "msg" => "Erro: ".$mail->ErrorInfo.".");
            echo json_encode($result);
        }
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

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}