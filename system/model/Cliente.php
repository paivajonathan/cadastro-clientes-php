<?php

class Cliente {
    private $nome;
    private $email;
    private $dataNascimento;
    private $endereco;
    private $senha;

    function __construct() {
        $this->nome = null;
        $this->email = null;
        $this->dataNascimento = null;
        $this->endereco = null;
        $this->senha = null;
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function getSenha() {
        return $this->senha;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }   
}