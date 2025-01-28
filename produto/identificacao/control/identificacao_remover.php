<?php
require_once("../../../produto/identificacao/model/identificacaodao.php");
class identificacao_remover
{
    public function __construct()
    {
        $error_code = 404;
        $receivedData = file_get_contents("php://input");
        $dataJSON = json_decode($receivedData, TRUE);

        $busca_identificacao = identificacaodao::getFindById($dataJSON['id']);
        if (!empty($busca_identificacao->getId())) {
            $exec = identificacaodao::delete($dataJSON['id']);
            if ($exec === true) {
            } else {
                $error_message = "Não é possível excluir o identificação";
                if ($exec->getCode() == 23000) {
                    if (strpos($exec->getMessage(), 'y_produto_plataforma_identificacao') !== false) {
                        $error_message = "Não é possível excluir o identificacao <br><strong>(#_txt_#)</strong> <br> porque ele está associado a produto.";
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
new identificacao_remover();