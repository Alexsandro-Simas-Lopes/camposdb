<?php
require_once("../../../produto/produto/model/produtodao.php");


class produto_verifca_existe
{
    public function __construct()
    {
        $error_code = 404;
        $exist_code = 400;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['identificador'])) {
            $verifica_produto = produtodao::verifica_existe_produto($received['identificador']);
            if (!empty($verifica_produto->getId())) {
                echo $exist_code;
            } else {
                echo $success_code;
            }
        } else {
            echo $error_code;
        }
    }
}
new produto_verifca_existe();
