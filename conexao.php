<?php

$host = 'localhost'; 
$usuario = 'root'; 
$senha = ''; 
$banco = 'db_academia'; 

try {
   
    $conn = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    
    echo "Erro na conexão: " . $e->getMessage();
}
?>
