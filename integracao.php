<?php
require_once 'conexao.php';
require_once 'pessoa.php';

$mensagem = "";
$cadastroSucesso = false;

if ($conexao) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pessoa = new Pessoa($conexao);
        $pessoa->nome = $_POST['nome'];
        $pessoa->idade = $_POST['idade'];

        if ($pessoa->criar()) {
            $mensagem = "Pessoa '{$pessoa->nome}' cadastrada com sucesso!";
            $cadastroSucesso = true;
        } else {
            $mensagem = "Falha ao cadastrar a pessoa.";
        }
    }

    $sql = "SELECT * FROM pessoas";
    $resultado = $conexao->query($sql);
} else {
    $mensagem = "Não foi possível conectar ao banco de dados.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pessoas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastro de Pessoas</h1>
        </header>
        <section>
            <form action="" method="post" id="formCadastroPessoa">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" required>
                <input type="submit" value="Cadastrar">
            </form>

            <h2>Pessoas Cadastradas:</h2>
            <?php
            if ($conexao && isset($resultado)) {
                foreach ($resultado as $linha) {
                    echo "Nome: " . htmlspecialchars($linha['nome']) . "<br>";
                }
            }
            ?>
        </section>
    </div>

    <script>
        const mensagemDoPHP = <?php echo json_encode($mensagem); ?>;
        const cadastroFoiSucesso = <?php echo json_encode($cadastroSucesso); ?>;

        if (mensagemDoPHP) {
            alert(mensagemDoPHP);

            if (cadastroFoiSucesso) {
                document.getElementById('nome').value = '';
                document.getElementById('idade').value = '';
                document.getElementById('id').focus();
            }
        }
    </script>
</body>

</html>
