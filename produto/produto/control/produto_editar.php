<?php
require_once("../../../produto/produto/model/produtodao.php");
$receivedData = file_get_contents("php://input");
$dataJSON = json_decode($receivedData);
$produto = produtodao::getFindById($dataJSON->id);

?>
<style>
    .modal-header-windown {
        border: none !important;
        position: fixed !important;
        top: 0 !important;
        width: 100% !important;
        z-index: 999999 !important;
        background-color: #ffffff !important;
        border-bottom: 2px solid #dcdfe5 !important;
    }

    .modal-body-windown {
        margin-top: 60px !important;
        margin-bottom: 60px !important;
        overflow-y: auto !important;
        max-height: calc(100vh - 120px) !important;
        background-color: #f1f3f7 !important;
        scroll-behavior: smooth !important;
    }

    .modal-footer-windown {
        border: none !important;
        position: fixed !important;
        bottom: 0 !important;
        width: 100% !important;
        z-index: 99999 !important;
        background-color: #ffffff !important;
        border-top: 2px solid #dcdfe5 !important;
    }

    .separte_buttons {
        display: flex;
        justify-content: space-between;
    }

    .ibox-content-windown {
        border-radius: 5px;
        border: 1px solid white !important;
        background-color: white !important;
    }

    #table_adicionar_identificacao_editar>thead>tr>th {
        background-color: white;
    }

    #table_adicionar_identificacao_editar>thead>tr>th>div>i {
        color: gainsboro;
    }

    #table_adicionar_parametro_editar>thead>tr>th {
        background-color: white;
    }

    #table_adicionar_parametro_editar>thead>tr>th>div>i {
        color: gainsboro;
    }
</style>
<div class="modal-header modal-header-windown">
    <div style="display: flex; justify-content: space-between;">
        <h4 class="modal-title" style="font-weight: 600; font-size: 25px; color: black; margin-left: 15px;">Alterar produto</h4>
        <div style="display: flex; align-items: center; gap: 25px;">
            <div style="display:flex; margin-top: 5px; gap: 15px;">
                <a name="#section1" onclick="verify_expand(this.name)">
                    Dados do produto
                </a>
                <a name="#section2" onclick="verify_expand(this.name)">
                    Identificações
                </a>
                <a name="#section3" onclick="verify_expand(this.name)">
                    Parâmetros
                </a>
            </div>
            <button type="button" class="close" data-dismiss="modal" style="font-size: 30px !important; margin-top: 5px; margin-right: 15px; color:#ec4758; opacity: 100% !important;">&times;</button>
        </div>
    </div>
