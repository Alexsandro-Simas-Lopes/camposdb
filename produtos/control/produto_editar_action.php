<?php
require_once("../../produtos/model/produtodao.php");

class produto_editar
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['identificador'])) {
            // Buscar produto pelo ID
            $produto = produtodao::getFindById($received['identificador'], $received['name'], $received['price'], $received['marca'], $received['categoria'], $received['sub_categoria'], $received['img']);
            
            if (!empty($produto->getId())) {
                // Limpeza dos dados recebidos
                $marca_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['marca']);
                $marca_limpo = str_replace(array("'", '"', '`', '/'), '', $marca_limpo);

                $name_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['name']);
                $name_limpo = str_replace(array("'", '"', '`', '/'), '', $name_limpo);

                $categoria_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['categoria']);
                $categoria_limpo = str_replace(array("'", '"', '`', '/'), '', $categoria_limpo);

                $sub_categoria_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['sub_categoria']);
                $sub_categoria_limpo = str_replace(array("'", '"', '`', '/'), '', $sub_categoria_limpo);

                $price_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['price']);
                $price_limpo = str_replace(array("'", '"', '`', '/'), '', $price_limpo);

                // Atualizar imagem se um novo arquivo foi enviado
                $imagemAntiga = $produto->getImg();
                $novaImagem = isset($_FILES['img']) ? uploadImagem($_FILES['img'], $imagemAntiga) : $imagemAntiga;

                // Atualiza os dados do produto
                $produto->setMarca($marca_limpo);
                $produto->setName($name_limpo);
                $produto->setImg($novaImagem);
                $produto->setCategoria($categoria_limpo);
                $produto->setSub_Categoria($sub_categoria_limpo);
                $produto->setPrice($price_limpo);

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

