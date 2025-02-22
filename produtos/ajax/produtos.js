function add_produto() {
    fetch('../../produtos/control/produto_adicionar.php', {
        method: 'GET',
    })
        .then((response) => response.text())
        .then((html) => {
            $('#modal_window').find('.modal-content').html('');
            $('#modal_window').find('.modal-content').html(html);
            $('#modal_window').modal('show');
        })
        .catch((error) => {
            console.error(error);
        });
}

function excluir(id, text) {
    let content = `
    <div class="modal-header">
        <h4 class="modal-title">Excluir produto</h4></div>
        <div class="modal-body">
            <h3><center>Confirmar exclusão do produto <br><strong>'` + text + `'</strong> ?</center></h3>
        </div>
    <div class="modal-footer">
        <button type="button" id="excluir" class="btn btn-primary" onclick="delete_produto('` + id + `','` + text + `')">Sim</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
    </div>
    `
    $('#modal').modal('show');
    $('#modal').find('.modal-content').html(content);
    $('#modal').modal('show');
}

function delete_produto(id, text = "") {
    fetch('../../produtos/control/produto_remover.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id: id
        })
    })
        .then((response) => response.text())
        .then((data) => {
            fechar()
            listarproduto()
            if (data.trim()) {
                show_error_modal_produto(data, text)
            }
        })
        .catch((error) => {
            console.error(error);
        });
}

function show_error_modal_produto(message, text = '') {
    let content_error =
        `
    <div class="modal-header">
        <center><h3 class="modal-title" data-i18n=""><i class="bi bi-exclamation-triangle"></i> Aviso</h3></center>
    </div>
    <div class="modal-body">
         <center><h4>`+ message + `</h4></center>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default" type="button" data-dismiss="modal" data-i18n="page_auth_02.pa_09">Fechar</button>
    </div>
    `
    $('#modal').modal('show');
    $('#modal').find('.modal-content').html(content_error.replace('#_txt_#', text));
    $('#modal').find('show');
}

function editar(id) {
    fetch('../../produtos/control/produto_editar.php', {
        method: 'POST',
        body: JSON.stringify({
            id: id
        })
    })
        .then((response) => response.text())
        .then((html) => {
            $('#modal_window').find('.modal-content').html('');
            $('#modal_window').find('.modal-content').html(html);
            $('#modal_window').modal('show');
        })
        .catch((error) => {
            console.error(error);
        });
}

// function editarImg(id) {
//     fetch('../../produtos/control/produto_editar_img.php', {
//         method: 'POST',
//         body: JSON.stringify({
//             id: id
//         })
//     })
//         .then((response) => response.text())
//         .then((html) => {
//             $('#modal_window').find('.modal-content').html('');
//             $('#modal_window').find('.modal-content').html(html);
//             $('#modal_window').modal('show');
//         })
//         .catch((error) => {
//             console.error(error);
//         });
// }

function fechar() {
    $('#modal').modal('hide');
    $('#modal').find('.modal-content').html('');
}
function fechar_window() {
    $('#modal').modal('hide');
    $('#modal').find('.modal-content').html('');
    $('#modal_window').find('.modal-content').html('');
    $('#modal_window').modal('hide');
}