</div>
<div class="modal-body modal-body-windown">
    <input type="hidden" name="id_produto_editar" id="id_produto_editar" value="<?= $produto->getId(); ?>">
    <div class="ibox float-e-margins border-bottom" style="color: black;" id="section1">
        <div class="ibox-title">
            <h5 style="font-size: 15px; font-weight: 1000;">Dados do produto</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up" name="expand_section" id="expand_section1"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content" name="content_section1" id="dados_gerais_container">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <div style="font-size: 13px;">
                            <label for="status_produto">Status: </label>
                            <?= $produto->getStatusIndicator() ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="identificador">Código: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="identificador" id="identificador" style="background-color: white" maxlength="20" readonly value="<?= $produto->getId(); ?>">
                        <span style="font-size: 12px;">&nbsp;(Não pode ser alterado)</span>
                        <label for="identificador" id="identificador_error" class="error" style="display: none;">Não pode estar vazio</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="descricao_editar">Descrição: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="descricao_editar" id="descricao_editar" value="<?= $produto->getDescricao(); ?>" maxlength="100">
                        <label for="descricao_editar" id="descricao_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 25px;">
                <div class="col-lg-12">
                    <span style="color: red;"><strong>*</strong> Campos obrigatórios </span>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins border-bottom" style="color: black;" id="section2">
        <div class="ibox-title">
            <h5 style="font-size: 15px; font-weight: 1000;">Identificações</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up" name="expand_section" id="expand_section2"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content" name="content_section2" id="identificacao_container">
            <div class="row">
                <div class="col-lg-2">
                    <div style="display: flex; margin-top: 80px; justify-content: end;">
                        <strong>
                            Identificações incluídas ao produto:
                        </strong>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group" style="margin-top: 1px;">
                                <label for="identificacao_escolha_editar">Selecione uma identificação: <span style="color: red;">*</span></label>
                                <select name="identificacao_escolha_editar" id="identificacao_escolha_editar" class="form-control chosen-select-identificacao" onchange="">
                                    <option value="" selected disabled>Selecione</option>
                                </select>
                                <label for="identificacao_escolha_editar" id="identificacao_escolha_editar_error" class="error" style="display: none;">Não pode estar vazio</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="action_adicionar_identificacao">&nbsp;</label>
                            <button type="button" class="btn btn-success" id="action_adicionar_identificacao" data-toggle="modal" onclick="incluir_identificacao_editar()" style="background: #18a689; border: 1px solid #18a689; width: 100%;">
                                <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" style="max-height: 200px !important;">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="table_adicionar_identificacao_editar">
                                    <thead>
                                        <tr>
                                            <th style="width: 70%;">
                                                Descrição
                                            </th>
                                            <th style="width: 30%;">
                                                <center>Remover Identificação</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="bg-muted p-xs" id="indicator_view">
                                <div style="display: flex; align-items: right; justify-content: space-between; margin-top: 2px;">
                                    <div>
                                        Quantidade de Identificações: <span id="count_indicator_identificacao_editar" style="color:black; font-weight: 900;">0</span> <span id="alert_grupo_identificacao" style="display: none; color:red">(No mínimo uma identificação)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins border-bottom" style="color: black;" id="section3">
        <div class="ibox-title">
            <h5 style="font-size: 15px; font-weight: 1000;">Parâmetros</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up" name="expand_section" id="expand_section3"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content" name="content_section3" id="parametro_container">
            <div class="row">
                <div class="col-lg-2">
                    <div style="display: flex; margin-top: 80px; justify-content: end;">
                        <strong>
                            Parâmetros incluídos ao produto:
                        </strong>
                    </div>
                </div>
                <div class="col-lg-10">
                    <span id="error_parametro_incluido" style="display: none; color:red"><i class="bi bi-exclamation-triangle"></i><strong> Parâmetro já incluido</strong></span>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group" style="margin-top: 1px;">
                                <label for="plataforma_escolha">Selecione uma plataforma: <span style="color: red;">*</span></label>
                                <select name="plataforma_escolha" id="plataforma_escolha" class="form-control chosen-select-plataforma" onchange="">
                                    <option value="" selected disabled>Selecione</option>
                                </select>
                                <label for="plataforma_escolha" id="plataforma_escolha_error" class="error" style="display: none;">Não pode estar vazia</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group" style="margin-top: 1px;">
                                <label for="parametro_escolha">Selecione um parâmetro: <span style="color: red;">*</span></label>
                                <select name="parametro_escolha" id="parametro_escolha" class="form-control chosen-select-parametro" onchange="">
                                    <option value="" selected disabled>Selecione</option>
                                </select>
                                <label for="parametro_escolha" id="parametro_escolha_error" class="error" style="display: none;">Não pode estar vazio</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="valor_parametro">Valor: <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" maxlength="100" name="valor_parametro" id="valor_parametro" placeholder="Valor">
                                <label for="valor_parametro" id="valor_parametro_error" class="error" style="display: none;">Não pode estar vazio</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="action_adicionar_parametro">&nbsp;</label>
                            <button type="button" class="btn btn-success" id="action_adicionar_parametro" data-toggle="modal" onclick="incluir_parametro_editar()" style="background: #18a689; border: 1px solid #18a689; width: 100%;">
                                <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" style="max-height: 200px !important;">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="table_adicionar_parametro_editar">
                                    <thead>
                                        <tr>
                                            <th style="width: 25%;">
                                                Plataforma
                                            </th>
                                            <th style="width: 30%;">
                                                Parâmetro
                                            </th>
                                            <th style="width: 25%;">
                                                Valor
                                            </th>
                                            <th style="width: 20%;">
                                                <center>Remover Parâmetro</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                                            <td colspan="4">
                                                <center>Nenhum parâmetro incluído</center>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="bg-muted p-xs" id="indicator_view_parametro">
                                <div style="display: flex; align-items: right; justify-content: space-between; margin-top: 2px;">
                                    <div>
                                        Quantidade de Parâmetros: <span id="count_indicator_parametro_editar" style="color:black; font-weight: 900;">0</span> <span id="alert_grupo_parametro" style="display: none; color:red">(No mínimo um parâmetro)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer modal-footer-windown">
    <div class="separte_buttons">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary" id="editar_produto_action" onclick="salvar_alteracao_editar()">Salvar Alteração</button>
    </div>
