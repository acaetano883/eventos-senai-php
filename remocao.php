<?php

$id = null;
$eventsoAtual = null;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Valida se o ID existe dentro do array na sessão
    if (isset($_SESSION["eventos"][$id])) {
        $eventoAtual = $_SESSION["eventos"][$id];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Validação de ID</title>
</head>
<body>
    <h2>Selecione um item para validar</h2>

    <!-- Lista de itens cadastrados na sessão -->
    <ul>
        <?php foreach ($_SESSION["eventos"] as $eventoChave => $evento): ?>
            <li>
                <a href="validar.php?id=<?= $eventoChave ?>">
                    <?= $evento["titulo"] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Fluxo condicional de exibição -->
    <?php if ($id === null || $eventoAtual === null): ?>
        <p>Nenhum ID selecionado ou ID inválido.</p>
    <?php else: ?>
        <h3>Confirmação de ID</h3>
        <form action="processar.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?= $eventoAtual["titulo"] ?>" disabled>
            <br>

            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" value="<?= $eventoAtual["descricao"] ?>" disabled>
            <br>

            <button type="submit">Confirmar / Enviar</button>
            <a href="validar.php">Cancelar / Limpar</a>
        </form>
    <?php endif; ?>
</body>
</html>
