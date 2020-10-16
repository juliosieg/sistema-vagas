<?php

$usuario = $_POST['email'];
$senha = $_POST['senha'];

include "conexao.php";

if ($usuario != null && $usuario != "" && $senha != null && $senha != "") {

    $s = filter_var($senha, FILTER_SANITIZE_STRING);

    $senha = hash('whirlpool', $senha);

    $conexao = new Conexao();
    $conexao->abreConexao();

    $sql = "SELECT u.email, u.tipo_perfil, u.senha_alterada FROM usuarios u WHERE u.email = '$usuario' AND (u.senha = '$senha' OR u.senha_provisoria = '$senha')";

    $conexao->Executar($sql);
    $linhas = $conexao->ContarLinhas();

    if ($linhas <= 0) {
    
        $result[] = array("ret" => false, "msg" => "Usuário e/ou senha incorretos.");
        echo json_encode($result);
        $conexao->Fechar();
        exit(0);
    
    } else {

        $resultado = $conexao->MontarResultados();

        $tipo_perfil = $resultado[0]['tipo_perfil'];
        $email = $resultado[0]['email'];
        $senhaAlterada = $resultado[0]['senha_alterada'];
        
        session_start();
        $_SESSION['tipo_perfil'] = $tipo_perfil;
        $_SESSION['email'] = $email;
        $_SESSION['senhaAlterada'] = $senhaAlterada;
        $_SESSION['logged'] = TRUE;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);

        $conexao->Fechar();

        $result[] = array("ret" => true, "msg" => "Bem vindo!");

        echo json_encode($result);
        exit(0);

    }

}else {
 
    $result[] = array("ret" => false, "msg" => "Usuário e/ou senha nulos!");
    echo json_encode($result);

}