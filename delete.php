<?php
// delete.php
require_once 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

// perform deletion securely
$stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
$stmt->execute([':id' => $id]);

header('Location: index.php');
exit;
