<?php
    require_once("../../produtos/model/produtodao.php");
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
                    <div class="col-lg-12">
                        <label for="name_editar">Nome: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="name_editar" id="name_editar" value="<?= $produto->getName(); ?>" maxlength="150">
                        <label for="name_editar" id="name_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="price_editar">Preço: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="price_editar" id="price_editar" value="<?= $produto->getPrice(); ?>" maxlength="150">
                        <label for="price_editar" id="price_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="marca_editar">Marca: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="marca_editar" id="marca_editar" value="<?= $produto->getMarca(); ?>" maxlength="50">
                        <label for="marca_editar" id="marca_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="categoria_editar">categoria: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="categoria_editar" id="categoria_editar" value="<?= $produto->getCategoria(); ?>" maxlength="50">
                        <label for="categoria_editar" id="categoria_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="sub_categoria_editar">Sub Categoria: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="sub_categoria_editar" id="sub_categoria_editar" value="<?= $produto->getSub_Categoria(); ?>" maxlength="50">
                        <label for="sub_categoria_editar" id="sub_categoria_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="img_editar">Imagem: <span style="color: red;">*</span></label>
                        <input type="file" class="form-control" name="img_editar" accept="img_editar/*" id="img_editar" value="<?= $produto->getImg(); ?>" maxlength="150">
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
        <button class="btn btn-primary" id="editar_produto_action" onclick="salvar_alteracao_editar()">Salvar Alteração</button>
    </div>
</div>

