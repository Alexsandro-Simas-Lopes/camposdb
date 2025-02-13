<?php
require_once("../../artigos/model/artigodao.php");

class artigo_adicionar
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['titulo'])) { // && !empty($received['Marca']) && !empty($received['titulo']) && !empty($received['Img']) && !empty($received['Categoria']) && !empty($received['Price'])
            $verifica_existe = artigodao::verifica_existe_artigo($received['titulo'], $received['resumo'], $received['conteudo'], $received['status']);
            if (!empty($verifica_existe->getId())) {
                echo $error_code;
            } else {
                $artg = new artigos();

                $titulo_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['titulo']);
                $titulo_limpo = str_replace(array("'", '"', '`', '/'), '', $titulo_limpo);

                $resumo_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['resumo']);
                $resumo_limpo = str_replace(array("'", '"', '`', '/'), '', $resumo_limpo);

                $conteudo_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['conteudo']);
                $conteudo_limpo = str_replace(array("'", '"', '`', '/'), '', $conteudo_limpo);

                $status_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['status']);
                $status_limpo = str_replace(array("'", '"', '`', '/'), '', $status_limpo);

                $artg->setTitulo($titulo_limpo);
                $artg->setResumo($resumo_limpo);
                $artg->setConteudo($conteudo_limpo);
                $artg->setStatus($status_limpo);

                $exec = artigodao::insert($artg);

                if($exec === true) {
                    echo $success_code;
                }
            }
        } else {
            echo $error_code;
        }
    }
}
new artigo_adicionar;
