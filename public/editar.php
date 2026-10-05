<?php
require_once "../config/conexao.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = (int) $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST['nome']);
    $categoria = trim($_POST['categoria']);
    $faixa_etaria = trim($_POST['faixa_etaria']);
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    if (
        empty($nome) ||
        empty($categoria) ||
        empty($faixa_etaria) ||
        $preco === "" ||
        $quantidade === ""
    ) {
        die("Preencha todos os campos.");
    }

    $sql = "UPDATE brinquedos 
            SET nome = ?, categoria = ?, faixa_etaria = ?, preco = ?, quantidade = ?
            WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar a atualização: " . $conexao->error);
    }

    $stmt->bind_param(
        "sssdis",
        $nome,
        $categoria,
        $faixa_etaria,
        $preco,
        $quantidade,
        $id
    );

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        die("Erro ao atualizar brinquedo: " . $stmt->error);
    }
}

$sql = "SELECT * FROM brinquedos WHERE id = ?";
$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro ao buscar brinquedo: " . $conexao->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Brinquedo não encontrado.");
}

$brinquedo = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Brinquedo</title>
</head>

<body>

    <h1>Editar Brinquedo</h1>

    <form method="POST">

        <label>Nome:</label><br>
        <input type="text" name="nome"
               value="<?= htmlspecialchars($brinquedo['nome']) ?>"
               required>

        <br><br>

        <label>Categoria:</label><br>
        <input type="text" name="categoria"
               value="<?= htmlspecialchars($brinquedo['categoria']) ?>"
               required>

        <br><br>

        <label>Faixa Etária:</label><br>
        <input type="text" name="faixa_etaria"
               value="<?= htmlspecialchars($brinquedo['faixa_etaria']) ?>"
               required>

        <br><br>

        <label>Preço:</label><br>
        <input type="number" name="preco"
               step="0.01"
               value="<?= $brinquedo['preco'] ?>"
               required>

        <br><br>

        <label>Quantidade:</label><br>
        <input type="number" name="quantidade"
               min="0"
               value="<?= $brinquedo['quantidade'] ?>"
               required>

        <br><br>

        <button type="submit">Salvar alterações</button>

    </form>

    <br>

    <a href="index.php">Voltar para a lista</a>

</body>
</html>