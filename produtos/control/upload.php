<?php

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/camposdb/public/assets/uploads/";
// Caminho correto da pasta
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['img'])) {
    $img = $_FILES['img'];

    if ($img['error'] === 0) {
        $fileName = time() . "_" . basename($img["name"]);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($img["tmp_name"], $targetFilePath)) {
            // Constrói a URL correta da imagem
            $imgUrl = "http://" . $_SERVER['HTTP_HOST'] . "/camposdb/public/assets/uploads/" . $fileName;
            $imgUrl = str_replace("\\", "/", $imgUrl); // Substitui as barras invertidas por barras normais

            echo json_encode(["message" => "Imagem salva com sucesso!", "imgUrl" => $imgUrl]);
        } else {
            echo json_encode(["error" => "Erro ao salvar a imagem."]);
        }
    } else {
        echo json_encode(["error" => "Erro no upload da imagem."]);
    }
} else {
    echo json_encode(["error" => "Requisição inválida."]);
}

?>

