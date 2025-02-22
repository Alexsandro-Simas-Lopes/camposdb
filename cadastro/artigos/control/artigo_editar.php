<?php
    require_once("../../artigos/model/artigodao.php");
    $receivedData = file_get_contents("php://input");
    $dataJSON = json_decode($receivedData);
    $artg = artigodao::getFindById($dataJSON->id);
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
</style>
<div class="modal-header modal-header-windown">
    <div style="display: flex; justify-content: space-between;">
        <h4 class="modal-title" style="font-weight: 600; font-size: 25px; color: black; margin-left: 15px;">Alterar dados do artigo</h4>
        <div style="display: flex; align-items: center; gap: 25px;">
            <div style="display:flex; margin-top: 5px; gap: 15px;">
                <a name="#section1" onclick="verify_expand(this.name)">
                    Dados do artigo
                </a>
            </div>
            <button type="button" class="close" data-dismiss="modal" style="font-size: 30px !important; margin-top: 5px; margin-right: 15px; color:#ec4758; opacity: 100% !important;">&times;</button>
        </div>
    </div>
</div>
<div class="modal-body modal-body-windown">
    <input type="hidden" name="id_artigo_editar" id="id_artigo_editar" value="<?= $artg->getId(); ?>">
    <div class="ibox float-e-margins border-bottom" style="color: black;" id="section1">
        <div class="ibox-title">
            <h5 style="font-size: 15px; font-weight: 1000;">Dados do artigo</h5>
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
                        <label for="titulo_editar">Title: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="titulo_editar" id="titulo_editar" value="<?= $artg->getTitulo(); ?>" maxlength="150">
                        <label for="titulo_editar" id="titulo_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="resumo_editar">Summary: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="resumo_editar" id="resumo_editar" value="<?= $artg->getResumo(); ?>" maxlength="150">
                        <label for="resumo_editar" id="resumo_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="conteudo_editar">Content: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="conteudo_editar" id="conteudo_editar" value="<?= $artg->getConteudo(); ?>" maxlength="50">
                        <label for="conteudo_editar" id="conteudo_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="status_editar">Status: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="status_editar" id="status_editar" value="<?= $artg->getStatus(); ?>" maxlength="50">
                        <label for="status_editar" id="status_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
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
</div>
<div class="modal-footer modal-footer-windown">
    <div class="separte_buttons">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary" id="editar_artigo_action" onclick="salvar_alteracao_editar()">Salvar Alteração</button>
    </div>
</div>

<script>
    function salvar_alteracao_editar() {
        let exec = 0;
        var titulo_editar = document.getElementById('titulo_editar').value;
        var resumo_editar = document.getElementById('resumo_editar').value;
        var conteudo_editar = document.getElementById('conteudo_editar').value;
        var status_editar = document.getElementById('status_editar').value;

        if (titulo_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_artigo_editar()
            document.getElementById("titulo_editar").style.border = "1px solid red"
            document.getElementById("titulo_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("titulo_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("titulo_editar_error").style.display = "none"
            }, 2300);
        }

        if (resumo_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_artigo_editar()
            document.getElementById("resumo_editar").style.border = "1px solid red"
            document.getElementById("resumo_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("resumo_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("resumo_editar_error").style.display = "none"
            }, 2300);
        }

        if (conteudo_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_artigo_editar()
            document.getElementById("conteudo_editar").style.border = "1px solid red"
            document.getElementById("conteudo_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("conteudo_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("conteudo_editar_error").style.display = "none"
            }, 2300);
        }

        if (status_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_artigo_editar()
            document.getElementById("status_editar").style.border = "1px solid red"
            document.getElementById("status_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("status_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("status_editar_error").style.display = "none"
            }, 2300);
        }

        if (document.getElementById("id_artigo_editar").value) {
            exec++;
        } else {
            fechar_window();
            mostrar_mensagem('Houve um erro (Tente novamente)')
            listarartigo();
        }

        if (exec == 5) {
            fetch('../../artigos/control/artigo_editar_action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    identificador: document.getElementById("id_artigo_editar").value,
                    titulo: titulo_editar.trim(),
                    resumo: resumo_editar.trim(),
                    conteudo: conteudo_editar.trim(),
                    status: status_editar.trim(),
                })
            })
            .then((response) => response.text())
            .then((data) => {
                fechar_window();
                listarartigo();
            })
            .catch((error) => {
                console.error(error);
            });
        }
    }
   
    function expand_dados_gerais_artigo_editar() {
        let verifica_expand_dados_gerais = document.getElementById("expand_section1")
        let verifica_expand_identificacao = document.getElementById("expand_section2")
        let verifica_expand_parametro = document.getElementById("expand_section3")

        if (verifica_expand_dados_gerais.className.includes('fa-chevron-down')) {
            verifica_expand_dados_gerais.classList.remove('fa-chevron-down')
            verifica_expand_dados_gerais.classList.remove('fa-chevron-up')
            verifica_expand_dados_gerais.classList.add('fa-chevron-up')
            document.getElementById("dados_gerais_container").style.display = 'block'
        }
    }
