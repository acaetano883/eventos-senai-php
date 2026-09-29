<?php
session_start();
$id = $_GET['id'] ?? null;

if ($id !== null && isset($_SESSION['eventos'][$id])) {
    unset($_SESSION['eventos'][$id]);
}

header("Location: index.php");
exit;