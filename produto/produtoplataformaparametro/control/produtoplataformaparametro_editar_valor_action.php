<?php
require_once("../../../produto/produtoplataformaparametro/model/produtoplataformaparametrodao.php");
class produtoplataformaparametro_editar_valor
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['id_editar']) && !empty($received['valor_parametro'])) {
            $separa_id = explode('/', $received['id_editar']);

            $produto = $separa_id[0];
            $plataforma = $separa_id[1];
            $parametro = $separa_id[2];

            $busca_parametro = produtoplataformaparametrodao::getFindById($produto, $plataforma, $parametro);
            if (!empty($busca_parametro->getIdProduto()) && !empty($busca_parametro->getIdPlataforma()) && !empty($busca_parametro->getIdParametro())) {

                $produtoplataformaparametro = new produtoplataformaparametro();

                $produtoplataformaparametro->setIdProduto($produto);
                $produtoplataformaparametro->setIdPlataforma($plataforma);
                $produtoplataformaparametro->setIdParametro($parametro);
                $produtoplataformaparametro->setValorParametro($received['valor_parametro']);

                $exec_produtoplataformaparametro = produtoplataformaparametrodao::update($produtoplataformaparametro);
                if ($exec_produtoplataformaparametro) {
                    echo $success_code;
                }
            }
        }
    }
}
new produtoplataformaparametro_editar_valor();
