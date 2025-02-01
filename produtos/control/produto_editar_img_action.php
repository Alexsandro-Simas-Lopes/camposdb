<?php
require_once("../../produtos/model/produtodao.php");

class produto_adicionar_img
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;

        // Recebe os dados enviados via JSON
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['id']) && !empty($received['img'])) {
            // Verifica se o produto existe no banco pelo ID
            $produto_existente = produtodao::getFindById($received['id']);

            if (!empty($produto_existente->getId())) {
                // Limpa a URL da imagem
                $img_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['img']);
                $img_limpo = str_replace(array("'", '"', '`'), '', $img_limpo);

                // Atualiza a URL da imagem no banco
                $exec = produtodao::updateProdutoImg($received['id'], $img_limpo);

                if ($exec === true) {
                    echo json_encode(["status" => "sucesso", "code" => $success_code]);
                } else {
                    echo json_encode(["status" => "erro_ao_atualizar", "code" => $error_code]);
                }
            } else {
                // Produto não encontrado
                echo json_encode(["status" => "produto_nao_encontrado", "code" => $error_code]);
            }
        } else {
            // ID ou imagem não foram enviados corretamente
            echo json_encode(["status" => "dados_invalidos", "code" => $error_code]);
        }
    }
}

new produto_adicionar_img;


