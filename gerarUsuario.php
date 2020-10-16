<?php

include "pages/functions/conexao.php";

$conexao = new Conexao();
$conexao->abreConexao();

$senhaCriptografada = hash('whirlpool', 'teste123');

$sql  = ' INSERT INTO usuarios (email, senha, senha_alterada, senha_provisoria, tipo_perfil) ';
$sql .= ' VALUES ("julio.sieg@gmail.com", "'.$senhaCriptografada.'", 0, "", 1)';

echo $sql;

$conexao->Executar($sql);

?>