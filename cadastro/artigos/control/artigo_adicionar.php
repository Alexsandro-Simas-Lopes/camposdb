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
        <h4 class="modal-title" style="font-weight: 600; font-size: 25px; color: black; margin-left: 15px;">Adicionar Artigo</h4>
        <div style="display: flex; align-items: center; gap: 25px;">
            <div style="display:flex; margin-top: 5px; gap: 15px;">
                <a name="#section1" onclick="verify_expand(this.name)">
                    Dados do Artigo
                </a>
            </div>
            <button type="button" class="close" onclick="fechar_window()" style="font-size: 30px !important; margin-top: 5px; margin-right: 15px; color:#ec4758; opacity: 100% !important;">&times;</button>
        </div>
    </div>
</div>
<div class="modal-body modal-body-windown">
    <div class="ibox float-e-margins border-bottom" style="color: black;" id="section1">
        <div class="ibox-title">
            <h5 style="font-size: 15px; font-weight: 1000;">Dados do Artigo</h5>
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
                        <label for="titulo">Title: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="titulo" id="titulo" maxlength="100">
                        <label for="titulo" id="titulo_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                    <div class="col-lg-6">
                        <label for="resumo">Summary: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="resumo" id="resumo" maxlength="100">
                        <label for="resumo" id="resumo_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                    <div class="col-lg-6">
                        <label for="conteudo">Content: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="conteudo" id="conteudo" maxlength="100">
                        <label for="conteudo" id="conteudo_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                    <div class="col-lg-6">
                        <label for="status">Status: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="status" id="status" maxlength="100">
                        <label for="status" id="status_error" class="error" style="display: none;">Não pode estar vazia</label>
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
        <button class="btn btn-danger" type="button" onclick="fechar_window()">Cancelar</button>
        <button class="btn btn-primary" id="salvar_artigo_action" onclick="salvar_artigo()">Salvar</button>
    </div>
</div>

<script>
    function salvar_artigo(insert_data = {}) {
        let exec = 0;
        document.getElementById("salvar_artigo_action").disabled = true;

        var titulo = document.getElementById('titulo').value;
        var resumo = document.getElementById('resumo').value;
        var conteudo = document.getElementById('conteudo').value;
        var status = document.getElementById('status').value;
        
        // Validação dos campos
        if (titulo.trim()) {
            exec++;
        } else {
            document.getElementById("titulo").style.border = "1px solid red";
            document.getElementById("titulo_error").style.display = "block";
            setTimeout(() => {
                document.getElementById("titulo").style.border = "1px solid #e5e6e7";
                document.getElementById("titulo_error").style.display = "none";
            }, 2300);
        }

        if (resumo.trim()) {
            exec++;
        } else {
            document.getElementById("resumo").style.border = "1px solid red";
            document.getElementById("resumo_error").style.display = "block";
            setTimeout(() => {
                document.getElementById("resumo").style.border = "1px solid #e5e6e7";
                document.getElementById("resumo_error").style.display = "none";
            }, 2300);
        }

        if (conteudo.trim()) {
            exec++;
        } else {
            document.getElementById("conteudo").style.border = "1px solid red";
            document.getElementById("conteudo_error").style.display = "block";
            setTimeout(() => {
                document.getElementById("conteudo").style.border = "1px solid #e5e6e7";
                document.getElementById("conteudo_error").style.display = "none";
            }, 2300);
        }

        if (status.trim()) {
            exec++;
        } else {
            document.getElementById("status").style.border = "1px solid red";
            document.getElementById("status_error").style.display = "block";
            setTimeout(() => {
                document.getElementById("status").style.border = "1px solid #e5e6e7";
                document.getElementById("status_error").style.display = "none";
            }, 2300);
        }

        if (exec === 4) {
            let verifica_Artigo_dados = {
                titulo: titulo.trim(),
                resumo: resumo,
                conteudo: conteudo.trim(),
                status: status.trim()
            };

            fetch('../../artigos/control/artigo_verifica_existe.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(verifica_Artigo_dados),
            })
            .then((response) => response.text())
            .then((verifica) => {
                if (verifica.trim() == "400") {
                    expand_dados_gerais_artigo();
                    document.getElementById("titulo").value = "";
                    document.getElementById("resumo").value = "";
                    document.getElementById("conteudo").value = "";
                    document.getElementById("status").value = "";
                    mostrar_mensagem_center_modal('Artigo já cadastrado');
                    setTimeout(() => {
                        document.getElementById("salvar_artigo_action").disabled = false;
                    }, 5);
                } else if (verifica.trim() == "200") {
                    insert_data = {
                        titulo: titulo.trim(),
                        resumo: resumo,
                        conteudo: conteudo.trim(),
                        status: status.trim(),
                    };
                    insert_Artigo(insert_data);
                } else {
                    fechar_window();
                    mostrar_mensagem('Houve um erro (Tente novamente)');
                }
            })
            .catch((error) => {
                console.error(error);
            });
        } else {
            expand_dados_gerais_artigo();
            document.getElementById("salvar_artigo_action").disabled = false;
        }
    }


    function insert_Artigo(content = {}) {
        setTimeout(() => {
            fetch('../../artigos/control/artigo_adicionar_action.php', {
                    method: 'POST',
                    body: JSON.stringify(content)
                })
                .then((response) => response.text())
                .then((data) => {
                    fechar_window()
                    listarArtigo()
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
</script>