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
                    <div class="col-lg-6">
                        <label for="name">Nome: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" maxlength="100">
                        <label for="name" id="name_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                    <div class="col-lg-6">
                        <label for="price">Preço: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="price" id="price" maxlength="100">
                        <label for="price" id="price_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                    <div class="col-lg-6">
                        <label for="marca">Marca: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="marca" id="marca" maxlength="100">
                        <label for="marca" id="marca_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                    <div class="col-lg-6">
                        <label for="categoria">Categoria: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="categoria" id="categoria" maxlength="100">
                        <label for="categoria" id="categoria_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                    <div class="col-lg-6">
                        <label for="sub_categoria">Sub Categoria: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="sub_categoria" id="sub_categoria" maxlength="100">
                        <label for="sub_categoria" id="categoria_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                    <div class="col-lg-6">
                        <label for="img">Imagem: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="img" id="img" maxlength="100">
                        <label for="img" id="img_error" class="error" style="display: none;">Não pode estar vazia</label>
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
        <button class="btn btn-primary" id="salvar_produto_action" onclick="salvar_produto()">Salvar</button>
    </div>
</div>

<script>
    function salvar_produto(insert_data = {}) {
        let exec = 0;
        document.getElementById("salvar_produto_action").disabled = true
        var name = document.getElementById('name').value;
        var price = document.getElementById('price').value;
        var marca = document.getElementById('marca').value;
        var categoria = document.getElementById('categoria').value;
        var sub_categoria = document.getElementById('sub_categoria').value;
        var img = document.getElementById('img').value;

        if (name.trim()) {
            exec++;
        } else {
            document.getElementById("name").style.border = "1px solid red"
            document.getElementById("name_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("name").style.border = "1px solid #e5e6e7"
                document.getElementById("name_error").style.display = "none"
            }, 2300);
        }

        if (price.trim()) {
            exec++;
        } else {
            document.getElementById("price").style.border = "1px solid red"
            document.getElementById("price_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("price").style.border = "1px solid #e5e6e7"
                document.getElementById("price_error").style.display = "none"
            }, 2300);
        }

        if (marca.trim()) {
            exec++;
        } else {
            document.getElementById("marca").style.border = "1px solid red"
            document.getElementById("marca_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("marca").style.border = "1px solid #e5e6e7"
                document.getElementById("marca_error").style.display = "none"
            }, 2300);
        }

        if (categoria.trim()) {
            exec++;
        } else {
            document.getElementById("categoria").style.border = "1px solid red"
            document.getElementById("categoria_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("categoria").style.border = "1px solid #e5e6e7"
                document.getElementById("categoria_error").style.display = "none"
            }, 2300);
        }

        if (sub_categoria.trim()) {
            exec++;
        } else {
            document.getElementById("sub_categoria").style.border = "1px solid red"
            document.getElementById("sub_categoria_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("sub_categoria").style.border = "1px solid #e5e6e7"
                document.getElementById("sub_categoria_error").style.display = "none"
            }, 2300);
        }

        if (img.trim()) {
            exec++;
        } else {
            document.getElementById("img").style.border = "1px solid red"
            document.getElementById("img_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("img").style.border = "1px solid #e5e6e7"
                document.getElementById("img_error").style.display = "none"
            }, 2300);
        }

        if (exec === 6) {
            insert_data = {};
            let verifica_produto_dados = {
                name: name.trim(),
                price: price,
                marca: marca.trim(),
                categoria: categoria.trim(),
                sub_categoria: sub_categoria.trim(),
                img: img
            };

            fetch('../../produtos/control/produto_verifica_existe.php', {
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
                    document.getElementById("name").value = ""
                    document.getElementById("price").value = ""
                    document.getElementById("marca").value = ""
                    document.getElementById("categoria").value = ""
                    document.getElementById("sub_categoria").value = ""
                    document.getElementById("img").value = ""
                    mostrar_mensagem_center_modal('Produto já cadastrado')
                    setTimeout(() => {
                        document.getElementById("salvar_produto_action").disabled = false
                    }, 5);
                } else if (verifica.trim() == "200") {        
                    insert_data = {
                        name: name.trim(),
                        price: price,
                        marca: marca.trim(),
                        categoria: categoria.trim(),
                        sub_categoria: sub_categoria.trim(),
                        img: img
                    };
                    insert_produto(insert_data);
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
            fetch('../../produtos/control/produto_adicionar_action.php', {
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
        }
    }
</script>