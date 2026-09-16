<?php
session_start();
$eventos = $_SESSION['eventos'] ?? [];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
</head>
<body>      
    <h1>Eventos</h1>
    <h4><a href="cadastro.php">Cadastrar Novo Evento</a></h4>
    <?php if (empty($eventos)): ?>
        <p>Nenhum evento encontrado.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($eventos as $index => $evento): ?>
                <li>
                    <span style="<?= !empty($evento['concluido']) ? 'text-decoration: line-through;' : '' ?>">
                        <?= htmlspecialchars($evento['titulo'] ?? '') ?>
                    </span>
                    <a href="detalhes.php?id=<?= $index ?>">detalhes</a>
                    <a href="edicao.php?id=<?= $index ?>">editar</a>
                    <a href="remocao.php?id=<?= $index ?>">Remover</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>