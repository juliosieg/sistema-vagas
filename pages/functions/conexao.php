<?php

class Conexao {

    var $link;
    var $result;

    // Metodo construtor
    function abreConexao() {
        $this->link = mysqli_connect("localhost","root",'',"sistema_vagas");

        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // Executa query
    function Executar($sql) {
        $this->result = mysqli_query($this->link, $sql);
        if(mysqli_errno($this->link)){
            return 'Error ' . mysqli_errno($this->link) . ': ' . mysqli_error($this->link);
        }
        return '1';
    }

    function MontarResultados() {
        $resultArray = mysqli_fetch_all($this->result, MYSQLI_ASSOC);
        return $resultArray;
    }

    function MontarResultadosArray(){  
        $resultArray = mysqli_fetch_array($this->result);
        return $resultArray;
    }

    // Numero de linhas retornada na consulta
    function ContarLinhas() {
        $lines = mysqli_num_rows($this->result);
        return $lines;
    }

    // Fecha conexao
    function Fechar() {
        mysqli_close($this->link);
    }

    // Libera consulta da memoria
    function Liberar() {
        mysqli_free_result($this->result);
    }

}

?>
