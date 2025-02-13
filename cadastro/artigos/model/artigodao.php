<?php
require_once("../../../parametro/configDB/connectDB.php");
require_once("../../../cadastro/artigos/model/artigos.php");


//and Marca = :Marca and Name = :Name and Img = :Img and Categoria = :Categoria and Sub_Categoria = :Sub_Categoria and Price = :Price
class artigodao
{
    public static function getFindById($id): artigos
    {
        try {
            $param['id'] = $id;
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM artigos WHERE Id = :id";
            $stm = $PDO->prepare($sql);
            $stm->execute($param);
            $artg = $stm->fetchObject(artigos::class);

            return empty($artg) ? new artigos() : $artg;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getFindByAll(array $input = null)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM artigos ORDER BY Titulo ASC";
            $stm = $PDO->prepare($sql);
            $stm->execute();

            $results = [];

            while ($row = $stm->fetch(PDO::FETCH_OBJ)) {
                $objeto = new artigos();
                $objeto->setId($row->Id);
                $objeto->setTitulo($row->Titulo);
                $objeto->setResumo($row->Resumo);
                $objeto->setConteudo($row->Conteudo);
                $objeto->setStatus($row->Status);
                $objeto->setEnviado_em($row->Enviado_em);
                $objeto->setAtualizado_em($row->Atualizado_em);

                $results[] = $objeto;
            }

            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function update(artigos $artg)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "UPDATE artigos SET 
                    Titulo = :Titulo, 
                    Resumo = :Resumo,
                    Conteudo = :Conteudo,
                    Status = :Status, 
                    Enviado_em = :Enviado_em, 
                    Atualizado_em = :Atualizado_em
                WHERE Id = :Id";

            $stm = $PDO->prepare($sql);
            $stm->bindValue(":Id", $artg->getId());
            $stm->bindValue(":Titulo", $artg->getTitulo());
            $stm->bindValue(":Resumo", $artg->getResumo());
            $stm->bindValue(":Conteudo", $artg->getConteudo());
            $stm->bindValue(":Status", $artg->getStatus());
            $stm->bindValue(":Enviado_em", $artg->getEnviado_em());
            $stm->bindValue(":Atualizado_em", $artg->getAtualizado_em());
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

    public static function insert(artigos $artg)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "INSERT INTO artigos (Titulo, Resumo, Conteudo, Status, Enviado_em, Atualizado_em) 
                    VALUES (:Titulo, :Resumo, :Conteudo, :Status, :Enviado_em, :Atualizado_em)";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(":Titulo", $artg->getTitulo());
            $stm->bindValue(":Resumo", $artg->getResumo());
            $stm->bindValue(":Conteudo", $artg->getConteudo());
            $stm->bindValue(":Status", $artg->getStatus());
            $stm->bindValue(":Enviado_em", $artg->getEnviado_em());
            $stm->bindValue(":Atualizado_em", $artg->getAtualizado_em());
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
            $sql = "DELETE FROM artigos WHERE Id =:Id";
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
        if (!empty($input['name_pesquisar'])) {
            $name_pesquisar = $input['name_pesquisar'];
            $param_where .= " AND (Name LIKE '%$name_pesquisar%' OR Id LIKE '%$name_pesquisar%')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT count(*) as register FROM artigos WHERE $param_where";
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
        if (!empty($input['name_pesquisar'])) {
            $name_pesquisar = $input['name_pesquisar'];
            $param_where .= " AND (Name LIKE '%$name_pesquisar%' OR Id LIKE '%$name_pesquisar%')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT count(*) as register FROM artigos WHERE $param_where";
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
        if (!empty($input['name_pesquisar'])) {
            $name_pesquisar = $input['name_pesquisar'];
            $param_where .= " AND (Name LIKE '%$name_pesquisar%' OR Id LIKE '%$name_pesquisar%')";
        }
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT * FROM artigos WHERE $param_where $orderby LIMIT $start_limit, $start_final";
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            $results = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {

                $objeto = new artigos();

                $objeto->setId($row->Id);
                $objeto->setTitulo($row->Titulo);
                $objeto->setResumo($row->Resumo);
                $objeto->setConteudo($row->Conteudo);
                $objeto->setStatus($row->Status);
                $objeto->setEnviado_em($row->Enviado_em);
                $objeto->setAtualizado_em($row->Atualizado_em);

                $results[] = $objeto;
            }
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function get_options(array $inputs = null)
    {
        $opcoes = '<option value="" disabled selected>Nenhum artigo disponível</option>';
        $selected = "";
        if (!empty($inputs['selected'])) {
            $selected = $inputs['selected'];
        }
        $busca_artigo = self::getFindByAll($inputs);
        if (!empty($busca_artigo)) {
            $opcoes = '<option value="" disabled selected >Selecione um artigo</option>';
            foreach ($busca_artigo as $artg) {
                $sel = $selected == $artg->getId() ? "selected" : "";
                $opcoes .= '<option value="' . $artg->getId() . '" ' . $sel . '>' . $artg->getTitulo() . '</option>';
            }
        }
        return $opcoes;
    }

    public static function verifica_existe_artigo($Id)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT p.* FROM artigos p WHERE p.Id = :Id";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(':Id', strtolower($Id));
            $stm->execute();
            $artg = $stm->fetchObject(artigos::class);

            return empty($artg) ? new artigos() : $artg;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function verifica_existe_artigo_editar($id_artigo, $titulo)
    {
        try {
            $PDO = connectDB::getInstance();
            $sql = "SELECT p.* FROM artigos p WHERE p.Titulo = :Titulo AND p.Id NOT IN (:id_artigo)";
            $stm = $PDO->prepare($sql);
            $stm->bindValue(':id_artigo', $id_artigo);
            $stm->bindValue(':Titulo', $titulo);

            $stm->execute();
            $artg = $stm->fetchObject(artigos::class);

            return empty($artg) ? new artigos() : $artg;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
