<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pessoas e Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Lista de Pessoas e Produtos Cadastrados</h1>
    </header>

    <section>
        <h2>Pessoas</h2>
        <?php
        require_once 'conexao.php';
        require_once 'pessoa.php';
        require_once 'produto.php';

        $database = new BancoDeDados();
        $db = $database->obterConexao();

        if ($db === null) {
            die("<p class='error'>Erro: Não foi possível conectar ao banco de dados.</p>");
        }

        // Listar Pessoas
        $pessoa = new Pessoa($db);
        $stmtPessoas = $pessoa->ler();

        if ($stmtPessoas->rowCount() > 0) {
            while ($linha = $stmtPessoas->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='person'>";
                echo "<p><strong>ID:</strong> " . $linha['id'] . "</p>";
                echo "<p><strong>Nome:</strong> " . $linha['nome'] . "</p>";
                echo "<p><strong>Idade:</strong> " . $linha['idade'] . "</p>";
                echo "<p><a href='editar.php?tipo=pessoa&id=" . $linha['id'] . "'>Editar Pessoa</a></p>";
                echo "</div>";
            }
        } else {
            echo "<p class='error'>Nenhuma pessoa encontrada.</p>";
        }
        ?>
    </section>

    <section>
        <h2>Produtos</h2>
        <?php
        // Listar Produtos
        $produto = new Produto($db);
        $stmtProdutos = $produto->lerTodos();

        if ($stmtProdutos->rowCount() > 0) {
            while ($linha = $stmtProdutos->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='product'>";
                echo "<p><strong>ID:</strong> " . $linha['id'] . "</p>";
                echo "<p><strong>Nome:</strong> " . $linha['nome'] . "</p>";
                echo "<p><strong>Descrição:</strong> " . $linha['descricao'] . "</p>";
                echo "<p><strong>Preço:</strong> R$ " . number_format($linha['preco'], 2, ',', '.') . "</p>";
                echo "<p><a href='editar.php?tipo=produto&id=" . $linha['id'] . "'>Editar Produto</a></p>";
                echo "</div>";
            }
        } else {
            echo "<p class='error'>Nenhum produto encontrado.</p>";
        }
        ?>
    </section>
</body>
</html>
