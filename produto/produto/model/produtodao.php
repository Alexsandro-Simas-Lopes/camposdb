<?php
require_once("../../../parametro/configDB/connectDB.php");
require_once("../../../produto/produto/model/produto.php");

class produtodao
{
    public static function getFindById($id): produto
    {
        try {
            $param['id'] = $id;
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM produto WHERE Id = :id";
            $stm = $PDO->prepare($sql);
            $stm->execute($param);
            $produto = $stm->fetchObject(produto::class);

            return empty($produto) ? new produto() : $produto;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function getFindByAll(array $input = null)
    {
        $param_where = '1=1';
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM produto WHERE $param_where ORDER BY Descricao ASC";
            $stm = $PDO->prepare($sql);
            $stm->execute();

            $results = array();

            while ($row = $stm->fetch(PDO::FETCH_OBJ)) {

                $objeto = new produto();

                $objeto->setId($row->Id);
                $objeto->setDescricao($row->Descricao);
                $objeto->setDataCadastro($row->DataCadastro);
                $objeto->setDataExclusao($row->DataExclusao);

                $results[] = $objeto;
            }
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function update(produto $produto)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "UPDATE produto set 
                        Descricao = :Descricao
                    WHERE Id = :Id";

            $stm = $PDO->prepare($sql);
            $stm->bindValue(":Id", $produto->getId());
            $stm->bindValue(":Descricao", $produto->getDescricao());
            $stm->execute();

            if ($stm->rowCount() > 0) {
                return $stm->rowCount();
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function insert(produto $produto)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "INSERT INTO produto (Id, Descricao) VALUE (:Id, :Descricao)";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(":Id", strtolower($produto->getId()));
            $stm->bindValue(":Descricao", $produto->getDescricao());
            $stm->execute();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function delete($Id)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "DELETE FROM produto WHERE Id =:Id";
            $stm = $PDO->prepare($sql);
            $stm->bindParam(":Id", $Id);
            $stm->execute();

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function getCountPage($page_length, array $input = null)
    {
        $param_where = '1=1';
        if (!empty($input['descricao_pesquisar'])) {
            $descricao_pesquisar = $input['descricao_pesquisar'];
            $param_where .= " AND (Descricao LIKE '%$descricao_pesquisar%' OR Id LIKE '%$descricao_pesquisar%')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT count(*) as register FROM produto WHERE $param_where";
            $stm = $PDO->prepare($sql);
            $stm->execute();

            $row = $stm->fetch(PDO::FETCH_OBJ);

            $pages = 0;
            $total_count = 0;
            if (!empty($row)) {
                $total_count = $row->register;
                $pages = ceil($total_count / $page_length);
            }
            return $pages;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getCountPagination(array $input = null)
    {
        $param_where = '1=1';
        if (!empty($input['descricao_pesquisar'])) {
            $descricao_pesquisar = $input['descricao_pesquisar'];
            $param_where .= " AND (Descricao LIKE '%$descricao_pesquisar%' OR Id LIKE '%$descricao_pesquisar%')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT count(*) as register FROM produto WHERE $param_where";
            $stm = $PDO->prepare($sql);
            $stm->execute();

            $row = $stm->fetch(PDO::FETCH_OBJ);

            $total_count = 0;
            if (!empty($row)) {
                $total_count = $row->register;
            }
            return $total_count;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getFindByAllPagination(array $input = null)
    {
        $orderby = '';
        $dorder = '';
        $orderb = '';

        $start_limit = $input['start_limit'];
        $start_final = $input['final_limit'];

        if (!empty($input['dorder'])) {
            $dorder = $input['dorder'];
        }
        if (!empty($input['orderb'])) {
            $orderb = $input['orderb'];
        }
        if (!empty($orderb) && !empty($dorder)) {
            $orderby = "ORDER BY $orderb $dorder";
        }
        $param_where = '1=1';
        if (!empty($input['descricao_pesquisar'])) {
            $descricao_pesquisar = $input['descricao_pesquisar'];
            $param_where .= " AND (Descricao LIKE '%$descricao_pesquisar%' OR Id LIKE '%$descricao_pesquisar%')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM produto WHERE $param_where $orderby LIMIT $start_limit, $start_final";
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            $results = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {

                $objeto = new produto();

                $objeto->setId($row->Id);
                $objeto->setDescricao($row->Descricao);
                $objeto->setDataCadastro($row->DataCadastro);
                $objeto->setDataExclusao($row->DataExclusao);

                $results[] = $objeto;
            }
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function get_options(array $inputs = null)
    {
        $opcoes = '<option value="" disabled selected>Nenhum produto disponível</option>';
        $selected = "";
        if (!empty($inputs['selected'])) {
            $selected = $inputs['selected'];
        }
        $busca_produto = self::getFindByAll($inputs);
        if (!empty($busca_produto)) {
            $opcoes = '<option value="" disabled selected >Selecione um produto</option>';
            foreach ($busca_produto as $produto) {
                $sel = $selected == $produto->getId() ? "selected" : "";
                $opcoes .= '<option value="' . $produto->getId() . '" ' . $sel . '>' . $produto->getDescricao() . '</option>';
            }
        }
        return $opcoes;
    }

    public static function verifica_existe_produto($Id)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT p.* FROM produto p WHERE p.Id = :Id";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(':Id', strtolower($Id));
            $stm->execute();
            $produto = $stm->fetchObject(produto::class);

            return empty($produto) ? new produto() : $produto;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function verifica_existe_produto_editar($id_produto, $descricao)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT p.* FROM produto p WHERE p.Descricao = :Descricao AND p.Id NOT IN (:id_produto)";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(':id_produto', $id_produto);
            $stm->bindValue(':Descricao', $descricao);

            $stm->execute();
            $produto = $stm->fetchObject(produto::class);

            return empty($produto) ? new produto() : $produto;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function busca_produto_cliente_assinatura($id_cliente)
    {
        $return_data = array();
        if (!empty($id_cliente)) {
            $busca_produto_cliente = self::busca_produto_cliente($id_cliente);
            if (!empty($busca_produto_cliente)) {
                if (isset($busca_produto_cliente['error_code'])) {
                    $return_data = $busca_produto_cliente;
                } else {
                    $return_data = array();
                    foreach ($busca_produto_cliente as $produto_cliente) {
                    }
                }
            }
        }
        return $return_data;
    }


    public static function busca_produto_cliente($id_cliente)
    {
        $return_data = array();
        if (!empty($id_cliente)) {
            $URL = AMBIENTE->URL_ISP_PRODUTO . '/isp/api/cliente/control/busca_produto_servico.php';
            $ch = curl_init($URL);
            $inputs = array(
                'documento' => $id_cliente
            );
            $postdata = json_encode($inputs);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if (!curl_errno($ch)) {
                $return_data = json_decode($response, true);
            }
        }
        return $return_data;
    }
}
