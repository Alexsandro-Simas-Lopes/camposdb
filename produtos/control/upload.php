<?php
require_once("../../produtos/model/produtodao.php");

$instance = connectDB::getInstance();

// $instance = new PDO("mysql:host=localhost;dbname=seu_banco", "root", "senha");
// $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Criar tabela se não existir
// Criar tabela se não existir
// $instance->exec("CREATE TABLE IF NOT EXISTS img_produtos (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     image VARCHAR(255) NOT NULL
// )");

$uploadDir = "../../public/assets/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $img = $_FILES['image'];

    if ($img['error'] === 0) {
        $fileName = time() . "_" . basename($img["name"]);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($img["tmp_name"], $targetFilePath)) {
            $stmt = $instance->prepare("INSERT INTO produts (image) VALUES (?)");
            $stmt->execute([$fileName]);
            echo json_encode(["message" => "Imagem cadastrada!", "imageUrl" => $targetFilePath]);
        } else {
            echo json_encode(["error" => "Erro ao salvar a imagem."]);
        }
    } else {
        echo json_encode(["error" => "Imagem é obrigatória."]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $instance->query("SELECT * FROM produts");
    $img_produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($img_produtos as &$product) {
        $product['imageUrl'] = "../../public/assets/uploads/" . $product['image'];
    }
    echo json_encode($img_produtos);
}
?>