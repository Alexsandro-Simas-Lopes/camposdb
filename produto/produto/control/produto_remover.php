<?php
require_once("../../../produto/produto/model/produtodao.php");
class produto_remover
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $dataJSON = json_decode($receivedData);

        $busca_produto = produtodao::getFindById($dataJSON->id);
        if (!empty($busca_produto->getId())) {
            $exec = produtodao::delete($dataJSON->id);
            if ($exec === true) {
            } else {
                $error_message = "Não é possível excluir o produto";
                if ($exec->getCode() == 23000) {
                    if (strpos($exec->getMessage(), 'y_produto_plataforma_parametro') !== false) {
                        $error_message = "Não é possível excluir o produto <br><strong>(#_txt_#)</strong> <br> porque ele está associado a parâmetro.";
                    } else  if (strpos($exec->getMessage(), 'y_produto_identificacao_assinatura') !== false) {
                        $error_message = "Não é possível excluir o produto <br><strong>(#_txt_#)</strong> <br> porque ele está associado a identificação.";
                    } else  if (strpos($exec->getMessage(), 'y_produto_identificacao') !== false) {
                        $error_message = "Não é possível excluir o produto <br><strong>(#_txt_#)</strong> <br> porque ele está associado a identificação.";
                    } else  if (strpos($exec->getMessage(), 'voucher') !== false) {
                        $error_message = "Não é possível excluir o produto <br><strong>(#_txt_#)</strong> <br> porque ele está associado a voucher.";
                    } else  if (strpos($exec->getMessage(), 'assinatura') !== false) {
                        $error_message = "Não é possível excluir o produto <br><strong>(#_txt_#)</strong> <br> porque ele está associado a assinatura.";
                    }
                } else {
                    $error_message = "Houve um erro (tente novamente)";
                }
                echo $error_message;
            }
        } else {
            echo $error_code;
        }
    }
}
new produto_remover();
