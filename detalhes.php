<?php
require_once('init.php');

$eventoId = $_GET['id'] ?? null;
$evento = ($eventoId !== null && isset($_SESSION['eventos'][$eventoId])) 
    ? $_SESSION['eventos'][$eventoId] 
    : null;

$mensagem = '';

// Lógica de inscrição rápida na página de detalhes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $evento) {
    $nome = ($_POST['nome'] ?? '');
    $email = ($_POST['email'] ?? '');
    
    $statusEvento = $evento['status'] ?? 'ativo';
    $totalInscritos = count($evento['inscritos'] ?? []);
    $vagasTotais = (int) ($evento['vagas'] ?? 0);

    if ($statusEvento === 'cancelado') {
        $mensagem = "Erro: Este evento está cancelado e não aceita inscrições.";
    } elseif ($totalInscritos >= $vagasTotais) {
        $mensagem = "Erro: Este evento já está lotado.";
    } elseif (empty($nome) || empty($email)) {
        $mensagem = "Erro: Preencha todos os campos da inscrição.";
    } else {
        // Validação de e-mail duplicado
        $duplicado = false;
        foreach ($evento['inscritos'] as $inscrito) {
            if ($inscrito['email'] === $email) {
                $duplicado = true;
                break;
            }
        }

        if ($duplicado) {
            $mensagem = "Erro: Este e-mail já está inscrito neste evento.";
        } else {
            $_SESSION['eventos'][$eventoId]['inscritos'][] = [
                'nome' => $nome,
                'email' => $email
            ];
            $evento = $_SESSION['eventos'][$eventoId]; // Atualiza variável local
            $mensagem = "Inscrição realizada com sucesso!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
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
        <p>Status: <strong><?= ucfirst(htmlspecialchars($evento["status"] ?? 'ativo')) ?></strong></p>
        <p>Vagas Totais: <?= (int)($evento["vagas"] ?? 0) ?> | Vagas Disponíveis: <?= ((int)($evento["vagas"] ?? 0) - count($evento["inscritos"] ?? [])) ?></p>

        <hr>
        <h4>Inscritos neste evento:</h4>
        <?php if (empty($evento["inscritos"])): ?>
            <p>Nenhum inscrito ainda.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($evento["inscritos"] as $inscrito): ?>
                    <li><?= htmlspecialchars($inscrito['nome']) ?> (<?= htmlspecialchars($inscrito['email']) ?>)</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (($evento['status'] ?? 'ativo') === 'ativo'): ?>
            <hr>
            <h4>Inscrever-se</h4>
            <?php if (!empty($mensagem)): ?>
                <p style="color: red;"><?= htmlspecialchars($mensagem) ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="nome" placeholder="Seu Nome" required><br><br>
                <input type="email" name="email" placeholder="Seu E-mail" required><br><br>
                <button type="submit">Inscrever</button>
            </form>
        <?php else: ?>
            <p style="color: red;"><strong>Inscrições encerradas (Evento Cancelado).</strong></p>
        <?php endif; ?>

    <?php else: ?>
        <p>Evento não encontrado.</p>
    <?php endif; ?>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>