</div>

<script>
    busca_identificacao_produto()
    carrega_identificacao_produto()
    busca_plataforma_produto()
    busca_parametro_produto()
    carrega_parametro_produto()

    function busca_identificacao_produto(data_search = {}) {
        document.getElementById("identificacao_escolha_editar").innerHTML = '<option value="" selected disabled>Sem identificações disponíveis</option>'
        $('.chosen-select-identificacao').trigger('chosen:updated');
        if (document.getElementById("id_produto_editar").value) {
            data_search.not_find_produto = document.getElementById("id_produto_editar").value
            fetch('../../../produto/identificacao/control/identificacao_options.php', {
                    method: 'POST',
                    body: JSON.stringify(data_search),
                })
                .then((response) => response.text())
                .then((conteudo) => {
                    if (conteudo) {
                        document.getElementById("identificacao_escolha_editar").innerHTML = conteudo
                        $('.chosen-select-identificacao').chosen({
                            width: "100%"
                        });
                        $('.chosen-select-identificacao').trigger('chosen:updated');
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        }

    }

    function carrega_identificacao_produto() {
        if (document.getElementById("id_produto_editar").value) {
            const tabela = document.getElementById('table_adicionar_identificacao_editar');
            const tbody = tabela.querySelector('tbody');
            let data_search = {
                id_produto: document.getElementById("id_produto_editar").value
            };
            fetch('../../../produto/produtoidentificacao/control/produtoidentificacao_byproduto.php', {
                    method: 'POST',
                    body: JSON.stringify(data_search),
                })
                .then((response) => response.text())
                .then((content) => {
                    tbody.innerHTML = content
                    document.getElementById("count_indicator_identificacao_editar").innerHTML = tabela.querySelectorAll('tr[recid-identificacao-class-editar]').length;
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    function incluir_identificacao_editar() {
        let exec = 0

        let identificacao_selecionado = document.getElementById("identificacao_escolha_editar").value
        if (identificacao_selecionado) {
            exec++;
        } else {
            document.getElementById("identificacao_escolha_editar_error").style.display = "block"
            document.getElementById("identificacao_escolha_editar_chosen").style.border = "1px solid red"
            setTimeout(() => {
                document.getElementById("identificacao_escolha_editar_error").style.display = "none"
                document.getElementById("identificacao_escolha_editar_chosen").style.border = "none"
            }, 2300);
        }
        if (document.getElementById("id_produto_editar").value) {
            exec++;
        } else {
            fechar_window();
            mostrar_mensagem('Houve um erro (Tente novamente)')
            listarproduto();
        }
        if (exec === 2) {
            fetch('../../../produto/produtoidentificacao/control/produtoidentificacao_adicionar_action.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_produto_editar: document.getElementById("id_produto_editar").value.trim(),
                        identificacao_selecionado: identificacao_selecionado
                    })
                })
                .then((response) => response.text())
                .then((data) => {
                    carrega_identificacao_produto()
                    busca_identificacao_produto()
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    function remover_identificacao_lista_editar(id_remover_identificacao) {
        if (id_remover_identificacao) {
            let tr = document.querySelector('tr[recid-identificacao-class-editar="' + id_remover_identificacao + '"]');
            let td = tr.querySelector('td');
            let texto_identificacao = td.textContent.trim();

            let content = `
            <div class="modal-header">
                <center><h3 class="modal-title" ><i class="bi bi-exclamation-triangle"></i> Aviso</h3></center>
            </div>
            <div class="modal-body">
                <center>
                <h4> 
                    Remover a identificação <br> <strong>` + texto_identificacao + ` </strong> <br> do produto ?
                </h4>
                </center>
            </div>
            <div class="modal-footer">
                <center>
                        <button type="button" class="btn btn-primary" onclick="remover_identificacao('${id_remover_identificacao}', '` + texto_identificacao + `')" >Sim</button>
                        <button class="btn btn-danger" type="button" onclick="fechar_modal()">Não</button>
                </center>
            </div>
            `;
            $('#modal').modal('show');
            $('#modal').find('.modal-content').html(content);
            $('#modal').modal('show');
        }
    }

    function remover_identificacao(id_remover, text = "") {
        if (id_remover) {
            fetch('../../../produto/produtoidentificacao/control/produtoidentificacao_remover_action.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id_produto_remover: id_remover
                    })
                })
                .then((response) => response.text())
                .then((data) => {
                    fechar_modal()
                    carrega_identificacao_produto()
                    busca_identificacao_produto()
                    setTimeout(() => {
                        if (data.trim()) {
                            show_error_modal_produto(data, text)
                        }
                    }, 5);
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    function fechar_modal() {
        $('#modal').modal('hide');
        if ($('#modal_window').hasClass('in')) {
            setTimeout(() => {
                $('body').addClass('modal-open').css('padding-right', '14px');
            }, 15);
        } else {
            $('body').css('padding-right', '0').removeClass('modal-open');
        }
    }

    function busca_plataforma_produto(data_search = {}) {
        document.getElementById("plataforma_escolha").innerHTML = '<option value="" selected disabled>Sem plataformas disponíveis</option>'
        $('.chosen-select-plataforma').trigger('chosen:updated');
        fetch('../../../cadastro/plataforma/control/plataforma_options.php', {
                method: 'POST',
                body: JSON.stringify(data_search),
            })
            .then((response) => response.text())
            .then((conteudo) => {
                if (conteudo) {
                    document.getElementById("plataforma_escolha").innerHTML = conteudo
                    $('.chosen-select-plataforma').chosen({
                        width: "100%"
                    });
                    $('.chosen-select-plataforma').trigger('chosen:updated');
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    function busca_parametro_produto(data_search = {}) {
        document.getElementById("parametro_escolha").innerHTML = '<option value="" selected disabled>Sem parâmetros disponíveis</option>'
        $('.chosen-select-parametro').trigger('chosen:updated');
        fetch('../../../cadastro/parametro/control/parametro_options.php', {
                method: 'POST',
                body: JSON.stringify(data_search),
            })
            .then((response) => response.text())
            .then((conteudo) => {
                if (conteudo) {
                    document.getElementById("parametro_escolha").innerHTML = conteudo
                    $('.chosen-select-parametro').chosen({
                        width: "100%"
                    });
                    $('.chosen-select-parametro').trigger('chosen:updated');
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    function carrega_parametro_produto() {
        if (document.getElementById("id_produto_editar").value) {
            const tabela = document.getElementById('table_adicionar_parametro_editar');
            const tbody = tabela.querySelector('tbody');
            let data_search = {
                id_produto: document.getElementById("id_produto_editar").value
            };
            fetch('../../../produto/produtoplataformaparametro/control/produtoplataformaparametro_byproduto.php', {
                    method: 'POST',
                    body: JSON.stringify(data_search),
                })
                .then((response) => response.text())
                .then((content) => {
                    tbody.innerHTML = content
                    document.getElementById("count_indicator_parametro_editar").innerHTML = tabela.querySelectorAll('tr[recid-parametro-produto-class-editar]').length;
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    function incluir_parametro_editar() {
        let exec = 0

        const tabela = document.getElementById('table_adicionar_parametro_editar');
        const tbody = tabela.querySelector('tbody');

        let plataforma_selecionado = document.getElementById("plataforma_escolha")
        let parametro_escolha = document.getElementById("parametro_escolha")
        let valor_parametro = document.getElementById("valor_parametro").value

        if (plataforma_selecionado.value) {
            exec++
        } else {
            document.getElementById("plataforma_escolha_error").style.display = "block"
            document.getElementById("plataforma_escolha_chosen").style.border = "1px solid red"
            setTimeout(() => {
                document.getElementById("plataforma_escolha_error").style.display = "none"
                document.getElementById("plataforma_escolha_chosen").style.border = "none"
            }, 2300);
        }

        if (parametro_escolha.value) {
            exec++
        } else {
            document.getElementById("parametro_escolha_error").style.display = "block"
            document.getElementById("parametro_escolha_chosen").style.border = "1px solid red"
            setTimeout(() => {
                document.getElementById("parametro_escolha_error").style.display = "none"
                document.getElementById("parametro_escolha_chosen").style.border = "none"
            }, 2300);
        }

        if (valor_parametro.trim()) {
            exec++
            valor_parametro = valor_parametro.trim();
        } else {
            document.getElementById("valor_parametro").style.border = "1px solid red"
            document.getElementById("valor_parametro_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("valor_parametro").style.border = "1px solid #e5e6e7"
                document.getElementById("valor_parametro_error").style.display = "none"
            }, 2300);
        }

        if (document.getElementById("id_produto_editar").value) {
            exec++;
        } else {
            fechar_window();
            mostrar_mensagem('Houve um erro (Tente novamente)')
            listarproduto();
        }

        if (exec === 4) {
            fetch('../../../produto/produtoplataformaparametro/control/produtoplataformaparametro_adicionar_action.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_produto: document.getElementById("id_produto_editar").value,
                        plataforma_selecionado: plataforma_selecionado.value.trim(),
                        parametro_escolha: parametro_escolha.value.trim(),
                        valor_parametro: valor_parametro.trim()
                    })
                })
                .then((response) => response.text())
                .then((data) => {
                    busca_plataforma_produto()
                    busca_parametro_produto()
                    document.getElementById("valor_parametro").value = "";
                    carrega_parametro_produto()
                    if (data.trim() == "400") {
                        document.getElementById("error_parametro_incluido").style.display = "block"
                        setTimeout(() => {
                            document.getElementById("error_parametro_incluido").style.display = "none"
                        }, 2400);
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    function remover_parametro_lista_editar(id_remover_parametro) {
        if (id_remover_parametro) {
            // let tr = document.querySelector('tr[recid-parametro-produto-class-editar="' + id_remover_parametro + '"]');
            // let td = tr.querySelector('td');
            // let texto_identificacao = td.textContent.trim();
            let content = `
            <div class="modal-header">
                <center><h3 class="modal-title" ><i class="bi bi-exclamation-triangle"></i> Aviso</h3></center>
            </div>
            <div class="modal-body">
                <center>
                <h4> 
                   Remover <strong>parâmetro</strong> do produto ?
                </h4>
                </center>
            </div>
            <div class="modal-footer">
                <center>
                        <button type="button" class="btn btn-primary" onclick="remover_parametro_produto_editar('${id_remover_parametro}')" >Sim</button>
                        <button class="btn btn-danger" type="button" onclick="fechar_modal()">Não</button>
                </center>
            </div>
            `;
            $('#modal').modal('show');
            $('#modal').find('.modal-content').html(content);
            $('#modal').modal('show');
        }
    }

    function remover_parametro_produto_editar(id_remover) {
        if (id_remover) {
            fetch('../../../produto/produtoplataformaparametro/control/produtoplataformaparametro_remover_action.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id_remover: id_remover
                    })
                })
                .then((response) => response.text())
                .then((data) => {
                    fechar_modal()
                    busca_plataforma_produto()
                    busca_parametro_produto()
                    carrega_parametro_produto()
                    document.getElementById("valor_parametro").value = "";
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    function altera_valor_editar(parametro_escolhido) {
        if (parametro_escolhido) {
            let busca_input = document.getElementById("valor_parametro_linha_editar_" + parametro_escolhido)
            let busca_input_icon = document.getElementById("valor_parametro_icon_editar_" + parametro_escolhido)
            if (busca_input && busca_input_icon) {

                busca_input_icon.classList.remove('fa-pencil-square-o');
                busca_input_icon.classList.add('fa-floppy-o');
                busca_input.removeAttribute('readonly');

                busca_input_icon.setAttribute('onclick', `salva_valor_editar('${parametro_escolhido}')`);
            }
        }
    }

    function salva_valor_editar(parametro_escolhido_editar) {
        if (parametro_escolhido_editar) {
            let valor_novo = document.getElementById("valor_parametro_linha_editar_" + parametro_escolhido_editar)
            let icone_novo = document.getElementById("valor_parametro_icon_editar_" + parametro_escolhido_editar)
            if (valor_novo.value.trim()) {
                valor_novo.setAttribute('readonly', 'true');
                icone_novo.classList.remove('fa-floppy-o');
                icone_novo.classList.add('fa-pencil-square-o');
                icone_novo.setAttribute('onclick', `altera_valor_editar('${parametro_escolhido_editar}')`);

                fetch('../../../produto/produtoplataformaparametro/control/produtoplataformaparametro_editar_valor_action.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_editar: parametro_escolhido_editar,
                            valor_parametro: valor_novo.value.trim(),
                        })
                    })
                    .then((response) => response.text())
                    .then((data) => {
                        fechar_modal()
                        busca_plataforma_produto()
                        busca_parametro_produto()
                        carrega_parametro_produto()
                        document.getElementById("valor_parametro").value = "";
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            } else {
                valor_novo.style.border = "1px solid red"
                setTimeout(() => {
                    valor_novo.style.border = "1px solid #e5e6e7"
                }, 2300);
            }
        }
    }

    function salvar_alteracao_editar() {
        let exec = 0;
        var descricao_editar = document.getElementById('descricao_editar').value;

        if (descricao_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_produto_editar()
            document.getElementById("descricao_editar").style.border = "1px solid red"
            document.getElementById("descricao_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("descricao_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("descricao_editar_error").style.display = "none"
            }, 2300);
        }

        if (document.getElementById("id_produto_editar").value) {
            exec++;
        } else {
            fechar_window();
            mostrar_mensagem('Houve um erro (Tente novamente)')
            listarproduto();
        }

        if (exec == 2) {
            fetch('../../../produto/produto/control/produto_editar_action.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        identificador: document.getElementById("id_produto_editar").value,
                        descricao: descricao_editar.trim(),
                    })
                })
                .then((response) => response.text())
                .then((data) => {
                    fechar_window();
                    listarproduto();
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    function expand_dados_gerais_produto_editar() {
        let verifica_expand_dados_gerais = document.getElementById("expand_section1")
        let verifica_expand_identificacao = document.getElementById("expand_section2")
        let verifica_expand_parametro = document.getElementById("expand_section3")

        if (verifica_expand_dados_gerais.className.includes('fa-chevron-down')) {
            verifica_expand_dados_gerais.classList.remove('fa-chevron-down')
            verifica_expand_dados_gerais.classList.remove('fa-chevron-up')
            verifica_expand_dados_gerais.classList.add('fa-chevron-up')
            document.getElementById("dados_gerais_container").style.display = 'block'

            if (verifica_expand_identificacao.className.includes('fa-chevron-up')) {
                verifica_expand_identificacao.classList.remove('fa-chevron-up')
                verifica_expand_identificacao.classList.remove('fa-chevron-down')
                verifica_expand_identificacao.classList.add('fa-chevron-down')
                document.getElementById("identificacao_container").style.display = 'none'
            }

            if (verifica_expand_parametro.className.includes('fa-chevron-up')) {
                verifica_expand_parametro.classList.remove('fa-chevron-up')
                verifica_expand_parametro.classList.remove('fa-chevron-down')
                verifica_expand_parametro.classList.add('fa-chevron-down')
                document.getElementById("parametro_container").style.display = 'none'
            }
        }
    }
</script>