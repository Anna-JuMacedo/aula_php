<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Cadastro de Pessoas</h1>
        </header>
        <section>
            <?php
            require_once 'conexao.php';
            require_once 'pessoa.php';

            $messagem ='';
            $cadastroSucesso = false;

            $database = new BancoDeDados();
            $db = $database->obterConexao();

            if ($db === null) {
                $messagem = "Erro: Não foi possível conectar ao banco de dados.";
            } else {
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $pessoa = new Pessoa($db);
                    $pessoa->nome = $_POST['nome'];
                    $pessoa->idade = $_POST['idade'];

                    if ($pessoa->criar()) {
                        $messagem = "Pessoa ' {$pessoa->nome}' cadastrada com sucesso!";
                        $cadastroSucesso = true;
                    } else {
                        $messagem = "Falha ao cadastrar a pessoa.";
                    }
                }
            }
            ?>

            <form action="" method="post" id="formCadastroPessoa"> <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" required>
                <input type="submit" value="Cadastrar">
            </form>
        </section>
    </div>
    <script>
        const mensagemDoPHP = "<?php echo $messagem; ?>";
        const cadastroFoiSucesso = <?php echo json_encode($cadastroSucesso); ?>;

        if (mensagemDoPHP) {
            alert(mensagemDoPHP);

            if (cadastroFoiSucesso) {
                document.getElementById('name').value = '';
                document.getElementById('idade').value = '';

                document.getElementById('nome').focus();
            }
        }
    </script>
</body>

</html>