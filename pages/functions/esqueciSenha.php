<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$mail = new PHPMailer(true);

$email = $_POST['email'];

include "conexao.php";

if ($email != null && $email != "") {

    $conexao = new Conexao();
    $conexao->abreConexao();

    $senhaProvisoria = generateRandomString(8);
    $senhaCriptografada = hash('whirlpool', $senhaProvisoria);

    $sql = "SELECT * FROM usuarios where email = '".$email."'";
    $conexao->Executar($sql);
    $linhas = $conexao->ContarLinhas();

    if($linhas <= 0) {
        $result[] = array("ret" => false, "msg" => "Verifique o e-mail informado.");
        echo json_encode($result);
    }else{

        $sql = "UPDATE usuarios SET senha_alterada = '1', senha_provisoria = '".$senhaCriptografada."'
                WHERE email = '".$email."'";
        $conexao->Executar($sql);

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
            $mail->Subject = 'Redefinição de senha';
            $mail->Body    = 'Uma nova senha provisória foi gerada para você. <br> Utilize-a para fazer login no sistema da Link Pessoas e Negócios.
            <br> A senha provisória é: <b>'.$senhaProvisoria.'</b>';
        
            $mail->send();

            $result[] = array("ret" => true, "msg" => "Uma senha provisória foi enviada ao seu e-mail");
            echo json_encode($result);

        } catch (Exception $e) {
            $result[] = array("ret" => false, "msg" => "Erro: ".$mail->ErrorInfo.".");
            echo json_encode($result);
        }
    
        
    }
} else {
    $result[] = array("ret" => false, "msg" => "Insira um e-mail.");
    echo json_encode($result);
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