<?php
require_once("../../artigos/model/artigodao.php");

class artigo_editar
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['identificador'])) {
            $produto = artigodao::getFindById($received['identificador'], $received['titulo'], $received['resumo'], $received['conteudo'], $received['status']);
            if (!empty($produto->getId())) {
                // Limpeza dos dados recebidos
                $titulo_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['titulo']);
                $titulo_limpo = str_replace(array("'", '"', '`', '/'), '', $titulo_limpo);

                $resumo_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['resumo']);
                $resumo_limpo = str_replace(array("'", '"', '`', '/'), '', $resumo_limpo);

                $conteudo_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['conteudo']);
                $conteudo_limpo = str_replace(array("'", '"', '`', '/'), '', $conteudo_limpo);

                $status_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['status']);
                $status_limpo = str_replace(array("'", '"', '`', '/'), '', $status_limpo);

                // // Atualizar imagem se um novo arquivo foi enviado
                // $imagemAntiga = $produto->getImg();
                // $novaImagem = isset($_FILES['img']) ? uploadImagem($_FILES['img'], $imagemAntiga) : $imagemAntiga;

                // Atualiza os dados do produto
                $produto->setTitulo($titulo_limpo);
                $produto->setResumo($resumo_limpo);
                $produto->setConteudo($conteudo_limpo);
                $produto->setStatus($status_limpo);

                $exec = artigodao::update($produto);
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

new artigo_editar();

