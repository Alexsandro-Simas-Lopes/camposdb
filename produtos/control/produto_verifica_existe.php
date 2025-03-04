<?php
require_once("../../produtos/model/produtodao.php");

class produto_verifca_existe
{
    public function __construct()
    {
        $error_code = 404;
        $exist_code = 400;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['marca'])) {
            $verifica_existe = produtodao::verifica_existe_produto($received['name']);
            if (!empty($verifica_existe->getId())) {
                echo "$exist_code";
            } else {
                echo "$success_code";
            }
        } else {
            echo "$error_code";
            
        }
    }
}
new produto_verifca_existe();
