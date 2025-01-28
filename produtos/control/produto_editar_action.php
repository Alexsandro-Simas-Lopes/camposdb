<?php
require_once("../../../produto/produto/model/produtodao.php");


class produto_editar
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['identificador']) && !empty($received['descricao'])) {
            $verifica_produto = produtodao::getFindById($received['identificador']);
            if (!empty($verifica_produto->getId())) {
                $produto = new produto();

                $produto->setId($received['identificador']);

                $descricao_limpa = preg_replace('/[^\x20-\x7E]/', '', $received['descricao']);
                $descricao_limpa = str_replace(array("'", '"', '`'), '', $descricao_limpa);
                $produto->setDescricao($descricao_limpa);

                $exec = produtodao::update($produto);
                if ($exec) {
                    echo $success_code;
                }
            } else {
                echo $error_code;
            }
        } else {
            echo $error_code;
        }
    }
}
new produto_editar();
