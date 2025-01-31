<?php
require_once("../../produtos/model/produtodao.php");

class produto_adicionar
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $received = json_decode($receivedData, true);

        if (!empty($received['name'])) { // && !empty($received['Marca']) && !empty($received['Name']) && !empty($received['Img']) && !empty($received['Categoria']) && !empty($received['Price'])
            $verifica_existe = produtodao::verifica_existe_produto($received['name'], $received['price'], $received['marca'], $received['categoria'], $received['sub_categoria'], $received['img']);
            if (!empty($verifica_existe->getId())) {
                echo $error_code;
            } else {
                $produto = new produtos();

                $marca_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['marca']);
                $marca_limpo = str_replace(array("'", '"', '`', '/'), '', $marca_limpo);

                $name_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['name']);
                $name_limpo = str_replace(array("'", '"', '`', '/'), '', $name_limpo);

                $img_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['img']);
                $img_limpo = str_replace(array("'", '"', '`'), '', $img_limpo);

                $categoria_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['categoria']);
                $categoria_limpo = str_replace(array("'", '"', '`', '/'), '', $categoria_limpo);

                $sub_categoria_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['sub_categoria']);
                $sub_categoria_limpo = str_replace(array("'", '"', '`', '/'), '', $sub_categoria_limpo);

                $price_limpo = preg_replace('/[^\x20-\x7E]/', '', $received['price']);
                $price_limpo = str_replace(array("'", '"', '`', '/'), '', $price_limpo);

                $produto->setMarca($marca_limpo);
                $produto->setName($name_limpo);
                $produto->setImg($img_limpo);
                $produto->setCategoria($categoria_limpo);
                $produto->setSub_Categoria($sub_categoria_limpo);
                $produto->setPrice($price_limpo);

                $exec = produtodao::insert($produto);

                if($exec === true) {
                    echo $success_code;
                }
            }
        } else {
            echo $error_code;
        }
    }
}
new produto_adicionar;
