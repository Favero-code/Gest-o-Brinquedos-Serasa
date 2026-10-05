<?php
require_once "../config/conexao.php";

$sql = "SELECT * FROM brinquedos";
$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro ao buscar brinquedos: " . $conexao->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Brinquedos</title>
</head>

<body>

    <h1>Gestão de Brinquedos</h1>

    <a href="cadastro.php">Cadastrar novo brinquedo</a>

    <br><br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Faixa Etária</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

            <?php while ($brinquedo = $resultado->fetch_assoc()): ?>

                <tr>
                    <td><?= $brinquedo['id'] ?></td>
                    <td><?= htmlspecialchars($brinquedo['nome']) ?></td>
                    <td><?= htmlspecialchars($brinquedo['categoria']) ?></td>
                    <td><?= htmlspecialchars($brinquedo['faixa_etaria']) ?></td>
                    <td>R$ <?= number_format($brinquedo['preco'], 2, ',', '.') ?></td>
                    <td><?= $brinquedo['quantidade'] ?></td>

                    <td>
                        <a href="editar.php?id=<?= $brinquedo['id'] ?>">Editar</a>
                        |
                        <a href="excluir.php?id=<?= $brinquedo['id'] ?>">Excluir</a>
                    </td>
                </tr>

            <?php endwhile; ?>

        </tbody>
    </table>

</body>
</html>