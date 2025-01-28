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
        <h4 class="modal-title" style="font-weight: 600; font-size: 25px; color: black; margin-left: 15px;">Adicionar identificação</h4>
        <div style="display: flex; align-items: center; gap: 25px;">
            <div style="display:flex; margin-top: 5px; gap: 15px;">
                <a name="#section1" onclick="verify_expand(this.name)">
                    Dados do identificação
                </a>
            </div>
            <button type="button" class="close" onclick="fechar_window()" style="font-size: 30px !important; margin-top: 5px; margin-right: 15px; color:#ec4758; opacity: 100% !important;">&times;</button>
        </div>
    </div>
</div>
<div class="modal-body modal-body-windown">
    <div class="ibox float-e-margins border-bottom" style="color: black;" id="section1">
        
        <div class="ibox-title">
            <h5 style="font-size: 15px; font-weight: 1000;">Dados do identificação</h5>
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
                        <label for="descricao">Descrição: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100">
                        <label for="descricao" id="descricao_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 25px;">
                <div class="col-lg-12">
                    <span style="color: red;"><strong>*</strong> Campo obrigatório </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer modal-footer-windown">
    <div class="separte_buttons">
        <button class="btn btn-danger" type="button" onclick="fechar_window()">Cancelar</button>
        <button class="btn btn-primary" id="salvar_identificacao_action" onclick="salvar_identificacao()">Salvar</button>
    </div>
</div>
<script>
    function salvar_identificacao(){
        let exec = 0
        
        var descricao = document.getElementById('descricao').value;

        if (descricao.trim()) {
            exec++
        } else {
            document.getElementById("descricao").style.border = "1px solid red"
            document.getElementById("descricao_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("descricao").style.border = "1px solid #e5e6e7"
                document.getElementById("descricao_error").style.display = "none"
            }, 2300);
        }
        if (exec === 1) {
            fetch('../../../produto/identificacao/control/identificacao_adicionar_action.php', {
                method: 'POST',
                body: JSON.stringify({
                    descricao:descricao.trim()
                })
            })

            .then((response) => response.text())
            .then((data) => {
                fechar_window()
                listaridentificacao()
                if (data.trim() == "400") {
                    mostrar_mensagem('identificação já cadastrado!')
                }
                if (data.trim() == "404") {
                    mostrar_mensagem('Houve um erro (Tente novamente)')
                }
            })
            .catch((error) => {
                console.error(error);
            });
        } else {
            expand_dados_gerais_identificacao()
            document.getElementById("salvar_identificacao_action").disabled = false
        }
    }

    function expand_dados_gerais_identificacao() {
        let verifica_expand_dados_gerais = document.getElementById("expand_section1")

        if (verifica_expand_dados_gerais.className.includes('fa-chevron-down')) {
            verifica_expand_dados_gerais.classList.remove('fa-chevron-down')
            verifica_expand_dados_gerais.classList.remove('fa-chevron-up')
            verifica_expand_dados_gerais.classList.add('fa-chevron-up')
            document.getElementById("dados_gerais_container").style.display = 'block'
        }
    }
</script>