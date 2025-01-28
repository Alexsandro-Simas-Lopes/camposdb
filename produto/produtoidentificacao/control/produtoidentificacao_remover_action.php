<?php
require_once("../../../produto/produtoidentificacao/model/produtoidentificacaodao.php");
class produtoidentificacao_remover
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $dataJSON = json_decode($receivedData, true);

        if (!empty($dataJSON['id_produto_remover'])) {
            $separa_id = explode('/', $dataJSON['id_produto_remover']);

            $produto = $separa_id[0];
            $identificador = $separa_id[1];
        }
        $busca_produto = produtoidentificacaodao::getFindById($produto, $identificador);
        if (!empty($busca_produto->getIdProduto()) && !empty($busca_produto->getIdIdentificacao())) {
            $exec = produtoidentificacaodao::delete($produto, $identificador);
            if ($exec === true) {
            } else {
                $error_message = "Não é possível excluir a identificação";
                if ($exec->getCode() == 23000) {
                    if (strpos($exec->getMessage(), 'y_produto_plataforma_parametro') !== false) {
                        $error_message = "Não é possível excluir a identificação <br><strong>(#_txt_#)</strong> <br> porque ele está associado a assinatura.";
                    }
                } else {
                    $error_message = "Houve um erro (tente novamente)";
                }
                echo $error_message;
            }
        }
    }
}
new produtoidentificacao_remover();
