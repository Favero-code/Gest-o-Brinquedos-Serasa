<?php
require_once "../config/conexao.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}
$id = (int) $_GET['id'];

$sql = "DELETE FROM brinquedos WHERE id = ?";

$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar a exclusão: " . $conexao->error);
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    die("Erro ao excluir brinquedo: " . $stmt->error);
}
?>