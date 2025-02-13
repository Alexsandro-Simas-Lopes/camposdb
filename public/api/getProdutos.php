<?php
require_once("../../parametro/configDB/connectDB.php");

    try {
        $PDO = connectDB::getInstance();
        $sql = "SELECT id, name, price, categoria, sub_categoria, marca, img FROM produtos";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();

        // Obtém os resultados como array associativo
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna os dados como JSON
        header("Content-Type: application/json");
        echo json_encode($produtos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    } catch (PDOException $e) {
        echo json_encode(["error" => "Erro ao buscar os produtos: " . $e->getMessage()]);
    }
?>
