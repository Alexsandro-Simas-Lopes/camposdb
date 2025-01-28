<?php
require_once("../../../parametro/configDB/connectDB.php");
require_once("../../../produto/produtoplataformaparametro/model/produtoplataformaparametro.php");

class produtoplataformaparametrodao
{
    public static function getFindById($id_produto, $id_plataforma, $id_parametro)
    {
        try {
            $param['id_produto'] = $id_produto;
            $param['id_plataforma'] = $id_plataforma;
            $param['id_parametro'] = $id_parametro;
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM y_produto_plataforma_parametro 
                    WHERE IdProduto = :id_produto AND IdPlataforma = :id_plataforma AND IdParametro = :id_parametro";
            $stm = $PDO->prepare($sql);
            $stm->execute($param);
            $produtoplataformaparametro = $stm->fetchObject(produtoplataformaparametro::class);

            return empty($produtoplataformaparametro) ? new produtoplataformaparametro() : $produtoplataformaparametro;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function getFindByAll(array $input = null)
    {
        $param_where = '1=1';
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM y_produto_plataforma_parametro WHERE $param_where";
            $stm = $PDO->prepare($sql);
            $stm->execute();

            $results = array();

            while ($row = $stm->fetch(PDO::FETCH_OBJ)) {

                $objeto = new produtoplataformaparametro();

                $objeto->setIdProduto($row->IdProduto);
                $objeto->setIdPlataforma($row->IdPlataforma);
                $objeto->setIdParametro($row->IdParametro);
                $objeto->setValorParametro($row->ValorParametro);

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
            $sql = "SELECT yppp.*, p.Nome as descricao_plataforma, pa.Descricao as descricao_parametro FROM y_produto_plataforma_parametro yppp 
                    JOIN plataforma p ON p.Id = yppp.IdPlataforma
                    JOIN parametro pa ON pa.Id = yppp.IdParametro
                    WHERE yppp.IdProduto = :id_produto";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(":id_produto", $id_produto);
            $stm->execute();

            $results = array();
            while ($row = $stm->fetch(PDO::FETCH_OBJ)) {

                $objeto = new produtoplataformaparametro();

                $objeto->setIdProduto($row->IdProduto);
                $objeto->setIdPlataforma($row->IdPlataforma);
                $objeto->setPlataforma($row->descricao_plataforma);
                $objeto->setIdParametro($row->IdParametro);
                $objeto->setParametro($row->descricao_parametro);
                $objeto->setValorParametro($row->ValorParametro);

                $results[] = $objeto;
            }
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function insert(produtoplataformaparametro $produtoplataformaparametro)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "INSERT INTO y_produto_plataforma_parametro (IdProduto, IdPlataforma, IdParametro, ValorParametro) VALUE (:IdProduto, :IdPlataforma, :IdParametro, :ValorParametro)";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(":IdProduto", $produtoplataformaparametro->getIdProduto());
            $stm->bindValue(":IdPlataforma", $produtoplataformaparametro->getIdPlataforma());
            $stm->bindValue(":IdParametro", $produtoplataformaparametro->getIdParametro());
            $stm->bindValue(":ValorParametro", $produtoplataformaparametro->getValorParametro());
            $stm->execute();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function delete($id_produto, $id_plataforma, $id_parametro)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "DELETE FROM y_produto_plataforma_parametro 
                    WHERE IdProduto = :id_produto AND IdPlataforma = :id_plataforma AND IdParametro = :id_parametro";
            $stm = $PDO->prepare($sql);
            $stm->bindParam(":id_produto", $id_produto);
            $stm->bindParam(":id_plataforma", $id_plataforma);
            $stm->bindParam(":id_parametro", $id_parametro);
            $stm->execute();

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function update(produtoplataformaparametro $produtoplataformaparametro)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "UPDATE y_produto_plataforma_parametro SET ValorParametro = :ValorParametro
                    WHERE IdProduto = :id_produto AND IdPlataforma = :id_plataforma AND IdParametro = :id_parametro";
            $stm = $PDO->prepare($sql);

            $stm->bindValue(":id_produto", $produtoplataformaparametro->getIdProduto());
            $stm->bindValue(":id_plataforma", $produtoplataformaparametro->getIdPlataforma());
            $stm->bindValue(":id_parametro", $produtoplataformaparametro->getIdParametro());
            $stm->bindValue(":ValorParametro", $produtoplataformaparametro->getValorParametro());
            $stm->execute();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
