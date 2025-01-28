<?php
require_once("../../../produto/produtoplataformaparametro/model/produtoplataformaparametrodao.php");
class produtoplataformaparametro_byproduto
{
    public function __construct()
    {
        $return_data = "";
        $empty = <<<EOD
        <tr>
            <td colspan="4">
                <center>Nenhum parâmetro incluído</center>
            </td>
        </tr>
        EOD;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);
        if (!empty($received['id_produto'])) {
            $busca_produtoplataformaparametro = produtoplataformaparametrodao::getFindByProduto($received['id_produto']);
            if (!empty($busca_produtoplataformaparametro)) {
                $return_data = "";
                foreach ($busca_produtoplataformaparametro as $produtoplataformaparametro) {
                    $id = $produtoplataformaparametro->getIdProduto() . "/" . $produtoplataformaparametro->getIdPlataforma() . "/" . $produtoplataformaparametro->getIdParametro();
                    $plataforma = $produtoplataformaparametro->getPlataforma();
                    $parametro = $produtoplataformaparametro->getParametro();
                    $valor = $produtoplataformaparametro->getValorParametro();
                    $return_data .= <<<EOD
                    <tr recid-parametro-produto-class-editar="$id">
                        <td>$plataforma</td>
                        <td>$parametro</td>
                        <td>
                            <div style="display: flex; align-items: baseline; justify-content: center; gap: 10px;">
                                <input type="text" class="form-control" style="height: 19.6px !important;background-color: white;" maxlength="100" name="valor_parametro_linha_editar" id="valor_parametro_linha_editar_$id" value="$valor" readonly> 
                                <i class="fa fa-pencil-square-o" style="cursor:pointer" id="valor_parametro_icon_editar_$id" onclick="altera_valor_editar('$id')" title="Alterar valor"></i>
                            </div>
                        </td>
                        <td class="actions">
                            <center>
                                <i class="fa fa-trash" data-placement="bottom" style="cursor:pointer; padding: 2px" title="Remover" onclick="remover_parametro_lista_editar('$id')"></i>
                            </center>
                        </td> 
                    </tr>
                    EOD;
                }
            } else {
                $return_data = $empty;
            }
        }
        echo $return_data;
    }
}
new produtoplataformaparametro_byproduto();
