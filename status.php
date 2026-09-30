<?php
session_start();
$id = $_GET['id'] ?? null;

if ($id !== null && isset($_SESSION['eventos'][$id])) {
    $statusAtual = $_SESSION['eventos'][$id]['status'] ?? 'ativo';
    $_SESSION['eventos'][$id]['status'] = ($statusAtual === 'ativo') ? 'cancelado' : 'ativo';
}

header("Location: index.php");
exit;