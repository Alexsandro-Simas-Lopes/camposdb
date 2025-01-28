<?php
require_once("../../../parametro/define/configtemplates.php");

$breadcumbRP = "Autenticação e Reconhecimento";
$breadcumbra  = "Produtos";

require_once ConfigTemplates::HEADER_TEMPLATE;
?>

<div id="wrapper">
    <?php require_once ConfigTemplates::MENU_LATERAL ?>

    <style>
        .th_separator {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }

        #table_produto th:nth-child(1),
        #table_produto td:nth-child(1) {
            display: none;
        }

        #table_produto>thead>tr>th {
            background-color: white;
        }

        #table_produto>thead>tr>th>div>i {
            color: gainsboro;
        }

        #table_produto>thead>tr>th>div>i {
            font-size: 1.3em;
        }

        #search_produto:focus {
            border-color: rgb(38 79 159 / 100%) !important;
        }

        .modal-to-window {
            width: 100vw !important;
            height: 100vh !important;
            margin: 0px !important;
        }

        .modal-to-window-content {
            background-color: #f1f3f7 !important;
            min-height: 100vh !important;
        }

        .in {
            padding-left: 0px !important;
        }
    </style>

    <div id="page-wrapper" class="gray-bg">
        <?php require_once ConfigTemplates::CABECALHO ?>
        <?php require_once ConfigTemplates::BREADCRUMB ?>



        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content language-json">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="text-left">
                                        <button type="button" disabled="" class="btn btn-sm btn-primary" style="cursor: default !important; height: 30.0px; margin-bottom: 0px; margin-right: 0px; border-bottom-right-radius: 0; border-top-right-radius: 0; float: left; opacity:100%; background-color:rgb(38 79 159 / 100%)!important; border-color: rgb(38 79 159 / 100%)!important;">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input id="search_produto" type="search" class="form-control input-sm" placeholder="Buscar por Código / Descrição (Min: 3 caracteres)" minlength="3" aria-controls="table_produto" onchange="search_datagrid_produto(this.value)" value="" style="width: 50%; float: left; margin-right: 5px;">
                                        <button type="button" class="btn btn-sm btn-default" style="height: 30.0px; margin-bottom: 0px; border-radius: 3px; background: white !important; float: left;" title="Recarregar" onclick="reset_busca_produto()">
                                            <i class="fa fa-refresh" aria-hidden="false"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="add_produto()" style="border:none !important;"><i class="fa fa-plus" aria-hidden="true"></i> Novo produto</button>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_produto" page='1'>
                                <thead>
                                    <tr>
                                        <th style="background-color: white !important;" data-i18n=""></th>
                                        <th data-i18n="" style="cursor: pointer; width: 20%;" onclick="set_order_table_produto('identificador')">
                                            <div class="th_separator">
                                                <span>Código</span>
                                                <i class="bi bi-arrow-down-up" id="identificador_ordericon" target="default" order="identificador" name="orders_table"></i>
                                            </div>
                                        </th>
                                        <th data-i18n="" style="cursor: pointer;" onclick="set_order_table_produto('descricao')">
                                            <div class="th_separator">
                                                <span>Descrição</span>
                                                <i class="bi bi-arrow-down-up" id="descricao_ordericon" target="default" order="descricao" name="orders_table"></i>
                                            </div>
                                        </th>
                                        <th data-i18n="" style="cursor: pointer;" onclick="set_order_table_produto('status')">
                                            <div class="th_separator">
                                                <span>Status</span>
                                                <i class="bi bi-arrow-down-up" id="status_ordericon" target="default" order="status" name="orders_table"></i>
                                            </div>
                                        </th>
                                        <th data-i18n="">
                                            <center>Ações</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td colspan="4"><span id="find_indicator"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="table_produto_info" role="status" aria-live="polite">Mostrando <span id="cont_inicio_paginacao">0</span> a <span id="cont_fim_paginacao">0</span> de <span id="cont_total_paginacao">0</span> entradas </div>
                                </div>
                                <div class="col-sm-7" style="display: flex; justify-content: flex-end; align-items: center;">
                                    <div style="margin-right: 12px; display: flex; justify-content: flex-end; align-items: center;">
                                        <span>Mostrar</span>&nbsp;
                                        <select id="table_produto_length" class="form-control" style="width: 70px" onchange="restart_lenght_table_produto()">
                                            <option value="10" selected>10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>&nbsp;
                                        <span>entradas</span>
                                    </div>
                                    <div class="dataTables_paginate paging_simple_numbers" id="table_produto_paginate">
                                        <ul class="pagination" id="paginacao_table_produto" style="margin: 0">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="wrapper wrapper-content animated fadeIn"></div>

        <?php require_once ConfigTemplates::RODAPE_TEMPLATE ?>

    </div>

    <div class="modal" id="modal_window" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: hidden !important;">
        <div class="modal-dialog modal-lg modal-to-window">
            <div class="modal-content modal-to-window-content modal-content animated bounceInUp">...</div>
        </div>
    </div>

    <div class="modal" id="modal" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">...</div>
        </div>
    </div>

    <script src="../../../produto/produto/ajax/produto.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('descricao_ordericon').click();
        });

        $(document).on('click', '.collapse-link', function() {
            var ibox = $(this).closest('div.ibox');
            var button = $(this).find('i');
            var content = ibox.children('.ibox-content');
            content.slideToggle(200);
            button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
            ibox.toggleClass('').toggleClass('border-bottom');
            setTimeout(function() {
                ibox.resize();
                ibox.find('[id^=map-]').resize();
            }, 50);
        });

        $(document).on('click', '.close-link', function() {
            var content = $(this).closest('div.ibox');
            content.remove();
        });
    </script>

</div>


<?php require_once ConfigTemplates::FOOTER_TEMPLATE ?>