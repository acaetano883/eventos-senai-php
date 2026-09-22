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

<html>

<head>
    <title>Editar evento</title>
</head>

<body>

<h1>Editar evento</h1>

<form method="POST">

    <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">

    <p>
        Título:
        <input type="text" name="titulo" required
        value="<?php echo $evento['titulo']; ?>">
    </p>

    <p>
        Descrição:
        <input type="text" name="descricao" required
        value="<?php echo $evento['descricao']; ?>">
    </p>

    <p>
        Área:
        <input type="text" name="area" required
        value="<?php echo $evento['area']; ?>">
    </p>

    <p>
        Data:
        <input type="date" name="data" required
        value="<?php echo $evento['data']; ?>">
    </p>

    <p>
        Início:
        <input type="time" name="inicio" required
        value="<?php echo $evento['inicio']; ?>">
    </p>

    <p>
        Fim:
        <input type="time" name="fim" required
        value="<?php echo $evento['fim']; ?>">
    </p>

    <p>
        Local:
        <input type="text" name="local" required
        value="<?php echo $evento['local']; ?>">
    </p>

    <p>
        Responsável:
        <input type="text" name="responsavel" required
        value="<?php echo $evento['responsavel']; ?>">
    </p>

    <input type="submit" value="Salvar alterações">

</form>

<a href="index.php">Voltar</a>

</body>

</html>