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

    #table_adicionar_identificacao>thead>tr>th {
        background-color: white;
    }

    #table_adicionar_identificacao>thead>tr>th>div>i {
        color: gainsboro;
    }

    #table_adicionar_parametro>thead>tr>th {
        background-color: white;
    }

    #table_adicionar_parametro>thead>tr>th>div>i {
        color: gainsboro;
    }
</style>
<div class="modal-header modal-header-windown">
    <div style="display: flex; justify-content: space-between;">
        <h4 class="modal-title" style="font-weight: 600; font-size: 25px; color: black; margin-left: 15px;">Adicionar produto</h4>
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
            <button type="button" class="close" onclick="fechar_window()" style="font-size: 30px !important; margin-top: 5px; margin-right: 15px; color:#ec4758; opacity: 100% !important;">&times;</button>
        </div>
    </div>
</div>
<div class="modal-body modal-body-windown">
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
                    <div class="col-lg-12">
                        <label for="identificador">Código: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="identificador" id="identificador" maxlength="20">
                        <label for="identificador" id="identificador_error" class="error" style="display: none;">Não pode estar vazio</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="descricao">Descrição: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100">
                        <label for="descricao" id="descricao_error" class="error" style="display: none;">Não pode estar vazia</label>
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
                                <label for="identificacao_escolha">Selecione uma identificação: <span style="color: red;">*</span></label>
                                <select name="identificacao_escolha" id="identificacao_escolha" class="form-control chosen-select-identificacao" onchange="">
                                    <option value="" selected disabled>Selecione</option>
                                </select>
                                <label for="identificacao_escolha" id="identificacao_escolha_error" class="error" style="display: none;">Não pode estar vazio</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="action_adicionar_identificacao">&nbsp;</label>
                            <button type="button" class="btn btn-success" id="action_adicionar_identificacao" data-toggle="modal" onclick="incluir_identificacao()" style="background: #18a689; border: 1px solid #18a689; width: 100%;">
                                <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" style="max-height: 200px !important;">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="table_adicionar_identificacao">
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
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <center>Nenhuma identificação incluída</center>
                                            </td>
                                        </tr>
                                    </tbody>
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
                                        Quantidade de Identificações: <span id="count_indicator_identificacao" style="color:black; font-weight: 900;">0</span> <span id="alert_grupo_identificacao" style="display: none; color:red">(No mínimo uma identificação)</span>
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
                            <button type="button" class="btn btn-success" id="action_adicionar_parametro" data-toggle="modal" onclick="incluir_parametro()" style="background: #18a689; border: 1px solid #18a689; width: 100%;">
                                <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" style="max-height: 200px !important;">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="table_adicionar_parametro">
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
                                        <tr>
                                            <td colspan="4">
                                                <center>Nenhum parâmetro incluído</center>
                                            </td>
                                        </tr>
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
                                        Quantidade de Parâmetros: <span id="count_indicator_parametro" style="color:black; font-weight: 900;">0</span> <span id="alert_grupo_parametro" style="display: none; color:red">(No mínimo um parâmetro)</span>
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
        <button class="btn btn-danger" type="button" onclick="fechar_window()">Cancelar</button>
        <button class="btn btn-primary" id="salvar_produto_action" onclick="salvar_produto()">Salvar</button>
    </div>
</div>

