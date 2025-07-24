<?php
require_once 'conexao.php';
require_once 'produto.php';

if ($conexao) 
if (!isset($_GET['id'])) {
    die("<p class='error'>Erro: Produto não especificado.</p>");
}

$id = $_GET['id'];
$produto = new Produto($conexao);
$dados = $produto->buscarPorId($id);

if (!$dados) {
    die("<p class='error'>Erro: Produto não encontrado.</p>");
}

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto->id = $id;
    $produto->nome = $_POST['nome'];
    $produto->preco = $_POST['preco'];

    if ($produto->editar()) {
        echo "<p class='success'>Produto atualizado com sucesso!</p>";
        $dados = $produto->buscarPorId($id); // atualiza dados exibidos
    } else {
        echo "<p class='error'>Erro ao atualizar o produto.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Editar Produto</h1>
    </header>

    <section>
        <form method="POST">
            <label for="nome">Nome:</label><br>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($dados['nome']); ?>" required><br><br>

            <label for="preco">Preço:</label><br>
            <input type="number" step="any" name="preco" id="preco" value="<?php echo htmlspecialchars($dados['preco']); ?>" required><br><br>

            <input type="submit" value="Salvar Alterações">
        </form>

        <br>
        <a href="listar.php">← Voltar para a lista</a>
    </section>
</body>
</html>
