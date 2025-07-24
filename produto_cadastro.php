<?php
require_once 'conexao.php';
require_once 'produto.php';

    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = new Produto($conexao);
    $produto->nome = $_POST['nome'];

    $produto->preco = $_POST['preco'];

    if ($produto->criar()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o produto.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="style.css">
    <header>
        <h1>Cadastro</h1>
    </header>
    <section>
        <form method="POST">
            <label for="nome">Nome:<input type="text" name="nome" required><br></label><br>
            <label for="preco">Preço:
            <input type="number" name="preco" step="any" required>
            </label><br>
            <input type="submit" value="Cadastrar">
    
        </form>

</form>
