<?php
require_once("../../../identificacao/configDB/connectDB.php");
require_once("../../../produto/identificacao/model/identificacao.php");

class identificacaodao
{
    public static function getFindById($id): identificacao
    {
        try {
            $param['id'] = $id;
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM identificacao WHERE Id = :id";
            $stm = $PDO->prepare($sql);
            $stm->execute($param);
            $identificacao = $stm->fetchObject(identificacao::class);

            return empty($identificacao) ? new identificacao() : $identificacao;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public static function getFindByAll(array $input = null)
    {
        $param_where = "1=1";
        if (!empty($input['not_in'])) {
            $not_in = $input['not_in'];
            $param_where .= " AND idt.Id NOT IN ($not_in)";
        }
        if (!empty($input['not_find_produto'])) {
            $not_find_produto = $input['not_find_produto'];
            $param_where .= " AND idt.Id NOT IN (SELECT ypi.IdIdentificacao FROM y_produto_identificacao ypi WHERE ypi.IdProduto = '$not_find_produto')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT idt.* FROM identificacao idt WHERE $param_where ORDER BY Descricao ASC";
            $stm = $PDO->prepare($sql);
            $stm->execute();

            $results = array();

            while ($row = $stm->fetch(PDO::FETCH_OBJ)) {

                $objeto = new identificacao();

                $objeto->setId($row->Id);
                $objeto->setDescricao($row->Descricao);
                $objeto->setDataCadastro($row->DataCadastro);

                $results[] = $objeto;
            }
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function update(identificacao $identificacao)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "UPDATE identificacao set 
                        Descricao = :Descricao
                    WHERE Id = :Id";

            $stm = $PDO->prepare($sql);
            $stm->bindValue(":Id", $identificacao->getId());
            $stm->bindValue(":Descricao", $identificacao->getDescricao());
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

    public static function insert(identificacao $identificacao)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "INSERT INTO identificacao (Descricao) VALUE (:Descricao)";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(":Descricao", $identificacao->getDescricao());
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
            $sql = "DELETE FROM identificacao WHERE Id =:Id";
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
            $param_where .= " AND (Descricao LIKE '%$descricao_pesquisar%')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT count(*) AS register FROM parametro WHERE $param_where";
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
            $param_where .= " AND (Descricao LIKE '%$descricao_pesquisar%')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT count(*) AS register FROM identificacao WHERE $param_where";
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
            $param_where .= " AND (Descricao LIKE '%$descricao_pesquisar%')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM identificacao WHERE $param_where $orderby LIMIT $start_limit, $start_final";
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            $results = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {

                $objeto = new identificacao();

                $objeto->setId($row->Id);
                $objeto->setDescricao($row->Descricao);
                $objeto->setDataCadastro($row->DataCadastro);

                $results[] = $objeto;
            }
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function get_options(array $inputs = null)
    {
        $opcoes = '<option value="" disabled selected>Nenhuma identificação disponível</option>';
        $selected = "";
        if (!empty($inputs['selected'])) {
            $selected = $inputs['selected'];
        }
        if (isset($inputs['not_find'])) {
            if (!empty($inputs['not_find'])) {
                $not_in = array_map(function ($item) {
                    return '(' . $item['identificacao_selecionado'] . ')';
                }, $inputs['not_find']);
                $not_in = implode(', ', $not_in);
                $inputs['not_in'] = $not_in;
            }
        }
        $busca_identificacao = self::getFindByAll($inputs);
        if (!empty($busca_identificacao)) {
            $opcoes = '<option value="" disabled selected >Selecione</option>';
            foreach ($busca_identificacao as $identificacao) {
                $sel = $selected == $identificacao->getId() ? "selected" : "";
                $opcoes .= '<option value="' . $identificacao->getId() . '" ' . $sel . '>' . $identificacao->getDescricao() . '</option>';
            }
        }
        return $opcoes;
    }

    public static function verifica_existe_identificacao($descricao_pesquisar)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT p.* FROM identificacao p WHERE p.Descricao = :Descricao";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(':Descricao', $descricao_pesquisar);
            $stm->execute();
            $identificacao = $stm->fetchObject(identificacao::class);

            return empty($identificacao) ? new identificacao() : $identificacao;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public static function verifica_existe_identificacao_editar($id, $descricao_pesquisar)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT p.* FROM identificacao p WHERE p.Descricao = :Descricao AND p.id NOT IN (:id) ";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(':id', $id);
            $stm->bindValue(':Descricao', $descricao_pesquisar);
            $stm->execute();
            $identificacao = $stm->fetchObject(identificacao::class);

            return empty($identificacao) ? new identificacao() : $identificacao;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
