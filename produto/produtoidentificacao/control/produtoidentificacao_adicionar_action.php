<?php
require_once("../../../produto/produtoidentificacao/model/produtoidentificacaodao.php");
class produtoidentificacao_editar
{
    public function __construct()
    {
        $error_code = 404;
        $exist_code = 400;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['id_produto_editar']) && !empty($received['identificacao_selecionado'])) {
            $busca_identificaco = produtoidentificacaodao::getFindById($received['id_produto_editar'], $received['identificacao_selecionado']);
            if (!empty($busca_identificaco->getIdProduto())) {
                echo $exist_code;
            } else {
                $produtoidentificacao = new produtoidentificacao();

                $produtoidentificacao->setIdProduto($received['id_produto_editar']);
                $produtoidentificacao->setIdIdentificacao($received['identificacao_selecionado']);

                $exec_produtoidentificacao = produtoidentificacaodao::insert($produtoidentificacao);
                if ($exec_produtoidentificacao) {
                    echo $success_code;
                }
            }
        } else {
            echo $error_code;
        }
    }
}
new produtoidentificacao_editar();