function listarproduto(filtro = {}) {
    let page = document.getElementById('table_produto').getAttribute('page')
    filtro.page = Number(page)
    let page_limit = 15
    var page_lenght = document.getElementById('table_produto_length');
    if (page_lenght) {
        page_limit = page_lenght.value
    }
    let active_order = get_ordes_produto_active()
    if (active_order.length != 0) {
        filtro.dorder = active_order[0].ordem
        filtro.orderb = active_order[0].campo
    }
    let edit = '';
    let remover = '';
    filtro.entrada = page_limit
    const tabela = document.getElementById('table_produto');
    const tbody = tabela.querySelector('tbody');
    tbody.innerHTML = ""
    document.getElementById("find_indicator").innerHTML = ""
    if (filtro.name) {
        document.getElementById("find_indicator").innerHTML = "<input type='hidden' id='time_finder' value='" + filtro.name + "'><strong>Buscando por: " + filtro.name + "</strong>"
    }
    fetch('../../produtos/control/produto_listar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(filtro),
    })
        .then((response) => response.json())
        .then((content) => {
            if (content.data) {
                if (content.pages) {
                    render_paginacao_produto(content.pages)
                }
                document.getElementById('table_produto').setAttribute('page', content.currentpage);
                tratarPaginacao_produto(content.currentpage, 'block')
                content.data.forEach(item => {
                    const row = document.createElement('tr');
                    if (item.id) {
                        console.log(item.id);
                        edit = `<button onclick="editar('${item.id}')" class="btn btn-primary dim" type="button"><i class="fa fa-pencil" data-placement="bottom" style="cursor:pointer; padding: 2px"  title="Alterar"></i></button>`;
                    }
                    if (item.id) {
                        remover = `<button onclick="excluir('${item.id}','${item.name ?? ""}')" class="btn btn-danger dim" type="button"><i class="fa fa-trash" data-placement="bottom" style="cursor:pointer; padding: 2px"  title="Excluir"></i></button>`;
                    }
                    row.innerHTML = `
                        <!-- <td>
                            <center>
                                <input type="radio" id="${item.id}_seg" name="check_produto" value="${item.id}">
                            </center>
                        </td> -->
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.price}</td>
                        <td>${item.marca}</td>
                        <td>${item.categoria}</td>
                        <td>${item.sub_categoria}</td>
                        <td><img src="${item.img}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover;"></td>
                        <td><center>${edit}${remover}</center></td>
                    `;
                    row.setAttribute('recid', item.recid);
                    row.classList.add("tr-produto-" + item.id)
                    tbody.appendChild(row);
                });
                let start_page = content.start != 0 ? content.start : 1
                document.getElementById("cont_inicio_paginacao").innerHTML = start_page
                document.getElementById("cont_fim_paginacao").innerHTML = content.pagelimit
                document.getElementById("cont_total_paginacao").innerHTML = content.total
            } else {
                render_paginacao_produto()
                document.getElementById("cont_inicio_paginacao").innerHTML = 0
                document.getElementById("cont_fim_paginacao").innerHTML = 0
                document.getElementById("cont_total_paginacao").innerHTML = 0
                const row = document.createElement('tr');
                row.innerHTML = `<td></td><td colspan="4"><center>Nenhum resultado encontrado</center></td>
        `;
                tbody.appendChild(row);
            }
        })
        .catch((error) => {
            console.error(error);
        });
}
function fechar() {
    $('#modal').fadeTo("slow", 0.9).modal('hide');
}
function update_save_mov(componente) { }

function click_check_produto(id_check) {
    let check = id_check + "_seg"
    check = document.getElementById(check)
    check.click();
}
function change_style_tr_produto(id) {
    const tabela = document.getElementById('table_produto');
    const tbody = tabela.querySelector('tbody');
    var trs = tbody.querySelectorAll('tr')
    for (let index = 0; index < trs.length; index++) {
        trs[index].classList.remove('tr-selected');
    }
    var tr = tabela.querySelector('.tr-produto-' + id);
    tr.classList.add('tr-selected')
}

