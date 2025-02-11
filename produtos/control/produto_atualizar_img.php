<?php
require_once("../../produtos/model/produtodao.php");

$receivedData = file_get_contents("php://input");
$data = json_decode($receivedData, true);

if (!empty($data['id']) && !empty($data['img'])) {
    $produto = produtodao::getFindById($data['id']);
    $produto->setImg($data['img']);

    // Atualiza no banco
    if (produtodao::update($produto)) {
        echo "200"; // Sucesso
    } else {
        echo "400"; // Falha
    }
} else {
    echo "400"; // Dados inválidos
}
?>
