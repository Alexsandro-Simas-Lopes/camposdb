<?php
require_once("../../../produto/produtoplataformaparametro/model/produtoplataformaparametrodao.php");
class produtoplataformaparametro_remover
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $dataJSON = json_decode($receivedData, true);

        if (!empty($dataJSON['id_remover'])) {
            $separa_id = explode('/', $dataJSON['id_remover']);

            $produto = $separa_id[0];
            $plataforma = $separa_id[1];
            $parametro = $separa_id[2];

            $busca_parametro = produtoplataformaparametrodao::getFindById($produto, $plataforma, $parametro);
            if (!empty($busca_parametro->getIdProduto()) && !empty($busca_parametro->getIdPlataforma()) && !empty($busca_parametro->getIdParametro())) {
                $exec = produtoplataformaparametrodao::delete($produto, $plataforma, $parametro);
                if ($exec === true) {
                } else {
                    $error_message = "Não é possível excluir o parâmetro";
                    // if ($exec->getCode() == 23000) {
                    //     $error_message = "Não é possível excluir o parâmetro porque ele está associado a ###.";
                    // } else {
                    //     $error_message = "Houve um erro (tente novamente)";
                    // }
                    echo $error_message;
                }
            }
        }
    }
}
new produtoplataformaparametro_remover();
