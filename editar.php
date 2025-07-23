<?php
require_once 'conexao.php';
require_once 'pessoa.php';

$banco = new BancoDeDados();
$conexao = $banco->obterConexao();

if (!$conexao) {
    die("<p class='error'>Erro ao conectar com o banco de dados.</p>");
}

if (!isset($_GET['id'])) {
    die("<p class='error'>Erro: Pessoa não especificada.</p>");
}

$id = $_GET['id'];
$pessoa = new Pessoa($conexao);
$dados = $pessoa->buscarPorId($id);

if (!$dados) {
    die("<p class='error'>Pessoa não encontrada.</p>");
}

// Se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pessoa->id = $id;
    $pessoa->nome = $_POST['nome'];
    $pessoa->idade = $_POST['idade'];

    if ($pessoa->editar()) {
        echo "<p class='success'>Pessoa atualizada com sucesso!</p>";
        $dados = $pessoa->buscarPorId($id); // atualiza os dados
    } else {
        echo "<p class='error'>Erro ao atualizar a pessoa.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Pessoa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Editar Pessoa</h1>
    </header>

    <section>
        <form method="POST">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($dados['nome']); ?>" required><br><br>

            <label for="idade">Idade:</label><br>
            <input type="number" id="idade" name="idade" value="<?php echo htmlspecialchars($dados['idade']); ?>" required><br><br>

            <input type="submit" value="Salvar Alterações">
        </form>

        <br>
        <a href="listar.php">← Voltar para a lista</a>
    </section>
</body>
</html>