<script>
    
    function salvar_alteracao_editar() {
        let exec = 0;
        document.getElementById("editar_produto_action").disabled = true;

        var name = document.getElementById('name_editar').value;
        var price = document.getElementById('price_editar').value;
        var marca = document.getElementById('marca_editar').value;
        var categoria = document.getElementById('categoria_editar').value;
        var sub_categoria = document.getElementById('sub_categoria_editar').value;
        var imgInput = document.getElementById('img_editar');
        var imgFile = imgInput.files[0]; // Obtém o arquivo selecionado (se houver)

        // Se houver uma nova imagem, faz o upload
        let imgUrl = "";
        if (imgFile) {
            const formData = new FormData();
            formData.append("img", imgFile);

            fetch("../../produtos/control/upload.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.imgUrl) {
                    imgUrl = data.imgUrl; // URL da imagem salva
                    console.log("Imagem URL Nova", imgUrl);
                } else {
                    console.error("Erro no upload da imagem:", data.error);
                    document.getElementById("editar_produto_action").disabled = false;
                    return;
                }
            })
            .catch(error => {
                console.error("Erro ao enviar a imagem:", error);
                document.getElementById("editar_produto_action").disabled = false;
                return;
            });
        } else {
            // Se não houver uma nova imagem, utiliza a imagem atual (imgUrl precisa ser passada no update_data)
            imgUrl = update_data.img || ""; 
            console.log("Imagem URL Atual", imgUrl);
        }

        // Validação dos campos
        if (name.trim()) {
            exec++;
        } else {
            document.getElementById("name_editar").style.border = "1px solid red";
            document.getElementById("name_editar_error").style.display = "block";
            setTimeout(() => {
                document.getElementById("name_editar").style.border = "1px solid #e5e6e7";
                document.getElementById("name_editar_error").style.display = "none";
            }, 2300);
        }

        if (price.trim()) {
            exec++;
        } else {
            document.getElementById("price_editar").style.border = "1px solid red";
            document.getElementById("price_editar_error").style.display = "block";
            setTimeout(() => {
                document.getElementById("price_editar").style.border = "1px solid #e5e6e7";
                document.getElementById("price_editar_error").style.display = "none";
            }, 2300);
        }

        if (marca.trim()) {
            exec++;
        } else {
            document.getElementById("marca_editar").style.border = "1px solid red";
            document.getElementById("marca_editar_error").style.display = "block";
            setTimeout(() => {
                document.getElementById("marca_editar").style.border = "1px solid #e5e6e7";
                document.getElementById("marca_editar_error").style.display = "none";
            }, 2300);
        }

        if (categoria.trim()) {
            exec++;
        } else {
            document.getElementById("categoria_editar").style.border = "1px solid red";
            document.getElementById("categoria_editar_error").style.display = "block";
            setTimeout(() => {
                document.getElementById("categoria_editar").style.border = "1px solid #e5e6e7";
                document.getElementById("categoria_editar_error").style.display = "none";
            }, 2300);
        }

        if (sub_categoria.trim()) {
            exec++;
        } else {
            document.getElementById("sub_categoria_editar").style.border = "1px solid red";
            document.getElementById("sub_categoria_editar_error").style.display = "block";
            setTimeout(() => {
                document.getElementById("sub_categoria_editar").style.border = "1px solid #e5e6e7";
                document.getElementById("sub_categoria_editar_error").style.display = "none";
            }, 2300);
        }

        if (exec === 5) {
            let verifica_produto_dados = {
                name: name.trim(),
                price: price,
                marca: marca.trim(),
                categoria: categoria.trim(),
                sub_categoria: sub_categoria.trim(),
                img: imgUrl // URL da imagem (nova ou mantida)
            };

            // Verifica se o produto já existe
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
                    mostrar_mensagem_center_modal('Produto já cadastrado');
                    document.getElementById("editar_produto_action").disabled = false;
                } else if (verifica.trim() == "200") {
                    // Se o produto não existir, realiza a edição no banco
                    update_data = {
                        id: update_data.id, // ID do produto que será editado
                        name: name.trim(),
                        price: price,
                        marca: marca.trim(),
                        categoria: categoria.trim(),
                        sub_categoria: sub_categoria.trim(),
                        img: imgUrl // Usa a URL correta da imagem (nova ou mantida)
                    };
                    editar_produto_no_banco(update_data); // Função para editar no banco
                } else {
                    fechar_window();
                    mostrar_mensagem('Houve um erro (Tente novamente)');
                    document.getElementById("editar_produto_action").disabled = false;
                }
            })
            .catch((error) => {
                console.error(error);
                document.getElementById("editar_produto_action").disabled = false;
            });
        } else {
            document.getElementById("editar_produto_action").disabled = false;
        }
    }

    function editar_produto_no_banco(update_data) {
        // Função que envia a atualização do produto para o banco de dados
        fetch('../../produtos/control/produto_editar_action.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(update_data),
        })
        .then((response) => response.text())
        .then((data) => {
            console.log(data);
            fechar_window();
            listarproduto();
        })
        .catch((error) => {
            console.error(error);
            mostrar_mensagem('Houve um erro ao editar o produto');
        });
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
                        <div class="col-lg-12">
                            <label for="name_editar">Nome: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="name_editar" id="name_editar" value="<?= $produto->getName(); ?>" maxlength="150">
                            <label for="name_editar" id="name_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="price_editar">Preço: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="price_editar" id="price_editar" value="<?= $produto->getPrice(); ?>" maxlength="150">
                            <label for="price_editar" id="price_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="marca_editar">Marca: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="marca_editar" id="marca_editar" value="<?= $produto->getMarca(); ?>" maxlength="50">
                            <label for="marca_editar" id="marca_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="categoria_editar">categoria: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="categoria_editar" id="categoria_editar" value="<?= $produto->getCategoria(); ?>" maxlength="50">
                            <label for="categoria_editar" id="categoria_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="sub_categoria_editar">Sub Categoria: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="sub_categoria_editar" id="sub_categoria_editar" value="<?= $produto->getSub_Categoria(); ?>" maxlength="50">
                            <label for="sub_categoria_editar" id="sub_categoria_editar_error" class="error" style="display: none;">Não pode estar vazia</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="img_editar">Imagem: <span style="color: red;">*</span></label>
                            <input type="file" class="form-control" name="img_editar" accept="img/*" id="img_editar" value="<?= $produto->getImg(); ?>" maxlength="150">
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
            <button class="btn btn-primary" id="editar_produto_action" onclick="salvar_alteracao_editar()">Salvar Alteração</button>
        </div>
    </div>

    <script>
    function salvar_alteracao_editar() {
        let exec = 0;
        var marca_editar = document.getElementById('marca_editar').value;
        var name_editar = document.getElementById('name_editar').value;
        var img_editar = document.getElementById('img_editar').value;
        var categoria_editar = document.getElementById('categoria_editar').value;
        var sub_categoria_editar = document.getElementById('sub_categoria_editar').value;
        var price_editar = document.getElementById('price_editar').value;

        if (marca_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_produto_editar()
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
            expand_dados_gerais_produto_editar()
            document.getElementById("name_editar").style.border = "1px solid red"
            document.getElementById("name_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("name_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("name_editar_error").style.display = "none"
            }, 2300);
        }

        if (img_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_produto_editar()
            document.getElementById("img_editar").style.border = "1px solid red"
            document.getElementById("img_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("img_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("img_editar_error").style.display = "none"
            }, 2300);
        }

        if (categoria_editar.trim()) {
            exec++;
        } else {
            expand_dados_gerais_produto_editar()
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
            expand_dados_gerais_produto_editar()
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
            expand_dados_gerais_produto_editar()
            document.getElementById("price_editar").style.border = "1px solid red"
            document.getElementById("price_editar_error").style.display = "block"
            setTimeout(() => {
                document.getElementById("price_editar").style.border = "1px solid #e5e6e7"
                document.getElementById("price_editar_error").style.display = "none"
            }, 2300);
        }

        if (document.getElementById("id_produto_editar").value) {
            exec++;
        } else {
            fechar_window();
            mostrar_mensagem('Houve um erro (Tente novamente)')
            listarproduto();
        }

        if (exec == 7) {
            fetch('../../produtos/control/produto_editar_action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    identificador: document.getElementById("id_produto_editar").value,
                    marca: marca_editar.trim(),
                    name: name_editar.trim(),
                    img: img_editar.trim(),
                    categoria: categoria_editar.trim(),
                    sub_categoria: sub_categoria_editar.trim(),
                    price: price_editar.trim(),
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
    } -->