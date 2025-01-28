<?php
require_once("../../../parametro/configDB/connectDB.php");
require_once("../../../produto/produtoidentificacao/model/produtoidentificacao.php");

class produtoidentificacaodao
{
    public static function getFindById($id_produto, $id_identificacao)
    {
        try {
            $param['id_produto'] = $id_produto;
            $param['id_identificacao'] = $id_identificacao;
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM y_produto_identificacao WHERE IdProduto = :id_produto AND IdIdentificacao = :id_identificacao";
            $stm = $PDO->prepare($sql);
            $stm->execute($param);
            $produtoidentificacao = $stm->fetchObject(produtoidentificacao::class);

            return empty($produtoidentificacao) ? new produtoidentificacao() : $produtoidentificacao;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function getFindByAll(array $input = null)
    {
        $param_where = '1=1';
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM y_produto_identificacao WHERE $param_where";
            $stm = $PDO->prepare($sql);
            $stm->execute();

            $results = array();

            while ($row = $stm->fetch(PDO::FETCH_OBJ)) {

                $objeto = new produtoidentificacao();

                $objeto->setIdProduto($row->IdProduto);
                $objeto->setIdIdentificacao($row->IdIdentificacao);

                $results[] = $objeto;
            }
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function getFindByProduto($id_produto)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT pi.*, i.Descricao as descricao_identificacao, p.Descricao as descricao_produto 
                    FROM y_produto_identificacao pi 
                    JOIN identificacao i ON i.Id = pi.IdIdentificacao
                    JOIN produto p ON p.Id = pi.IdProduto
                    WHERE pi.IdProduto = :id_produto";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(":id_produto", $id_produto);
            $stm->execute();

            $results = array();

            while ($row = $stm->fetch(PDO::FETCH_OBJ)) {

                $objeto = new produtoidentificacao();

                $objeto->setIdProduto($row->IdProduto);
                $objeto->setProduto($row->descricao_produto);
                $objeto->setIdIdentificacao($row->IdIdentificacao);
                $objeto->setIdentificacao($row->descricao_identificacao);

                $results[] = $objeto;
            }
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function insert(produtoidentificacao $produtoidentificacao)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "INSERT INTO y_produto_identificacao (IdProduto, IdIdentificacao) VALUE (:IdProduto, :IdIdentificacao)";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(":IdProduto", $produtoidentificacao->getIdProduto());
            $stm->bindValue(":IdIdentificacao", $produtoidentificacao->getIdIdentificacao());
            $stm->execute();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id_produto, $id_identificaca)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "DELETE FROM y_produto_identificacao WHERE IdProduto = :id_produto AND IdIdentificacao = :id_identificacao";
            $stm = $PDO->prepare($sql);
            $stm->bindParam(":id_produto", $id_produto);
            $stm->bindParam(":id_identificacao", $id_identificaca);
            $stm->execute();

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
