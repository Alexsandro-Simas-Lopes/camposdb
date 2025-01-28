<?php
require_once("../../produtos/model/produtodao.php");

class produto_listar
{
    public function __construct()
    {
        self::listar();
    }

    public static function listar()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $receivedData = file_get_contents("php://input");
        $dataJSON = json_decode($receivedData);
        $inputs = array();
        $pages = 0;
        if ($receivedData != "") {
            if (isset($dataJSON->name)) {
                $inputs['name_pesquisar'] = preg_replace('/[^\p{L}\p{N}\s\-]/u', '', $dataJSON->name);
            }
            if (isset($dataJSON->dorder)) {
                $inputs['dorder'] = $dataJSON->dorder;
            }
            if (isset($dataJSON->orderb)) {
                if ($dataJSON->orderb == "identificador") {
                    $inputs['orderb'] = "Id";
                } else if ($dataJSON->orderb == "status") {
                    $inputs['orderb'] = "DataExclusao";
                } else {
                    $inputs['orderb'] = $dataJSON->orderb;
                }
            }
            if (isset($dataJSON->entrada)) {
                $max_limit = '---';
                $start_limit = 0;

                $inputs['start_limit'] = $start_limit;
                $inputs['final_limit'] = $dataJSON->entrada;

                $currentpage = 1;
                if (isset($dataJSON->nextpage)) {
                    $currentpage = $dataJSON->nextpage;
                }
                $first_register = self::get_firstregister($dataJSON->entrada, $currentpage);
                $inputs['start_limit'] = $first_register - 1;

                $pages = produtodao::getCountPage($dataJSON->entrada, $inputs);
                $total =  produtodao::getCountPagination($inputs);
                $operator = produtodao::getFindByAllPagination($inputs);
                $recid = $start_limit;
                foreach ($operator as $op) {
                    $array = [
                        'recid' => $recid++,
                        'id' => $op->getId(),
                        'marca' => $op->getMarca(),
                        'name' => $op->getName(),
                        'img' => $op->getImg(),
                        'categoria' => $op->getCategoria(),
                        'sub_categoria' => $op->getSub_Categoria(),
                        'price' => $op->getPrice(),
                        'status_label' => $op->getStatusIndicator(),
                    ];
                    $max_limit = max($max_limit, $recid);
                    $sis_all_data[] = $array;
                };
                if (isset($inputs['descricao_pesquisar']) && !empty($total)) {
                    $pages = ceil($total / $dataJSON->entrada);
                }
                if (!empty($sis_all_data)) {
                    if (count($sis_all_data) == $inputs['final_limit']) {
                        $page_limit = $inputs['start_limit'] + $dataJSON->entrada;
                    } else {
                        $page_limit = count($sis_all_data) +  $inputs['start_limit'];
                    }
                    if ($page_limit > $total) {
                        $page_limit = $total;
                    }
                    echo json_encode([
                        'data' => $sis_all_data,
                        'pages' => $pages,
                        'total' => $total,
                        'start' => $first_register,
                        'limit' => $max_limit,
                        'pagelimit' => $page_limit,
                        'currentpage' => $currentpage
                    ]);
                } else {
                    echo json_encode([]);
                }
            } else {
                echo json_encode([]);
            }
        } else {
            echo json_encode([]);
        }
    }
    public static function get_firstregister($registerbypage, $next_page)
    {
        $last_page = ($next_page - 1) * $registerbypage;
        $first_register_next_page = $last_page + 1;
        return $first_register_next_page;
    }
}

new produto_listar();