function action_tab_produto(tab, id_produto) {
    var divs = document.querySelectorAll('div#table_details');
    divs.forEach(function (div) {
        div.style.display = 'none';
    });
    if (tab == "tab_rede") {
        var table_details = document.getElementById(tab).querySelector('#table_details');
        table_details.style.display = "block"
        verRedes(id_produto)
    }
}
function search_datagrid_produto(value) {
    if (value.trim()) {
        if (value.length >= 3) {
            clear_search_produto()
            reset_order_produto()
            let filtro_busca =
            {
                name: value
            };
            listarproduto(filtro_busca)
        }
    } else {
        listarproduto()
    }
}
function reset_busca_produto() {
    document.getElementById('find_indicator').innerHTML = ""
    document.getElementById('search_produto').value = ""
    reset_order_produto()
    document.getElementById('name_ordericon').click();
}
function clear_search_produto() {
    document.getElementById('search_produto').value = ""
}
function set_order_table_produto(index) {
    let filtro_busca = {};
    let finder = document.getElementById('search_produto').value;
    if (finder.trim()) {
        filtro_busca.name = finder
    }
    if (document.getElementById("time_finder")) {
        filtro_busca.name = document.getElementById("time_finder").value
    }
    let pre_fix = "_ordericon"
    let icon_order = document.getElementById(index + pre_fix)
    if (icon_order) {
        reset_order_produto(icon_order.id);
        var target = icon_order.getAttribute('target');

        if (target == 'default') {
            icon_order.style.color = 'gray'
            icon_order.classList.remove('bi-arrow-down-up');
            icon_order.classList.add('bi-sort-down-alt');
            icon_order.setAttribute('target', 'asc');
            listarproduto(filtro_busca)
        } else {
            if (target == "asc") {
                icon_order.style.color = 'gray'
                icon_order.classList.remove('bi-sort-down-alt');
                icon_order.classList.add('bi-sort-down');
                icon_order.setAttribute('target', 'desc');
                listarproduto(filtro_busca)
            } else if (target == "desc") {
                icon_order.style.color = 'gray'
                icon_order.classList.remove('bi-sort-down');
                icon_order.classList.add('bi-sort-down-alt');
                icon_order.setAttribute('target', 'asc');
                listarproduto(filtro_busca)
            }
        }
    }
}
function reset_order_produto(id = '') {
    const orders = document.querySelectorAll('[name="orders_table"]');
    orders.forEach(order => {
        if (id) {
            if (order.id != id) {
                order.style.color = 'gainsboro'
                order.className = '';
                order.setAttribute('target', 'default');
                order.classList.add("bi", "bi-arrow-down-up");
            }
        } else {
            order.style.color = 'gainsboro'
            order.className = '';
            order.setAttribute('target', 'default');
            order.classList.add("bi", "bi-arrow-down-up");
        }
    });
}
function get_ordes_produto_active() {
    let filter_order = []
    const orders = document.querySelectorAll('[name="orders_table"]');
    orders.forEach(order => {
        let direction = order.getAttribute('target');
        let field = order.getAttribute('order');
        if (direction != "default") {

            filter_order.push({ campo: field, ordem: direction });
        }
    });
    return filter_order
}
function render_paginacao_produto(cont = 1) {
    document.getElementById('paginacao_table_produto').innerHTML = ``
    let html_numbers = ``
    cont = Number(cont)
    for (let i = 1; i <= cont; i++) {
        if (i == 1) {
            if (i == cont) {
                html_numbers += `
                    <li class="paginate_button disabled" style="display: none;"  id="paginacao_btn_pen"><a href="#" aria-controls="table_produto" data-dt-idx="6" tabindex="0">…</a></li>
                `
            }
            html_numbers += `
                <li class="paginate_button paginacao_btn ${i == cont ? "paginacao_ultimo" : ""} active " id="paginacao_btn${i}" valor="${i}" active="true" onclick="tratarPaginacao_produto(${i})" ><a href="#" aria-controls="table_produto" tabindex="0">${i}</a></li>
                <li class="paginate_button disabled " style="display: none;"  id="paginacao_btn_seg"><a href="#" aria-controls="table_produto" data-dt-idx="2" tabindex="0">…</a></li>
            `
        } else if (i == cont) {
            html_numbers += `
                <li class="paginate_button disabled"  id="paginacao_btn_pen"><a href="#" aria-controls="table_produto" data-dt-idx="6" tabindex="0">…</a></li>
                <li class="paginate_button paginacao_btn paginacao_ultimo" id="paginacao_btn${i}" active="false" onclick="tratarPaginacao_produto(${i})" ><a href="#" aria-controls="table_produto" tabindex="0">${i}</a></li>
            `
        } else {
            html_numbers += `
                <li class="paginate_button paginacao_btn" style="${i > 5 ? "display:none;" : ""}" id="paginacao_btn${i}" active="false" onclick="tratarPaginacao_produto(${i})" ><a href="#" aria-controls="table_produto" tabindex="0">${i}</a></li>
            `
        }
    }
    let html = ` 
        <li class="paginate_button previous" id="table_produto_previous" onclick="anteriorPaginacao_produto()"><a href="#" aria-controls="table_produto" data-dt-idx="0" tabindex="0">Anterior</a></li> 
    ${html_numbers}
        <li class="paginate_button next" id="table_produto_next" onclick="proximoPaginacao_produto()"><a href="#" aria-controls="table_produto" data-dt-idx="8" tabindex="0">Próximo</a></li>
    `
    document.getElementById('paginacao_table_produto').innerHTML = html
}


