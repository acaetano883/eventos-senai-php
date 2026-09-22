<?php
require_once('init.php');

$eventoId = $_GET['id'] ?? null;
$evento = ($eventoId !== null && isset($_SESSION['eventos'][$eventoId])) 
    ? $_SESSION['eventos'][$eventoId] 
    : null;
?>
<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Evento</title>
</head>
<body>
    <?php if ($evento): ?>
        <h3><?= htmlspecialchars($evento["titulo"] ?? '') ?></h3>
        <p><?= htmlspecialchars($evento["descricao"] ?? '') ?></p>
        <p>Área: <?= htmlspecialchars($evento["area"] ?? '') ?></p>
        <p>Data: <?= htmlspecialchars($evento["data"] ?? '') ?></p>
        <p>Início: <?= htmlspecialchars($evento["inicio"] ?? '') ?></p>
        <p>Fim: <?= htmlspecialchars($evento["fim"] ?? '') ?></p>
        <p>Local: <?= htmlspecialchars($evento["local"] ?? '') ?></p>
        <p>Responsável: <?= htmlspecialchars($evento["responsavel"] ?? '') ?></p>
    <?php else: ?>
        <p>Evento não encontrado.</p>
    <?php endif; ?>
    <a href="index.php">Voltar</a>
</body>
</html>

