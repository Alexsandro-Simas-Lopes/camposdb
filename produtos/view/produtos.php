<?php
    // Inicialize a sessão
    session_start();
    // Verifique se o usuário está logado, caso contrário, redirecione para a página de login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../../public/home.php "); // Se não estiver logado volta para o Catalogo
        exit;
    }
    
    require_once("../../parametro/configDB/connectDB.php");

?>

<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>ProdutosCampos | Produtos</title>

        <link href="../../components/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../components/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="../../components/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

        <link href="../../components/css/animate.css" rel="stylesheet">
        <link href="../../components/css/style.css" rel="stylesheet">

    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="../../components/img/LOGO.png" style="max-width: 70%;" />
                                </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Produtos Campos</strong>
                                </span> <span class="text-muted text-xs block">Admin <b class="caret"></b></span> </span> </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <!-- <li><a href="../autenticacao/view/reset-password.php">Alterar senha</a></li>
                                    <li class="divider"></li> -->
                                    <li><a href="../../autenticacao/view/logout.php">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                <img alt="image" class="img-circle" src="../../components/img/LOGO.png" style="max-width: 70%;" />
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Tabela</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="http://localhost/camposdb/produtos/view/produtos.php">Produtos</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Catalogo Web</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a target="_blank" href="http://localhost/camposdb/public/home.php">Web Site</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <!-- <li>
                                <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                            </li> -->
                            <li>
                                <a href="../../autenticacao/view/logout.php">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>

                    </nav>
                </div>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Produtos</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a>Tabela</a>
                            </li>
                            <li class="active">
                                <strong>Produtos</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>

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
                                                <input id="search_produto" type="search" class="form-control input-sm" placeholder="Buscar por nome do produto (Min: 3 caracteres)" minlength="3" aria-controls="table_produto" onchange="search_datagrid_produto(this.value)" value="" style="width: 50%; float: left; margin-right: 5px;">
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
                                                <th data-i18n="" style="cursor: pointer;" onclick="set_order_table_produto('id')">
                                                    <div class="th_separator">
                                                        <span>ID</span>
                                                        <i class="bi bi-arrow-down-up" id="id_ordericon" target="default" order="id" name="orders_table"></i>
                                                    </div>
                                                </th>
                                                <th data-i18n="" style="cursor: pointer;" onclick="set_order_table_produto('name')">
                                                    <div class="th_separator">
                                                        <span>Nome</span>
                                                        <i class="bi bi-arrow-down-up" id="name_ordericon" target="default" order="name" name="orders_table"></i>
                                                    </div>
                                                </th>
                                                <th data-i18n="" style="cursor: pointer;" onclick="set_order_table_produto('price')">
                                                    <div class="th_separator">
                                                        <span>Preço</span>
                                                        <i class="bi bi-arrow-down-up" id="price_ordericon" target="default" order="price" name="orders_table"></i>
                                                    </div>
                                                </th>
                                                <th data-i18n="" style="cursor: pointer;" onclick="set_order_table_produto('marca')">
                                                    <div class="th_separator">
                                                        <span>Marca</span>
                                                        <i class="bi bi-arrow-down-up" id="marca_ordericon" target="default" order="marca" name="orders_table"></i>
                                                    </div>
                                                </th>
                                                <th data-i18n="" style="cursor: pointer;" onclick="set_order_table_produto('categoria')">
                                                    <div class="th_separator">
                                                        <span>Categoria</span>
                                                        <i class="bi bi-arrow-down-up" id="categoria_ordericon" target="default" order="categoria" name="orders_table"></i>
                                                    </div>
                                                </th>
                                                <th data-i18n="" style="cursor: pointer;" onclick="set_order_table_produto('img')">
                                                    <div class="th_separator">
                                                        <span>Imagem</span>
                                                        <i class="bi bi-arrow-down-up" id="img_ordericon" target="default" order="img" name="orders_table"></i>
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
            
                <div class="footer">
                    <div class="pull-right">
                        Produtos Campos <strong>ADM</strong>.
                    </div>
                    <div>
                        <strong>Copyright</strong> 2024 &copy; | Designed by Rugido Digital 
                    </div>
                </div>
            </div>
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

        <!-- Mainly scripts -->
        <script src="../../components/js/jquery-3.1.1.min.js"></script>
        <script src="../../components/js/bootstrap.min.js"></script>
        <script src="../../components/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../../components/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="../../components/js/plugins/dataTables/datatables.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="../../components/js/inspinia.js"></script>
        <script src="../../components/js/plugins/pace/pace.min.js"></script>

        <!-- Page-Level Scripts -->
        <script src="../../produtos/ajax/produtos.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('name_ordericon').click();
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

    </body>

</html>
