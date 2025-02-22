<?php
require_once("../../artigos/model/artigodao.php");

class artigo_verifca_existe
{
    public function __construct()
    {
        $error_code = 404;
        $exist_code = 400;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['titulo'])) {
            $verifica_existe = artigodao::verifica_existe_artigo($received['titulo']);
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
new artigo_verifca_existe();
