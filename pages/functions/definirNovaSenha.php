<?php

$senhaProvisoria = $_POST['senhaProvisoria'];
$novaSenha = $_POST['novaSenha'];
$email = $_POST['email'];

include "conexao.php";

if ($senhaProvisoria != null && $senhaProvisoria != "" && $novaSenha != null && $novaSenha != "") {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $senhaCriptografada = hash('whirlpool', $senhaProvisoria);
    $novaSenhaCriptografada = hash('whirlpool', $novaSenha);

    $sql = "SELECT * FROM usuarios where email = '".$email."' and senha_provisoria = '".$senhaCriptografada."'";
    $conexao->Executar($sql);
    $linhas = $conexao->ContarLinhas();

    if($linhas <= 0) {
        $result[] = array("ret" => false, "msg" => "Verifique a senha provisória informada.");
        echo json_encode($result);
    }else{

        $sql = "UPDATE usuarios SET senha_alterada = '0', senha_provisoria = '', senha = '".$novaSenhaCriptografada."'
                WHERE email = '".$email."'";
        $conexao->Executar($sql);
    
        $result[] = array("ret" => true, "msg" => "Senha alterada com sucesso. Redirecionando...");
        
        session_start();
        $_SESSION['senhaAlterada'] = 0;
        $_SESSION['logged'] = false;

        echo json_encode($result);
    }
} else {
    $result[] = array("ret" => false, "msg" => "Insira a senha provisória e a nova senha.");
    echo json_encode($result);
}