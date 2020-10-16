<?php

    require "../../vendor/autoload.php";
    include "conexao.php";

    $conexao = new Conexao(); // Abre conexao
    $conexao->abreConexao();

    //Utilizando via Classe
    $class = new Jarouche\ViaCEP\BuscaViaCEPJSON();
    
    try {
        $result = $class->retornaCEP($_GET['cep']);
    } catch (Exception $e) {
        $result = [];
    }

    //Faz o retorno do CEP
    

    if (isset($result['ibge'])) {

        $sql  = " SELECT c.id as idCidade, e.id as idEstado, p.id as idPais, c.ibge as cod_ibge FROM cidade c ";
        $sql .= " INNER JOIN estado e ON e.id = c.uf ";
        $sql .= " INNER JOIN pais p ON p.id = e.pais ";
        $sql .= " WHERE c.ibge = " . $result['ibge'];
        
        $conexao->Executar($sql);

        $resultadosCidade = $conexao->MontarResultados();

        print_r(json_encode($resultadosCidade[0]));

    } else {

        print_r(0);

    }

?>