<script>
    var atribuidos_identificacao = [];
    var atribuidos_parametro = [];
    clear_general_cache();

    function clear_general_cache() {
        atribuidos_identificacao = [];
        atribuidos_parametro = [];
    }
    busca_identificacao_produto()
    busca_plataforma_produto()
    busca_parametro_produto()

    function salvar_produto(insert_data = {}) {
        let exec = 0;
        document.getElementById("salvar_produto_action").disabled = true
        var descricao = document.getElementById('descricao').value;
        var identificador = document.getElementById('identificador').value;

        if (descricao.trim()) {
            exec++;
        } else {
            document.getElementById("descricao").style.border = "1px solid red"
            document.getElementById("descricao_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("descricao").style.border = "1px solid #e5e6e7"
                document.getElementById("descricao_error").style.display = "none"
            }, 2300);
        }

        if (identificador.trim()) {
            exec++;
        } else {
            document.getElementById("identificador").style.border = "1px solid red"
            document.getElementById("identificador_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("identificador").style.border = "1px solid #e5e6e7"
                document.getElementById("identificador_error").style.display = "none"
            }, 2300);
        }

        if (exec === 2) {
            insert_data = {};
            let verifica_produto_dados = {
                identificador: identificador.trim()
            };
            fetch('../../../produto/produto/control/produto_verifica_existe.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(verifica_produto_dados),
                })
                .then((response) => response.text())
                .then((verifica) => {
                    if (verifica.trim() == "400") {
                        expand_dados_gerais_produto()
                        document.getElementById("descricao").value = ""
                        document.getElementById("identificador").value = ""
                        mostrar_mensagem_center_modal('Produto já cadastrado')
                        setTimeout(() => {
                            document.getElementById("salvar_produto_action").disabled = false
                        }, 5);
                    } else if (verifica.trim() == "200") {
                        if (atribuidos_identificacao.length >= 1) {
                            if (atribuidos_parametro.length >= 1) {
                                insert_data = {
                                    descricao: descricao.trim(),
                                    identificador: identificador.trim(),
                                    indentificacao: atribuidos_identificacao,
                                    parametro: atribuidos_parametro
                                };
                                console.log(atribuidos_identificacao)
                                console.log(atribuidos_parametro)

                                insert_produto(insert_data);
                            } else {
                                expand_parametro_produto()
                                document.getElementById('indicator_view_parametro').style.border = "1px solid red"
                                document.getElementById('alert_grupo_parametro').style.display = "block"
                                setTimeout(() => {
                                    document.getElementById("indicator_view_parametro").style.border = "none"
                                    document.getElementById('alert_grupo_parametro').style.display = "none"
                                }, 2300);
                                setTimeout(() => {
                                    document.getElementById("salvar_produto_action").disabled = false
                                }, 5);
                            }
                        } else {
                            expand_identificacao_produto()
                            document.getElementById('indicator_view').style.border = "1px solid red"
                            document.getElementById('alert_grupo_identificacao').style.display = "block"
                            setTimeout(() => {
                                document.getElementById("indicator_view").style.border = "none"
                                document.getElementById('alert_grupo_identificacao').style.display = "none"
                            }, 2300);
                            setTimeout(() => {
                                document.getElementById("salvar_produto_action").disabled = false
                            }, 5);
                        }
                    } else {
                        fechar_window()
                        mostrar_mensagem('Houve um erro (Tente novamente)')
                    }
                })
                .catch((error) => {
                    console.error(error);
                });

        } else {
            expand_dados_gerais_produto()
            document.getElementById("salvar_produto_action").disabled = false
        }
    }

    function insert_produto(content = {}) {
        setTimeout(() => {
            fetch('../../../produto/produto/control/produto_adicionar_action.php', {
                    method: 'POST',
                    body: JSON.stringify(content)
                })
                .then((response) => response.text())
                .then((data) => {
                    fechar_window()
                    listarproduto()
                    setTimeout(() => {
                        if (data.trim() == "404") {
                            mostrar_mensagem('Houve um erro (Tente novamente)')
                        }
                    }, 5);
                })
                .catch((error) => {
                    console.error(error);
                });
        }, 5);
    }

    function mostrar_mensagem_center_modal(msg) {
        if (msg) {
            let content = `
            <div class="modal-header language-json">
            <center><h3 class="modal-title" ><i class="bi bi-exclamation-triangle"></i> Aviso</h3></center>
            </div>
            <div class="modal-body language-json">
                <h3><center>` + msg + `</center></center>
            </div>
            <div class="modal-footer language-json">
                <center><button class="btn btn-default" type="button" onclick="fechar_modal()">Fechar</button></center>
            </div>
            `
            $('#modal').modal('show');
            $('#modal').find('.modal-content').html(content);
            $('#modal').find('show');
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

    function expand_dados_gerais_produto() {
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

    function expand_identificacao_produto() {
        let verifica_expand_dados_gerais = document.getElementById("expand_section1")
        let verifica_expand_identificacao = document.getElementById("expand_section2")
        let verifica_expand_parametro = document.getElementById("expand_section3")

        if (verifica_expand_identificacao.className.includes('fa-chevron-down')) {
            verifica_expand_identificacao.classList.remove('fa-chevron-down')
            verifica_expand_identificacao.classList.remove('fa-chevron-up')
            verifica_expand_identificacao.classList.add('fa-chevron-up')
            document.getElementById("identificacao_container").style.display = 'block'

            if (verifica_expand_dados_gerais.className.includes('fa-chevron-up')) {
                verifica_expand_dados_gerais.classList.remove('fa-chevron-up')
                verifica_expand_dados_gerais.classList.remove('fa-chevron-down')
                verifica_expand_dados_gerais.classList.add('fa-chevron-down')
                document.getElementById("dados_gerais_container").style.display = 'none'
            }

            if (verifica_expand_parametro.className.includes('fa-chevron-up')) {
                verifica_expand_parametro.classList.remove('fa-chevron-up')
                verifica_expand_parametro.classList.remove('fa-chevron-down')
                verifica_expand_parametro.classList.add('fa-chevron-down')
                document.getElementById("parametro_container").style.display = 'none'
            }
        }
    }

    function expand_parametro_produto() {
        let verifica_expand_dados_gerais = document.getElementById("expand_section1")
        let verifica_expand_identificacao = document.getElementById("expand_section2")
        let verifica_expand_parametro = document.getElementById("expand_section3")

        if (verifica_expand_parametro.className.includes('fa-chevron-down')) {
            verifica_expand_parametro.classList.remove('fa-chevron-down')
            verifica_expand_parametro.classList.remove('fa-chevron-up')
            verifica_expand_parametro.classList.add('fa-chevron-up')
            document.getElementById("parametro_container").style.display = 'block'

            if (verifica_expand_dados_gerais.className.includes('fa-chevron-up')) {
                verifica_expand_dados_gerais.classList.remove('fa-chevron-up')
                verifica_expand_dados_gerais.classList.remove('fa-chevron-down')
                verifica_expand_dados_gerais.classList.add('fa-chevron-down')
                document.getElementById("dados_gerais_container").style.display = 'none'
            }

            if (verifica_expand_identificacao.className.includes('fa-chevron-up')) {
                verifica_expand_identificacao.classList.remove('fa-chevron-up')
                verifica_expand_identificacao.classList.remove('fa-chevron-down')
                verifica_expand_identificacao.classList.add('fa-chevron-down')
                document.getElementById("identificacao_container").style.display = 'none'
            }

        }
    }

    function busca_identificacao_produto(data_search = {}) {
        document.getElementById("identificacao_escolha").innerHTML = '<option value="" selected disabled>Sem identificações disponíveis</option>'
        $('.chosen-select-identificacao').trigger('chosen:updated');
        if (atribuidos_identificacao) {
            data_search.not_find = atribuidos_identificacao
        }
        fetch('../../../produto/identificacao/control/identificacao_options.php', {
                method: 'POST',
                body: JSON.stringify(data_search),
            })
            .then((response) => response.text())
            .then((conteudo) => {
                if (conteudo) {
                    document.getElementById("identificacao_escolha").innerHTML = conteudo
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

    function incluir_identificacao() {
        let exec = 0

        const tabela = document.getElementById('table_adicionar_identificacao');
        const tbody = tabela.querySelector('tbody');

        let identificacao_selecionado = document.getElementById("identificacao_escolha").value
        if (identificacao_selecionado) {
            exec++
        } else {
            document.getElementById("identificacao_escolha_error").style.display = "block"
            document.getElementById("identificacao_escolha_chosen").style.border = "1px solid red"
            setTimeout(() => {
                document.getElementById("identificacao_escolha_error").style.display = "none"
                document.getElementById("identificacao_escolha_chosen").style.border = "none"
            }, 2300);
        }
        if (exec === 1) {
            if (atribuidos_identificacao.length == 0) {
                tbody.innerHTML = ""
            }
            let elemento = document.querySelector('option[value="' + identificacao_selecionado + '"]')
            if (elemento) {
                let text_content = elemento.textContent

                atribuidos_identificacao.push({
                    identificacao_selecionado
                });

                document.getElementById("count_indicator_identificacao").innerHTML = atribuidos_identificacao.length
                busca_identificacao_produto()

                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${text_content}</td>
                    <td class="actions">
                        <center>
                            <i class="fa fa-trash" data-placement="bottom" style="cursor:pointer; padding: 2px" target-identificacao_selecionado="${identificacao_selecionado}" title="Remover" onclick="remover_identificacao_lista(this)"></i>
                        </center>
                    </td> `;
                row.setAttribute('recid-identificacao-class', identificacao_selecionado);
                tbody.appendChild(row);
            }
        }
    }

    function remover_identificacao_lista(identificacao_remover) {
        if (identificacao_remover) {
            let id_identificacao = identificacao_remover.getAttribute('target-identificacao_selecionado');

            let tr = document.querySelector('tr[recid-identificacao-class="' + id_identificacao + '"]');
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
                        <button type="button" class="btn btn-primary" onclick="remover_identificacao_memoria('${id_identificacao}')" >Sim</button>
                        <button class="btn btn-danger" type="button" onclick="fechar_modal()">Não</button>
                </center>
            </div>
            `;
            $('#modal').modal('show');
            $('#modal').find('.modal-content').html(content);
            $('#modal').modal('show');
        }
    }

    function remover_identificacao_memoria(identificacao_remover) {
        const tabela = document.getElementById('table_adicionar_identificacao');
        const tbody = tabela.querySelector('tbody');

        let trElement = document.querySelector('tr[recid-identificacao-class="' + identificacao_remover + '"]');
        if (trElement) {

            atribuidos_identificacao = atribuidos_identificacao.filter(
                identificacao =>
                !(identificacao.identificacao_selecionado === identificacao_remover)
            );

            trElement.remove();
            fechar_modal()
            document.getElementById("count_indicator_identificacao").innerHTML = atribuidos_identificacao.length
            busca_identificacao_produto()

            if (atribuidos_identificacao.length == 0) {
                const row = document.createElement('tr');
                row.innerHTML = `
                <tr>
                    <td colspan="2">
                        <center>Nenhuma identificação incluída</center>
                    </td>
                </tr> `;
                tbody.appendChild(row);
            }

        }
    }

    function remover_parametro_lista(parametro_remover_item) {
        if (parametro_remover_item) {
            let plataforma = parametro_remover_item.getAttribute('target-plataforma_selecionado');
            let parametro = parametro_remover_item.getAttribute('target-parametro_selecionado');

            let tr = document.querySelector('tr[recid-parametro-produto-class="' + plataforma + '/' + parametro + '"]');
            let content = `
                <div class="modal-header">
                    <center><h3 class="modal-title" data-i18n=""><i class="bi bi-exclamation-triangle"></i> Aviso</h3></center>
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
                            <button type="button" class="btn btn-primary" onclick="remover_parametro_memoria('${plataforma}','${parametro}')" >Sim</button>
                            <button class="btn btn-danger" type="button" onclick="fechar_modal()">Não</button>
                    </center>
                </div>
                `;
            $('#modal').modal('show');
            $('#modal').find('.modal-content').html(content);
            $('#modal').modal('show');
        }
    }

    function remover_parametro_memoria(plataforma, parametro) {
        const tabela = document.getElementById('table_adicionar_parametro');
        const tbody = tabela.querySelector('tbody');
        var trElement = document.querySelector('tr[recid-parametro-produto-class="' + plataforma + '/' + parametro + '"]');
        if (trElement) {

            atribuidos_parametro = atribuidos_parametro.filter(
                identificacao =>
                !(identificacao.plataforma_selecionado === plataforma && identificacao.parametro_escolha === parametro)
            );

            trElement.remove();
            fechar_modal()
            document.getElementById("count_indicator_parametro").innerHTML = atribuidos_parametro.length
            busca_plataforma_produto()
            busca_parametro_produto()
            document.getElementById("valor_parametro").value = "";

            if (atribuidos_parametro.length == 0) {
                const row = document.createElement('tr');
                row.innerHTML = `
                <tr>
                    <td colspan="4">
                        <center>Nenhum parâmetro incluído</center>
                    </td>
                </tr> `;
                tbody.appendChild(row);
            }
        }
    }

    function incluir_parametro() {
        let exec = 0

        const tabela = document.getElementById('table_adicionar_parametro');
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

        if (exec === 3) {
            if (atribuidos_parametro.length == 0) {
                tbody.innerHTML = ""
            }

            let text_content_plataforma = plataforma_selecionado.options[plataforma_selecionado.selectedIndex].text;
            let text_content_parametro = parametro_escolha.options[parametro_escolha.selectedIndex].text;

            plataforma_selecionado = plataforma_selecionado.value;
            parametro_escolha = parametro_escolha.value;

            id_parametro_produto = plataforma_selecionado + "/" + parametro_escolha

            let verifica_existe = existe_plataforma_parametro(id_parametro_produto);
            if (verifica_existe === true) {
                atribuidos_parametro.push({
                    id_parametro_produto,
                    plataforma_selecionado,
                    parametro_escolha,
                    valor_parametro
                });

                console.log(atribuidos_parametro);

                document.getElementById("count_indicator_parametro").innerHTML = atribuidos_parametro.length

                busca_plataforma_produto()
                busca_parametro_produto()
                document.getElementById("valor_parametro").value = "";

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${text_content_plataforma}</td>
                    <td>${text_content_parametro}</td>
                    <td>
                       <div style="display: flex; align-items: baseline; justify-content: center; gap: 10px;">
                            <input type="text" class="form-control" style="height: 19.6px !important;background-color: white;" maxlength="100" name="valor_parametro_linha" id="valor_parametro_linha_${id_parametro_produto}" value="${valor_parametro}" readonly> 
                            <i class="fa fa-pencil-square-o" style="cursor:pointer" id="valor_parametro_icon_${id_parametro_produto}" onclick="altera_valor_memoria('${id_parametro_produto}')" title="Alterar valor"></i>
                       </div>
                    </td>
                    <td class="actions">
                        <center>
                            <i class="fa fa-trash" data-placement="bottom" style="cursor:pointer; padding: 2px" target-plataforma_selecionado="${plataforma_selecionado}" target-parametro_selecionado="${parametro_escolha}" title="Remover" onclick="remover_parametro_lista(this)"></i>
                        </center>
                    </td> `;
                row.setAttribute('recid-parametro-produto-class', plataforma_selecionado + "/" + parametro_escolha);
                tbody.appendChild(row);
            } else {
                busca_plataforma_produto()
                busca_parametro_produto()
                document.getElementById("valor_parametro").value = "";

                document.getElementById("error_parametro_incluido").style.display = "block"
                setTimeout(() => {
                    document.getElementById("error_parametro_incluido").style.display = "none"
                }, 2400);
            }
        }
    }

    function altera_valor_memoria(parametro_escolhido) {
        if (parametro_escolhido) {
            let busca_input = document.getElementById("valor_parametro_linha_" + parametro_escolhido)
            let busca_input_icon = document.getElementById("valor_parametro_icon_" + parametro_escolhido)
            if (busca_input && busca_input_icon) {
                busca_input_icon.classList.remove('fa-pencil-square-o');
                busca_input_icon.classList.add('fa-floppy-o');
                busca_input.removeAttribute('readonly');

                busca_input_icon.setAttribute('onclick', `salva_valor_memoria('${parametro_escolhido}')`);
            }
        }
    }

    function salva_valor_memoria(parametro_escolhido) {
        if (parametro_escolhido) {
            let item_encontrato = atribuidos_parametro.find(parametro => parametro.id_parametro_produto === parametro_escolhido);
            let valor_novo = document.getElementById("valor_parametro_linha_" + parametro_escolhido)
            let icone_novo = document.getElementById("valor_parametro_icon_" + parametro_escolhido)

            if (valor_novo.value.trim()) {
                if (item_encontrato) {
                    item_encontrato.valor_parametro = valor_novo.value.trim();
                    valor_novo.setAttribute('readonly', 'true');
                    icone_novo.classList.remove('fa-floppy-o');
                    icone_novo.classList.add('fa-pencil-square-o');
                    icone_novo.setAttribute('onclick', `altera_valor_memoria('${parametro_escolhido}')`);
                }
            } else {
                valor_novo.style.border = "1px solid red"
                setTimeout(() => {
                    valor_novo.style.border = "1px solid #e5e6e7"
                }, 2300);
            }
        }
    }

    function existe_plataforma_parametro(id_parametro_produto) {
        if (id_parametro_produto) {
            let busca_item = atribuidos_parametro.find(parametro => parametro.id_parametro_produto === id_parametro_produto);
            if (busca_item) {
                return false
            } else {
                return true
            }
        }
    }
</script>