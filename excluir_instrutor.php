<?php
require_once 'db_connection_academia.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM instrutores WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: listar_instrutores.php?status=deleted');
        exit;
    } catch (PDOException $e) {
        echo "Erro ao excluir instrutor: " . $e->getMessage();
    }
}
?>
