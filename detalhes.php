<?php
require_once('init.php');
$eventoId = $_GET['id'];
$evento = $_SESSION['eventos'][$eventoId] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento Detalhe</title>
</head>
<body>
    <h3><?php print $evento["titulo"]; ?></h3>
    <p><?php print $evento["descricao"];?></p>
    <p>Área: <?php print $evento["area"]; ?></p>
    <p>Data: <?php print $evento["data"]; ?></p>
    <p>Início: <?php print $evento["inicio"]; ?></p>
    <p>Fim: <?php print $evento["fim"]; ?></p>
    <p>Local: <?php print $evento["local"]; ?></p>
    <p>Responsável: <?php print $evento["responsavel"]; ?></p>
</body>