<?php
session_start();
$eventos = $_SESSION['eventos'] ?? [];

// Filtros
$buscaTitulo = $_GET['titulo'] ?? '';
$filtraArea = $_GET['area'] ?? '';
$filtraData = $_GET['data'] ?? '';

$eventosFiltrados = array($eventos, function($evento) use ($buscaTitulo, $filtraArea, $filtraData) {
    $matchTitulo = empty($buscaTitulo) || stripos($evento['titulo'], $buscaTitulo) !== false;
    $matchArea = empty($filtraArea) || $evento['area'] === $filtraArea;
    $matchData = empty($filtraData) || $evento['data'] === $filtraData;

    return $matchTitulo && $matchArea && $matchData;
});
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Eventos</title>
</head>
<body>      
    <h1>Eventos</h1>
    <h4><a href="cadastro.php">Cadastrar Novo Evento</a></h4>

    <!-- Formulário de Busca e Filtros -->
    <form method="GET" action="index.php">
        <input type="text" name="titulo" placeholder="Buscar por título..." value="<?= htmlspecialchars($buscaTitulo) ?>">
        <input type="text" name="area" placeholder="Filtrar por área..." value="<?= htmlspecialchars($filtraArea) ?>">
        <input type="date" name="data" value="<?= htmlspecialchars($filtraData) ?>">
        <button type="submit">Filtrar</button>
        <a href="index.php">Limpar</a>
    </form>
    <br>

    <?php if (empty($eventosFiltrados)): ?>
        <p>Nenhum evento encontrado com os critérios informados.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($eventosFiltrados as $index => $evento): ?>
                <li>
                    <strong><?= htmlspecialchars($evento['titulo'] ?? '') ?></strong> 
                    (Área: <?= htmlspecialchars($evento['area']) ?> | Data: <?= htmlspecialchars($evento['data']) ?> | Status: <strong><?= ucfirst($evento['status'] ?? 'ativo') ?></strong>)
                    <br>
                    <a href="detalhes.php?id=<?= $index ?>">detalhes / inscrições</a> | 
                    <a href="edicao.php?id=<?= $index ?>">editar</a> | 
                    <a href="status.php?id=<?= $index ?>"><?= (($evento['status'] ?? 'ativo') === 'ativo') ? 'Cancelar' : 'Reativar' ?></a> | 
                    <a href="remocao.php?id=<?= $index ?>" onclick="return confirm('Tem certeza que deseja remover?');">Remover</a>
                </li>
                <br>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>