<?php

require_once "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $faixa_etaria = $_POST["faixa_etaria"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];

    if (
    empty($nome) ||
    empty($categoria) ||
    empty($faixa_etaria) ||
    empty($preco) ||
    empty($quantidade)
) {
    die("Preencha todos os campos.");
}

    $sql = "INSERT INTO brinquedos 
            (nome, categoria, faixa_etaria, preco, quantidade)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro no SQL: " . $conexao->error);
}

    $stmt->bind_param(
        "sssdi",
        $nome,
        $categoria,
        $faixa_etaria,
        $preco,
        $quantidade
    );

    if ($stmt->execute()) {
        echo "Brinquedo cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
}
?>

<h1>Cadastrar Brinquedo</h1>

<form method="POST">

    Nome:
    <input type="text" name="nome" required>
    <br><br>

    Categoria:
    <input type="text" name="categoria" required>
    <br><br>

    Faixa etária:
    <input type="text" name="faixa_etaria" required>
    <br><br>

    Preço:
    <input type="number" name="preco" step="0.01" required>
    <br><br>

    Quantidade:
    <input type="number" name="quantidade" required>
    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<br>

<a href="index.php">Ver brinquedos cadastrados</a>

