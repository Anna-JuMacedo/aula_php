<?php
require_once 'conexao.php';
require_once 'produto.php';

$banco = new BancoDeDados();
$conexao = $banco->obterConexao();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = new Produto($conexao);
    $produto->nome = $_POST['nome'];
    $produto->descricao = $_POST['descricao'];
    $produto->preco = $_POST['preco'];

    if ($produto->criar()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o produto.";
    }
}
?>

<h2>Cadastrar Produto</h2>
<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    Descrição: <input type="text" name="descricao" required><br>
    Preço: <input type="number" name="preco" step="0.01" required><br>
    <input type="submit" value="Cadastrar">
</form>
