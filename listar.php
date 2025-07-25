<?php
       require_once 'conexao.php';
       require_once 'pessoa.php';
       require_once 'produto.php';

       $banco = new BancoDeDados();
       $db = $banco->obterConexao();
           try {
               $sql = "SELECT * FROM pessoas";
               $stmtPessoas = $con->query($sql);
       
               if ($stmtPessoas && $stmtPessoas->rowCount() > 0) {
                   foreach ($stmtPessoas as $pessoa) {
                       echo "Nome: " . htmlspecialchars($pessoa['nome']) . "<br>";
                   }
               } else {
                   echo "<p>Nenhuma pessoa cadastrada.</p>";
               }
       
           } catch (PDOException $e) {
               echo "<p class='error'>Erro ao executar a consulta: " . $e->getMessage() . "</p>";
           }
           
        $pessoas = new Pessoa($db);
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

        $produto = new Produto($db);
        $stmtProdutos = $produto->lerTodos();

        if ($stmtProdutos->rowCount() > 0) {
            while ($linha = $stmtProdutos->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='product'>";
                echo "<p><strong>ID:</strong> " . $linha['id'] . "</p>";
                echo "<p><strong>Nome:</strong> " . $linha['nome'] . "</p>";
                echo "<p><strong>Preço:</strong> R$ " . number_format($linha['preco'], 2, ',', '.') . "</p>";
                echo "<p><a href='editar.php?tipo=produto&id=" . $linha['id'] . "'>Editar Produto</a></p>";
                echo "</div>";
            }
        } else {
            echo "<p class='error'>Nenhum produto encontrado.</p>";
        }
        ?>

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

    </section>
</body>
</html>
