<?php
require_once 'db_connection_academia.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM alunos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: listar_alunos.php?status=deleted');
        exit;
    } catch (PDOException $e) {
        echo "Erro ao excluir aluno: " . $e->getMessage();
    }
}
?>
