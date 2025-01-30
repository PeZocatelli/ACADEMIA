<?php
require_once 'db_connection_academia.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];

    try {
        $stmt = $conn->prepare("UPDATE instrutores SET nome = :nome, especialidade = :especialidade WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':especialidade', $especialidade);
        $stmt->execute();
        header('Location: listar_instrutores.php?status=updated');
        exit;
    } catch (PDOException $e) {
        echo "Erro ao atualizar instrutor: " . $e->getMessage();
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM instrutores WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $instrutor = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Instrutor</title>
</head>
<body>
    <h1>Editar Instrutor</h1>
    <form action="editar_instrutor.php" method="POST">
        <input type="hidden" name="id" value="<?= $instrutor['id']; ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($instrutor['nome']); ?>" required><br>
        <label>Especialidade:</label>
        <input type="text" name="especialidade" value="<?= htmlspecialchars($instrutor['especialidade']); ?>" required><br>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
