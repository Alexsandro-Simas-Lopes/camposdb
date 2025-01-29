<?php
require_once("../../produtos/model/produtodao.php");
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
                    echo $error_message;
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
