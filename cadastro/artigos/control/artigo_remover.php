<?php 
require_once("../../artigos/model/artigodao.php");
class artigo_remover
{
    public function __construct()
    {
        $error_code = 404;
        $success_code = 200;
        $receivedData = file_get_contents("php://input");
        $dataJSON = json_decode($receivedData);

        // Buscar o produto no banco de dados
        $busca_produto = artigodao::getFindById($dataJSON->id);
        
        if (!empty($busca_produto->getId())) {
            // Recuperar a URL da imagem do produto
            // $imgUrl = $busca_produto->getImg();  // Método que retorna a URL da imagem
            // $imgPath = str_replace("http://" . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $imgUrl);

            // // Exibir o caminho para depuração
            // echo "Caminho da imagem: " . $imgPath . "<br>";

            // // Excluir a imagem se ela existir
            // if (file_exists($imgPath)) {
            //     echo "Imagem encontrada. Removendo...<br>";
            //     unlink($imgPath);  // Remove a imagem do diretório de uploads
            // } else {
            //     echo "Imagem não encontrada: " . $imgPath . "<br>";
            // }
            $exec = artigodao::delete($dataJSON->id);
            if ($exec === true) {
                $success_code;
            } else {
                $error_message = "Não é possível excluir o produto";
                if ($exec->getCode() == 23000) {
                    echo json_encode(["error" => $error_message]);
                } else {
                    $error_message = "Houve um erro (tente novamente)";
                    echo json_encode(["error" => $error_message]);
                }
            }
        } else {
            echo json_encode(["error" => $error_code]);
        }
    }
}

new artigo_remover();



