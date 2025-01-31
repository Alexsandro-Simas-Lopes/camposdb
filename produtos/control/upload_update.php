<?php
function uploadImagem($imgFile, $oldImage = null)
{
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/camposdb/public/assets/uploads/";

    // Criar diretório se não existir
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Verifica se um arquivo foi enviado corretamente
    if (!isset($imgFile) || $imgFile['error'] !== UPLOAD_ERR_OK) {
        return $oldImage; // Mantém a imagem antiga caso nenhuma nova seja enviada
    }

    // Lista de extensões permitidas
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extensao = strtolower(pathinfo($imgFile['name'], PATHINFO_EXTENSION));

    // Verifica se a extensão é válida
    if (!in_array($extensao, $extensoesPermitidas)) {
        return $oldImage; // Retorna a imagem antiga se a extensão não for permitida
    }

    // Gera um nome único para a nova imagem
    $novoNomeImg = uniqid('img_', true) . "." . $extensao;
    $caminhoCompleto = $uploadDir . $novoNomeImg;

    // Remove a imagem antiga se existir e for diferente da nova
    if (!empty($oldImage) && file_exists($uploadDir . $oldImage) && $oldImage !== $novoNomeImg) {
        unlink($uploadDir . $oldImage);
    }

    // Move o arquivo para o diretório de uploads
    if (move_uploaded_file($imgFile['tmp_name'], $caminhoCompleto)) {
        return $novoNomeImg; // Retorna o novo nome da imagem para ser salvo no banco de dados
    }

    return $oldImage; // Retorna a imagem antiga caso ocorra erro no upload
}
?>

