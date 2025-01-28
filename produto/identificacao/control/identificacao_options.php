<?php
require_once("../../../produto/identificacao/model/identificacaodao.php");
class identificacao_options
{
    public function __construct()
    {
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);
        $busca_options = identificacaodao::get_options($received);
        echo $busca_options;
    }
}
new identificacao_options();
