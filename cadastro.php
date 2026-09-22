<?php
require_once 'init.php';

// Garante que a chave proximo_id existe na sessão
if (!isset($_SESSION["proximo_id"])) {
    $_SESSION["proximo_id"] = 1;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Verifica se TODOS os campos obrigatórios foram enviados
    if (
        isset($_POST["titulo"]) &&
        isset($_POST["descricao"]) &&
        isset($_POST["area"]) &&
        isset($_POST["data"]) &&
        isset($_POST["inicio"]) &&
        isset($_POST["fim"]) &&
        isset($_POST["local"]) &&
        isset($_POST["responsavel"])
    ) {

        $id = $_SESSION["proximo_id"];

        $_SESSION["eventos"][$id] = [
            "id"          => $id,
            "titulo"      => $_POST["titulo"],
            "descricao"   => $_POST["descricao"],
            "area"        => $_POST["area"],
            "data"        => $_POST["data"],
            "inicio"      => $_POST["inicio"],
            "fim"         => $_POST["fim"],
            "local"       => $_POST["local"],
            "responsavel" => $_POST["responsavel"]
        ];

        $_SESSION["proximo_id"]++;

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>

<body>

<h1>Cadastro de Evento</h1>

<form method="POST" action="cadastro.php">

    <input type="text" name="titulo" placeholder="Título" required>
    <br><br>

    <input type="text" name="descricao" placeholder="Descrição" required>
    <br><br>

    <input type="text" name="area" placeholder="Área" required>
    <br><br>

    <input type="date" name="data" required>
    <br><br>

    <input type="time" name="inicio" required>
    <br><br>

    <input type="time" name="fim" required>
    <br><br>

    <input type="text" name="local" placeholder="Local" required>
    <br><br>

    <input type="text" name="responsavel" placeholder="Responsável" required>
    <br><br>

    <button type="submit">Cadastrar</button>

</form>

</body>
</html>