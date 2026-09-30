<?php

require_once 'init.php';

$id = $_GET['id'];

if (!isset($_SESSION['eventos'][$id])) {
    header('Location: index.php');
    exit;
}

$evento = $_SESSION['eventos'][$id];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $capacidade = $_POST['capacidade'];

    if (!filter_var($capacidade, FILTER_VALIDATE_INT) || $capacidade <= 0) {

        $erro = "A capacidade deve ser um número inteiro positivo.";

    } else {

        $quantidadeInscritos = count($evento['inscritos']);

        if ($capacidade < $quantidadeInscritos) {

            $erro = "A capacidade não pode ser menor que a quantidade de inscritos.";

        } else {

            $_SESSION['eventos'][$id]['capacidade'] = $capacidade;

            $evento['capacidade'] = $capacidade;

            $mensagem = "Capacidade atualizada com sucesso.";
        }
    }
}

$quantidadeInscritos = count($evento['inscritos']);

$vagasDisponiveis = $evento['capacidade'] - $quantidadeInscritos;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Controle de Vagas</title>
</head>

<body>

    <h1>Controle de Vagas</h1>

    <h2><?php echo $evento['titulo']; ?></h2>

    <?php if (isset($erro)) { ?>

        <p><?php echo $erro; ?></p>

    <?php } ?>

    <?php if (isset($mensagem)) { ?>

        <p><?php echo $mensagem; ?></p>

    <?php } ?>

    <p>
        Capacidade:
        <?php echo $evento['capacidade']; ?>
    </p>

    <p>
        Inscritos:
        <?php echo $quantidadeInscritos; ?>
    </p>

    <p>
        Vagas disponíveis:
        <?php echo $vagasDisponiveis; ?>
    </p>

    <?php if ($vagasDisponiveis <= 0) { ?>

        <p>Este evento está lotado.</p>

    <?php } else { ?>

        <p>Ainda existem vagas disponíveis.</p>

    <?php } ?>

    <h3>Alterar capacidade</h3>

    <form method="POST">

        <label>Capacidade:</label>

        <br>

        <input
            type="number"
            name="capacidade"
            min="1"
            value="<?php echo $evento['capacidade']; ?>"
            required
        >

        <br><br>

        <button type="submit">
            Salvar capacidade
        </button>

    </form>

    <br>

    <a href="index.php">Voltar</a>

</body>

</html>