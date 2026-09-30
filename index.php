<?php
require_once 'init.php';
$eventos = $_SESSION['eventos'] ?? [];
$busca = trim($_GET['busca'] ?? '');
$areaFiltro = trim($_GET['area'] ?? '');
$dataFiltro = trim($_GET['data'] ?? '');
$areas = array_values(array_unique(array_filter(array_map(fn($e) => $e['area'] ?? '', $eventos))));
sort($areas, SORT_NATURAL | SORT_FLAG_CASE);
$filtrados = array_filter($eventos, function ($evento) use ($busca, $areaFiltro, $dataFiltro) {
    return ($busca === '' || stripos($evento['titulo'] ?? '', $busca) !== false)
        && ($areaFiltro === '' || ($evento['area'] ?? '') === $areaFiltro)
        && ($dataFiltro === '' || ($evento['data'] ?? '') === $dataFiltro);
});
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Eventos</title></head>
<body>
<h1>Eventos</h1>
<p><a href="cadastro.php">Cadastrar Novo Evento</a></p>
<form method="GET" action="index.php">
  <label>Buscar título: <input type="search" name="busca" value="<?= htmlspecialchars($busca, ENT_QUOTES, 'UTF-8') ?>" placeholder="Título do evento"></label>
  <label>Área: <select name="area"><option value="">Todas as áreas</option>
    <?php foreach ($areas as $area): ?><option value="<?= htmlspecialchars($area, ENT_QUOTES, 'UTF-8') ?>" <?= $areaFiltro === $area ? 'selected' : '' ?>><?= htmlspecialchars($area, ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?>
  </select></label>
  <label>Data: <input type="date" name="data" value="<?= htmlspecialchars($dataFiltro, ENT_QUOTES, 'UTF-8') ?>"></label>
  <button type="submit">Filtrar</button> <a href="index.php">Limpar filtros</a>
</form>
<?php if (!$filtrados): ?>
  <p>Nenhum evento corresponde aos critérios informados.</p>
<?php else: ?>
<ul>
<?php foreach ($filtrados as $id => $evento): ?>
<li>
  <strong><?= htmlspecialchars($evento['titulo'] ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
  — <?= htmlspecialchars($evento['area'] ?? '', ENT_QUOTES, 'UTF-8') ?> — <?= htmlspecialchars($evento['data'] ?? '', ENT_QUOTES, 'UTF-8') ?>
  <a href="detalhes.php?id=<?= urlencode((string)$id) ?>">detalhes</a>
  <a href="edicao.php?id=<?= urlencode((string)$id) ?>">editar</a>
  <a href="remocao.php?id=<?= urlencode((string)$id) ?>">Remover</a>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</body></html>
