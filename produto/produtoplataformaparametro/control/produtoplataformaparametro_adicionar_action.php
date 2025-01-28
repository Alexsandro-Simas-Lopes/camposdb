<?php
require_once("../../../produto/produtoplataformaparametro/model/produtoplataformaparametrodao.php");
class produtoplataformaparametro_adicionar
{
    public function __construct()
    {
        $error_code = 404;
        $exist_code = 400;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['id_produto']) && !empty($received['plataforma_selecionado']) && !empty($received['parametro_escolha']) && !empty($received['valor_parametro'])) {
            $busca_parametro = produtoplataformaparametrodao::getFindById($received['id_produto'], $received['plataforma_selecionado'], $received['parametro_escolha']);
            if (!empty($busca_parametro->getIdProduto())) {
                echo $exist_code;
            } else {
                $produtoplataformaparametro = new produtoplataformaparametro();

                $produtoplataformaparametro->setIdProduto($received['id_produto']);
                $produtoplataformaparametro->setIdPlataforma($received['plataforma_selecionado']);
                $produtoplataformaparametro->setIdParametro($received['parametro_escolha']);
                $produtoplataformaparametro->setValorParametro($received['valor_parametro']);

                $exec_produtoplataformaparametro = produtoplataformaparametrodao::insert($produtoplataformaparametro);
                if ($exec_produtoplataformaparametro) {
                    echo $success_code;
                }
            }
        } else {
            echo $error_code;
        }
    }
}
new produtoplataformaparametro_adicionar();
