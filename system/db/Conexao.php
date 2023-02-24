<?php

class Conexao {
    private $conexao;

    function __construct() {
        try {
            $this->conexao = new PDO('mysql:servername=localhost;dbname=dadosClientes', 'root', '');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getConexao() {
        return $this->conexao;
    }
}