<?php
header("Content-Type: application/json");

// Configurações de limite de memória e upload
ini_set('memory_limit', '256M');
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '55M');

date_default_timezone_set('America/Manaus');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Método inválido"]);
    exit;
}

if (!isset($_FILES['img'])) {
    echo json_encode(["error" => "Imagem não foi enviada"]);
    exit;
}

// Diretório de upload
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/camposdb/public/assets/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Upload da nova imagem
$img = $_FILES['img'];
if ($img['error'] === 0) {
    $fileName = time() . "_" . basename($img["name"]);
    $targetFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($img["tmp_name"], $targetFilePath)) {
        chmod($targetFilePath, 0777);

        // Constrói a URL correta da imagem
        $imgUrl = "http://" . $_SERVER['HTTP_HOST'] . "/camposdb/public/assets/uploads/" . $fileName;
        $imgUrl = str_replace("\\", "/", $imgUrl);

        // Retorna apenas a URL da imagem para o cliente
        echo json_encode(["imgUrl" => $imgUrl]);
    } else {
        echo json_encode(["error" => "Erro ao salvar a imagem"]);
    }
} else {
    $errorMessages = [
        1 => "A imagem excede o limite de upload definido no php.ini",
        2 => "A imagem excede o limite MAX_FILE_SIZE especificado no formulário HTML",
        3 => "A imagem foi parcialmente carregada",
        4 => "Nenhuma imagem foi enviada",
        6 => "Pasta temporária ausente",
        7 => "Falha ao escrever o arquivo no disco",
        8 => "Uma extensão PHP interrompeu o upload"
    ];
    
    $errorMsg = isset($errorMessages[$img['error']]) ? $errorMessages[$img['error']] : "Erro desconhecido no upload";
    echo json_encode(["error" => $errorMsg]);
}
?>