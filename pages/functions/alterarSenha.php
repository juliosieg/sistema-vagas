<?php

$senhaAtual = $_POST['senhaAtual'];
$novaSenha = $_POST['novaSenha'];
$email = $_POST['email'];

include "conexao.php";

if ($senhaAtual != null && $senhaAtual != "" && $novaSenha != null && $novaSenha != "") {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $senhaCriptografada = hash('whirlpool', $senhaAtual);
    $novaSenhaCriptografada = hash('whirlpool', $novaSenha);

    $sql = "SELECT * FROM usuarios where email = '".$email."' and senha = '".$senhaCriptografada."'";
    $conexao->Executar($sql);
    $linhas = $conexao->ContarLinhas();

    if($linhas <= 0) {
        $result[] = array("ret" => false, "msg" => "Verifique a senha atual informada.");
        echo json_encode($result);
    }else{

        $sql = "UPDATE usuarios SET senha = '".$novaSenhaCriptografada."'
                WHERE email = '".$email."'";
        $conexao->Executar($sql);
    
        $result[] = array("ret" => true, "msg" => "Senha alterada com sucesso.");
        
        echo json_encode($result);
    }
} else {
    $result[] = array("ret" => false, "msg" => "Insira a senha atual e a nova senha.");
    echo json_encode($result);
}