<?php
require_once("../../../produto/produto/model/produtodao.php");
require_once("../../../produto/produtoidentificacao/model/produtoidentificacaodao.php");
require_once("../../../produto/produtoplataformaparametro/model/produtoplataformaparametrodao.php");

class produto_adicionar
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['descricao']) && !empty($received['identificador'])) {
            $verifica_existe = produtodao::verifica_existe_produto($received['identificador']);
            if (!empty($verifica_existe->getId())) {
                echo $error_code;
            } else {
                $produto = new produto();

                $descricao_limpa = preg_replace('/[^\x20-\x7E]/', '', $received['descricao']);
                $descricao_limpa = str_replace(array("'", '"', '`', '/'), '', $descricao_limpa);

                $identificador_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['identificador']);
                $identificador_limpo = str_replace(array("'", '"', '`', '/'), '', $identificador_limpo);

                $produto->setId($identificador_limpo);
                $produto->setDescricao($descricao_limpa);

                $exec = produtodao::insert($produto);

                if ($exec === true) {
                    $id_produto = $identificador_limpo;
                    if (!empty($received['indentificacao'])) {
                        foreach ($received['indentificacao'] as $identificacao) {
                            $produtoidentificacao = new produtoidentificacao();

                            $produtoidentificacao->setIdProduto($id_produto);
                            $produtoidentificacao->setIdIdentificacao($identificacao['identificacao_selecionado']);

                            $exec_produtoidentificacao = produtoidentificacaodao::insert($produtoidentificacao);
                        }
                    }
                    if (!empty($received['parametro'])) {
                        foreach ($received['parametro'] as $parametro) {

                            $produtoplataformaparametro = new produtoplataformaparametro();

                            $produtoplataformaparametro->setIdProduto($id_produto);
                            $produtoplataformaparametro->setIdPlataforma($parametro['plataforma_selecionado']);
                            $produtoplataformaparametro->setIdParametro($parametro['parametro_escolha']);

                            $parametro_limpo = str_replace(array("'", '"', '`', '/'), '', $parametro['valor_parametro']);

                            $produtoplataformaparametro->setValorParametro($parametro_limpo);

                            $exec_produtoplataformaparametro = produtoplataformaparametrodao::insert($produtoplataformaparametro);
                        }
                    }
                }
            }
        } else {
            echo $error_code;
        }
    }
}
new produto_adicionar;
