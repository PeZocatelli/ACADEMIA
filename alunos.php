<?php
require_once 'db_connection_academia.php';

try {
    $stmt = $conn->prepare("SELECT id, nome, cpf, telefone FROM alunos");
    $stmt->execute();
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar alunos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Alunos</title>
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
    <h1>Alunos Cadastrados</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['nome']); ?></td>
                    <td><?= htmlspecialchars($aluno['cpf']); ?></td>
                    <td><?= htmlspecialchars($aluno['telefone']); ?></td>
                    <td>
                        <a href="editar_aluno.php?id=<?= $aluno['id']; ?>"><button class="edit">Editar</button></a>
                        <a href="excluir_aluno.php?id=<?= $aluno['id']; ?>" onclick="return confirm('Deseja excluir este aluno?')"><button>Excluir</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