</script>

<!-- <div class="modal-header modal-header-windown">
    <div style="display: flex; justify-content: space-between;">
        <h4 class="modal-title" style="font-weight: 600; font-size: 25px; color: black; margin-left: 15px;">Alterar produto</h4>
        <div style="display: flex; align-items: center; gap: 25px;">
            <div style="display:flex; margin-top: 5px; gap: 15px;">
                <a name="#section1" onclick="verify_expand(this.name)">
                    Dados do produto
                </a>
            </div>
            <button type="button" class="close" data-dismiss="modal" style="font-size: 30px !important; margin-top: 5px; margin-right: 15px; color:#ec4758; opacity: 100% !important;">&times;</button>
        </div>
    </div>
    </div>
    <div class="modal-body modal-body-windown">
        <input type="hidden" name="id_artigo_editar" id="id_artigo_editar" value=""section1">
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
                            <label for="name_editar">Nome: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="name_editar" id="name_editar" value="" maxlength="150">
                            <label for="name_editar" id="name_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="price_editar">Preço: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="price_editar" id="price_editar" value="" maxlength="150">
                            <label for="price_editar" id="price_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="marca_editar">Marca: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="marca_editar" id="marca_editar" value="" maxlength="50">
                            <label for="marca_editar" id="marca_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="categoria_editar">categoria: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="categoria_editar" id="categoria_editar" value="" maxlength="50">
                            <label for="categoria_editar" id="categoria_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="sub_categoria_editar">Sub Categoria: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="sub_categoria_editar" id="sub_categoria_editar" value="" maxlength="50">
                            <label for="sub_categoria_editar" id="sub_categoria_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="img_editar">Imagem: <span style="color: red;">*</span></label>
                            <input type="file" class="form-control" name="img_editar" accept="img/*" id="img_editar" value="" maxlength="150">
                            <label for="img_editar" id="img_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
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
    </div>
    <div class="modal-footer modal-footer-windown">
        <div class="separte_buttons">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" id="editar_artigo_action" onclick="salvar_alteracao_editar()">Salvar Alteração</button>
        </div>
    </div>

    <script>
    function salvar_alteracao_editar() {
        let exec = 0;
        var marca_editar = document.getElementById('marca_editar').value;
        var name_editar = document.getElementById('name_editar').value;
        var categoria_editar = document.getElementById('categoria_editar').value;
        var sub_categoria_editar = document.getElementById('sub_categoria_editar').value;
        var price_editar = document.getElementById('price_editar').value;

        if (marca_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_artigo_editar()
            document.getElementById("marca_editar").style.border = "1px solid red"
            document.getElementById("marca_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("marca_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("marca_editar_error").style.display = "none"
            }, 2300);
        }

        if (name_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_artigo_editar()
            document.getElementById("name_editar").style.border = "1px solid red"
            document.getElementById("name_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("name_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("name_editar_error").style.display = "none"
            }, 2300);
        }

        if (categoria_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_artigo_editar()
            document.getElementById("categoria_editar").style.border = "1px solid red"
            document.getElementById("categoria_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("categoria_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("categoria_editar_error").style.display = "none"
            }, 2300);
        }

        if (sub_categoria_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_artigo_editar()
            document.getElementById("sub_categoria_editar").style.border = "1px solid red"
            document.getElementById("sub_categoria_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("sub_categoria_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("sub_categoria_editar_error").style.display = "none"
            }, 2300);
        }

        if (price_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_artigo_editar()
            document.getElementById("price_editar").style.border = "1px solid red"
            document.getElementById("price_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("price_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("price_editar_error").style.display = "none"
            }, 2300);
        }

        if (document.getElementById("id_artigo_editar").value) {
            exec++;
        } else {
            fechar_window();
            mostrar_mensagem('Houve um erro (Tente novamente)')
            listarartigo();
        }

        if (exec == 6) {
            fetch('../../produtos/control/artigo_editar_action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    identificador: document.getElementById("id_artigo_editar").value,
                    marca: marca_editar.trim(),
                    name: name_editar.trim(),
                    categoria: categoria_editar.trim(),
                    sub_categoria: sub_categoria_editar.trim(),
                    price: price_editar.trim(),
                })
            })
            .then((response) => response.text())
            .then((data) => {
                fechar_window();
                listarartigo();
            })
            .catch((error) => {
                console.error(error);
            });
        }
    } -->