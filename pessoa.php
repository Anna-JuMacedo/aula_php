<?php
require 'conexao.php';
require 'pessoa.php';

class Pessoa {
    private $conexao;
    private $nome_tabela = "pessoas";
    
    public $id;
    public $nome;
    public $idade;

    public function __construct($conexao) {
        $this->$conexao = $conexao;
    }

    public function criar() {
        $sql = "INSERT INTO pessoas (nome, idade) VALUES (:nome, :idade)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        return $stmt->execute();
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM pessoas WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar() {
        $sql = "UPDATE pessoas SET nome = :nome, idade = :idade WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>
