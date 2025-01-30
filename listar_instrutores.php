<?php
require_once 'db_connection_academia.php';

try {
    $stmt = $conn->prepare("SELECT id, nome, especialidade FROM instrutores");
    $stmt->execute();
    $instrutores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar instrutores: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Instrutores</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        button {
            padding: 5px 10px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }
        button.edit {
            background-color: blue;
        }
    </style>
</head>
<body>
    <h1>Instrutores Cadastrados</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($instrutores as $instrutor): ?>
                <tr>
                    <td><?= htmlspecialchars($instrutor['nome']); ?></td>
                    <td><?= htmlspecialchars($instrutor['especialidade']); ?></td>
                    <td>
                        <a href="editar_instrutor.php?id=<?= $instrutor['id']; ?>"><button class="edit">Editar</button></a>
                        <a href="excluir_instrutor.php?id=<?= $instrutor['id']; ?>" onclick="return confirm('Deseja excluir este instrutor?')"><button>Excluir</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
