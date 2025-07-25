<?php
require_once 'conexao.php';
require_once 'pessoa.php';

$banco = new BancoDeDados();
$db = $banco->obterConexao();
$id = $_GET['id'];
$pessoa = new Pessoa($db);
$dados = $pessoa->buscarPorId($id);


if (!$dados) {
    die("<p class='error'>Pessoa não encontrada.</p>");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pessoa->id = $id;
    $pessoa->nome = $_POST['nome'];
    $pessoa->idade = $_POST['idade'];

    if ($pessoa->editar()) {
        echo "<p class='success'>Pessoa atualizada com sucesso!</p>";
        $dados = $pessoa->buscarPorId($id); // Atualiza os dados
    } else {
        echo "<p class='error'>Erro ao atualizar a pessoa.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Pessoas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar</h1>
        </header>
        <section>
            <form action="" method="post" id="formCadastroPessoa">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" required>
                <input type="submit" value="Cadastrar">
            </form>
        </section>
    </div>
</body>
</html>

