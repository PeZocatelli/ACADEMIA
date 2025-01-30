<?php
require_once 'db_connection_academia.php';

try {
    $stmt = $conn->prepare("
        SELECT 
            aulas.id, 
            aulas.tipo, 
            aulas.data, 
            instrutores.nome AS instrutor, 
            alunos.nome AS aluno 
        FROM aulas
        JOIN instrutores ON aulas.instrutor_id = instrutores.id
        JOIN alunos ON aulas.aluno_id = alunos.id
    ");
    $stmt->execute();
    $aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar aulas: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Aulas</title>
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
    <h1>Aulas Agendadas</h1>
    <table>
        <thead>
            <tr>
                <th>Tipo de Aula</th>
                <th>Data</th>
                <th>Instrutor</th>
                <th>Aluno</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aulas as $aula): ?>
                <tr>
                    <td><?= htmlspecialchars($aula['tipo']); ?></td>
                    <td><?= htmlspecialchars($aula['data']); ?></td>
                    <td><?= htmlspecialchars($aula['instrutor']); ?></td>
                    <td><?= htmlspecialchars($aula['aluno']); ?></td>
                    <td>
                        <a href="editar_aula.php?id=<?= $aula['id']; ?>"><button class="edit">Editar</button></a>
                        <a href="excluir_aula.php?id=<?= $aula['id']; ?>" onclick="return confirm('Deseja excluir esta aula?')"><button>Excluir</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
