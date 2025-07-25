<?php
require_once 'conexao.php'; // onde está a classe BancoDeDados
require_once 'produto.php'; // sua classe Produto

$banco = new BancoDeDados();
$db = $banco->obterConexao();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($db) {
        $produto = new Produto($db);
        $produto->nome = $_POST['nome'];
        $produto->preco = $_POST['preco'];
        $produto->criar();
    } else {
        echo "Erro: conexão com o banco falhou.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Cadastro</h1>
    </header>
    <section>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required><br><br>

            <label for="preco">Preço:</label>
            <input type="number" name="preco" step="any" required><br><br>

            <input type="submit" value="Cadastrar">
        </form>
    </section>
</body>
</html>
