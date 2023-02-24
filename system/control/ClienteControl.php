<?php

include_once('../db/Conexao.php');
include_once('../model/Cliente.php');

class ClienteControl {
    static function insert(Cliente $cliente) {
        $conexao = (new Conexao())->getConexao();
        $query = 'INSERT INTO cliente VALUES (?, ?, ?, ?, ?, ?)';

        $conexao->prepare($query)->execute([null, $cliente->getNome(), $cliente->getEmail(), $cliente->getDataNascimento(), $cliente->getEndereco(), $cliente->getSenha()]);
    }

    static function select() {
        $conexao = (new Conexao())->getConexao();
        $query = 'SELECT * FROM cliente';

        $clientes = $conexao->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $clientes;
    }

    static function delete($id) {
        $conexao = (new Conexao())->getConexao();
        $query = 'DELETE FROM cliente WHERE id = ?';

        $conexao->prepare($query)->execute([$id]);
    }

    static function update($campo, $novoValor, $id) {
        $conexao = (new Conexao())->getConexao();
        $query = "UPDATE cliente SET $campo=? WHERE id=?";

        $conexao->prepare($query)->execute([$novoValor, $id]);
    }
}