function tratarPaginacao_produto(num, block = null) {
    num = Number(num)
    let btns = document.querySelectorAll(".paginacao_btn")
    let ultimo = 0
    for (let index = 0; index < btns.length; index++) {
        btns[index].classList.remove('active')
        btns[index].setAttribute('active', 'false')
        let id = btns[index].id.replace("paginacao_btn", "")
        let num_e = 0
        if (id != '_pen' && id != '_seg') {
            num_e = Number(id)
        }
        if (num_e > 0 && ultimo < num_e) {
            ultimo = Number(num_e)
        }
        if (num < 5) {
            if (num_e > 5) {
                btns[index].style.display = 'none'
            } else {
                btns[index].style.display = 'inline'
            }
        } else {
            let ant = Number(num) - 1
            let prox = Number(num) + 1
            if (num_e == num || num_e == ant || num_e == prox) {
                btns[index].style.display = 'inline'
            } else {
                btns[index].style.display = 'none'
            }
        }
    }
    document.getElementById('paginacao_btn1').style.display = 'inline'
    if (ultimo > 1) {
        document.getElementById('paginacao_btn_pen').style.display = 'inline'
        document.getElementById('paginacao_btn' + ultimo).style.display = 'inline'
        if (num < 5) {
            document.getElementById('paginacao_btn_seg').style.display = 'none'
        } else {
            document.getElementById('paginacao_btn_seg').style.display = 'inline'
            if (num == (ultimo - 1) || num == ultimo) {
                document.getElementById('paginacao_btn_pen').style.display = 'none'
            }
        }
    } else {
        document.getElementById('paginacao_btn_pen').style.display = 'none'
        document.getElementById('paginacao_btn_seg').style.display = 'none'
    }
    document.getElementById('paginacao_btn' + num).setAttribute('active', 'true')
    document.getElementById('paginacao_btn' + num).classList.add('active')
    if (!block) {
        let filtro_busca =
        {
            nextpage: num
        };
        if (document.getElementById("time_finder")) {
            filtro_busca.name = document.getElementById("time_finder").value
        }
        listarproduto(filtro_busca)
    }
}

function anteriorPaginacao_produto() {
    let btn = document.querySelector(".paginacao_btn.active")
    let id = btn.id.replace("paginacao_btn", "")
    let num_e = 0
    if (id != '_pen' && id != '_seg') {
        num_e = Number(id)
    }
    if (num_e > 1) {
        tratarPaginacao_produto(num_e - 1)
    }
}
function proximoPaginacao_produto() {
    let ultimo = document.querySelector(".paginacao_btn.paginacao_ultimo")
    let btn = document.querySelector(".paginacao_btn.active")
    let id = btn.id.replace("paginacao_btn", "")
    let id_u = ultimo.id.replace("paginacao_btn", "")
    let num_e = 0
    let num_u = 0
    if (id != '_pen' && id != '_seg') {
        num_e = Number(id)
    }
    if (id_u != '_pen' && id_u != '_seg') {
        num_u = Number(id_u)
    }
    if (num_e < num_u) {
        tratarPaginacao_produto(num_e + 1)
    }
}
function restart_lenght_table_produto() {
    let filtro_busca = {}
    if (document.getElementById("time_finder")) {
        filtro_busca.name = document.getElementById("time_finder").value
    }
    listarproduto(filtro_busca)
}

function mostrar_mensagem(msg) {
    if (msg) {
        let content = `
        <div class="modal-header language-json">
          <center><h3 class="modal-title" data-i18n=""><i class="bi bi-exclamation-triangle"></i> Aviso</h3></center>
        </div>
        <div class="modal-body language-json">
             <h3><center>`+ msg + `</center></center>
        </div>
        <div class="modal-footer language-json">
            <button class="btn btn-primary" type="button" data-dismiss="modal" data-i18n="page_auth_02.pa_09">Fechar</button>
        </div>
        `
        $('#modal').modal('show');
        $('#modal').find('.modal-content').html(content);
        $('#modal').find('show');
    }
}

function collapse_sections(id_expand = null) {
    let sections = document.querySelectorAll("[name='expand_section']")
    if (sections) {
        let exec = true;
        sections.forEach(section => {
            exec = true;
            if (section.id == ("expand_" + id_expand.replace("#", ""))) {
                exec = false;
            }
            if (exec === true) {
                if (section.className.includes('fa-chevron-up')) {
                    section.classList.remove('fa-chevron-up')
                    section.classList.add('fa-chevron-down')
                    document.getElementsByName(section.id.replace("expand_", "content_"))[0].style.display = 'none'
                }
            }
        });
    }
}

function verify_expand(id_expand) {
    event.preventDefault()
    if (id_expand) {
        id_expand = id_expand.replace("#", "");

        let target_section = document.getElementById(id_expand);

        let busca_area_expandir = document.getElementById("expand_" + id_expand.replace("#", ""))

        collapse_sections(id_expand)

        if (busca_area_expandir.className.trim() == "fa fa-chevron-down") {
            click_expand_content(busca_area_expandir).then(() => {
                setTimeout(() => {
                    target_section.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 250);
            });

        } else {
            target_section.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    }
}

function click_expand_content(busca_area_expandir) {
    return new Promise((resolve) => {
        busca_area_expandir.click();
        resolve();
    });
}