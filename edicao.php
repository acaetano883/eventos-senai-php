<?php

require_once 'init.php';

$id = $_GET['id'];

if (!isset($_SESSION['eventos'][$id])) {
    header('Location: index.php');
    exit;
}

$evento = $_SESSION['eventos'][$id];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];

    if (!isset($_SESSION['eventos'][$id])) {
        header('Location: index.php');
        exit;
    }

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $area = $_POST['area'];
    $data = $_POST['data'];
    $inicio = $_POST['inicio'];
    $fim = $_POST['fim'];
    $local = $_POST['local'];
    $responsavel = $_POST['responsavel'];

    if ($fim <= $inicio) {

        echo "O horário final deve ser maior que o horário inicial.";

    } else {

        $_SESSION['eventos'][$id] = [
            'id' => $id,
            'titulo' => $titulo,
            'descricao' => $descricao,
            'area' => $area,
            'data' => $data,
            'inicio' => $inicio,
            'fim' => $fim,
            'local' => $local,
            'responsavel' => $responsavel
        ];

        header('Location: index.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
</head>

<body>

    <h1>Editar Evento</h1>

    <form method="POST">

        <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">

        <label>Título:</label>
        <input type="text" name="titulo" value="<?php echo $evento['titulo']; ?>">
        <br><br>

        <label>Descrição:</label>
        <textarea name="descricao"><?php echo $evento['descricao']; ?></textarea>
        <br><br>

        <label>Área:</label>
        <input type="text" name="area" value="<?php echo $evento['area']; ?>">
        <br><br>

        <label>Data:</label>
        <input type="date" name="data" value="<?php echo $evento['data']; ?>">
        <br><br>

        <label>Início:</label>
        <input type="time" name="inicio" value="<?php echo $evento['inicio']; ?>">
        <br><br>

        <label>Fim:</label>
        <input type="time" name="fim" value="<?php echo $evento['fim']; ?>">
        <br><br>

        <label>Local:</label>
        <input type="text" name="local" value="<?php echo $evento['local']; ?>">
        <br><br>

        <label>Responsável:</label>
        <input type="text" name="responsavel" value="<?php echo $evento['responsavel']; ?>">
        <br><br>

        <button type="submit">Salvar</button>

    </form>

    <br>

    <a href="index.php">Voltar</a>

</body>

</html>