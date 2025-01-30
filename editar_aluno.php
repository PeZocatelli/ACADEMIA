<?php
require_once 'db_connection_academia.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    try {
        $stmt = $conn->prepare("UPDATE alunos SET nome = :nome, endereco = :endereco, telefone = :telefone WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();
        header('Location: listar_alunos.php?status=updated');
        exit;
    } catch (PDOException $e) {
        echo "Erro ao atualizar aluno: " . $e->getMessage();
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM alunos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
</head>
<body>
    <h1>Editar Aluno</h1>
    <form action="editar_aluno.php" method="POST">
        <input type="hidden" name="id" value="<?= $aluno['id']; ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($aluno['nome']); ?>" required><br>
        <label>Endereço:</label>
        <input type="text" name="endereco" value="<?= htmlspecialchars($aluno['endereco']); ?>" required><br>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($aluno['telefone']); ?>" required><br>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
