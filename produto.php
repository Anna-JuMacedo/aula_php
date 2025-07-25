<?php

require_once 'conexao.php';

class Produto {
    private $conexao;
    private $tabela = "produtos";

    public $id;
    public $nome;
    public $preco;

    public function __construct($db) {
        $this->conexao = $db;
    }

    public function criar() {
        $sql = "INSERT INTO {$this->tabela} (nome, preco) VALUES (:nome, :preco)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':preco', $this->preco);
        return $stmt->execute();
    }

    public function lerTodos() {
        $sql = "SELECT * FROM {$this->tabela}";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM {$this->tabela} WHERE id = :id LIMIT 1";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar() {
        $sql = "UPDATE {$this->tabela} SET nome = :nome, preco = :preco WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
