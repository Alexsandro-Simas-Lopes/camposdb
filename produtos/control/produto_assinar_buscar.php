<?php
require_once("../../../produto/produto/model/produtodao.php");
class produto_assinar_buscar
{
    public function __construct()
    {
        if (!empty($_GET['id_cliente'])) {
            $return_content = "";
            $busca_produto_cliente = produtodao::busca_produto_cliente_assinatura($_GET['id_cliente']);
            if (!empty($busca_produto_cliente)) {
                if (isset($busca_produto_cliente['error_code'])) {
                    $inner_text = "";
                    if ($busca_produto_cliente['error_code'] == 406) {
                        $inner_text = "Não a produtos disponíveis para o cliente";
                    }
                    if ($busca_produto_cliente['error_code'] == 404) {
                        $inner_text = "Cliente não possui cadastro";
                    }
                    if ($busca_produto_cliente['error_code'] == 400) {
                        $inner_text = "Houve um erro (tente novamente)";
                    }
                    $return_content = <<<EOD
                    <li class="dd-item" data-id="5">
                        <div class="dd-handle">
                            <span class="label label-defaut"><i class="fa fa-ban" aria-hidden="true"></i></span> $inner_text
                        </div>
                    </li>     
                    EOD;
                } else {
                }
            } else {
                $return_content = <<<EOD
                <li class="dd-item" data-id="5">
                    <div class="dd-handle">
                        <span class="label label-defaut"><i class="fa fa-ban" aria-hidden="true"></i></span> Houve um erro (Tente Novamente)
                    </div>
                </li>     
                EOD;
            }
            echo $return_content;
        }
    }
}
new produto_assinar_buscar();
