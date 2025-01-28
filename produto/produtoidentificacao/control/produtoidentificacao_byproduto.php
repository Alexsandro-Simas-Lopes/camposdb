<?php
require_once("../../../produto/produtoidentificacao/model/produtoidentificacaodao.php");
class produtoidentificacao_byproduto
{
    public function __construct()
    {
        $return_data = "";
        $empty = <<<EOD
        <tr>
            <td colspan="2">
                <center>Nenhuma identificação incluída</center>
            </td>
        </tr>
        EOD;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);
        if (!empty($received['id_produto'])) {
            $busca_produtoidentificacao = produtoidentificacaodao::getFindByProduto($received['id_produto']);
            if (!empty($busca_produtoidentificacao)) {
                $return_data = "";
                foreach ($busca_produtoidentificacao as $produtoidentificacao) {
                    $id = $produtoidentificacao->getIdProduto() . "/" . $produtoidentificacao->getIdIdentificacao();
                    $descricao = $produtoidentificacao->getIdentificacao();
                    $return_data .= <<<EOD
                    <tr recid-identificacao-class-editar="$id">
                        <td>$descricao</td>
                        <td class="actions">
                            <center>
                                <i class="fa fa-trash" data-placement="bottom" style="cursor:pointer; padding: 2px" title="Remover" onclick="remover_identificacao_lista_editar('$id')"></i>
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
new produtoidentificacao_byproduto();
