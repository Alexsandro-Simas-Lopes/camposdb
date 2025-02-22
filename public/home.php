<?php
require_once("../parametro/configDB/connectDB.php");
$PDO = connectDB::getInstance();
  $sql = "SELECT * FROM produtos ORDER BY Id ASC";
  $stm = $PDO->prepare($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Produtos Campos</title>
        <link rel="icon" type="image/x-icon" href="assets/ICONE.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" href="css/style_itemPage.css" />
        
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16540121873"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
    
            gtag('config', 'AW-16540121873');
        </script>
        
        <!-- End Google Tag Manager -->
        <script>
        window.onload = () => {
            if (typeof gtag === 'function') {
                gtag('event', 'conversion', {
                    'send_to': 'AW-16540121873/WqmECJ2wpPYZEJH2-M49',
                    'value': 1.0,
                    'currency': 'BRL'
                });
                } else {
                    console.error('gtag não está definido. Verifique o carregamento do script gtag.js.');
                }
            };
        </script>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="fullscreen-image navbar-light bg-light"><!-- navbar-custom-top-header -->
          <div class="container px-6">
              <div class="row">
                  <div class="col">
                  <!-- Logo -->
                  <a href="home.php" class="navbar-brand">
                      <img class="logo-image" src="assets/assets_img/logo-home2.png" alt="Campos" width="140px"> <!-- Reduzindo o tamanho da logo -->
                  </a>
                  </div>
                  <div class="col">
                      <div class="d-flex align-items-center">
                          <!-- Ícones de redes sociais -->
                          <a href="https://seu-link-de-redirecionamento" class="social-icon me-2">
                              <span class="social-ico-icon">
                                  <i class="bi bi-facebook"></i>
                              </span>
                          </a>
                          <a href="https://wa.me/5592991144098" class="social-icon me-2">
                              <span class="social-ico-icon">
                                  <i class="bi bi-whatsapp"></i>
                              </span>
                          </a>
                          <a href="https://www.instagram.com/produtoscampos/" class="social-icon me-2">
                              <span class="social-ico-icon">
                                  <i class="bi bi-instagram"></i>
                              </span>
                          </a>
                          <!-- Botão Carrinho -->
                          <form style="display: flex !important;" action="carrinho.php">
                          <button type="submit" class="btn position-relative custom-button m-2">
                              <span class="d-none d-lg-inline">Carrinho</span> <!-- Oculta o texto em dispositivos móveis -->
                              <i class="bi-cart-fill me-1"></i>
                              <span style="background-color: var(--bs-gray-100);" id="badgeCart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                              <!-- <span class="visually-hidden">unread messages</span> -->
                              </span>
                          </button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        </nav> 
        <!-- Header-->
        <button class="float-button custom-button btn-lg" type="submit" id="float-button-carrinho">
          <i class="bi-cart-fill me-1"></i>
          <span class="badge" id="badgeCartFloat">0</span>
        </button>

        <div class="div_marcacao"></div>
        <img class="fullscreen-image" src="assets/assets_img/CAPA.png">

        <section id="filter"></section>
        <nav class="navbar-custom-top-header" id="filtro">
          <div class="navbar-left-custom-top-header">
            <ul class="nav-links-custom-top-header">
              <li><a href="#"  onclick="loja.metodos.obterItensPorTag(1)">Pássaros</a></li>
              <li><a href="#"  onclick="loja.metodos.obterItensPorTag(2)">Cães</a></li>
              <li><a href="#"  onclick="loja.metodos.obterItensPorTag(3)">Gatos</a></li>
              <li class="d-none d-lg-inline"><a href="#" onclick="loja.metodos.obterItensPorTag(4)">Roedores</a></li>
              <li class="d-none d-lg-inline"><a href="#" onclick="loja.metodos.obterItensPorTag(5)">Peixes</a></li>
              <li><a href="#" id="ver_mais_link">Ver mais</a></li> <!-- ESTÁ COM DEFEITO! -->
              
            </ul>
          </div>

          <div class="navbar-right-custom-top-header">
            <div class="search-form-custom-top-header">
              <input  id="inputPesquisa" type="text" placeholder="  Buscar..." style="border-radius: 20px; border: 2px solid green;">
              <button id="btnPesquisar" class="btn btn-success my-2 my-sm-0 rounded-circle"  
              style="width: 40px; height: 40px; background-color: green; margin-left: 12px !important;"
              onclick="loja.metodos.obterItensPorPesquisa()"><i class="bi-search"></i></button>
            </div>
          </div>
        </nav>
        


        <style>/* Reset CSS */
          * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
          }
          
          /* Basic styling */
          body {
            font-family: Arial, sans-serif;
          }
          
          /* FIXED-TOP NA NAVBAR DE PESQUISA E FILTRAGEM DE PRODUTO */
          .sticky {
            position: fixed;
            top: 0;
            width: 100%;
          }
          
          .navbar-custom-top-header {
            display: flex;
            justify-content: space-around;
            padding: 5px 0px;
            background-color: #F8F9FA;
            color: #fff;
            align-items: center;
            z-index: 1;
          }
          
          .nav-links-custom-top-header {
            list-style: none;
            display: flex;
            justify-content: space-around; /* Alterado para space-around */
            align-items: center; /* Centraliza verticalmente */
            margin-bottom: 0 !important;
          }
          
          .nav-links-custom-top-header li {
            margin-right: 10px;
            padding: 5px !important;
            max-width: 150px; /* Defina a largura máxima desejada */
            white-space: nowrap; /* Impede que o texto quebre em linhas */
            /*overflow: hidden;  Oculta o conteúdo que ultrapassa a largura máxima */
            /*text-overflow: ellipsis;  Adiciona reticências (...) para indicar que há mais conteúdo */
          }

          .nav-links-custom-top-header li :hover {
            background-color: #28a745; /* Cor de fundo da badge */
            color: #fff; /* Cor do texto da badge */
            border-radius: 10px; /* Bordas arredondadas da badge */
          }
          
          .nav-links-custom-top-header li:last-child {
            margin-right: 0;
          }
          
          .nav-links-custom-top-header a {

            color: #28a745; /* Cor verde */
            transition: color 0.3s ease; /* Transição suave */
            text-decoration: none;
            padding: 10px;
          }
          
          .navbar-right-custom-top-header {
            display: flex;
            align-items: center;
          }
          
          .search-form-custom-top-header {
            display: flex;
            flex-wrap: nowrap; /* Impede a quebra de linha */
          }
          
          .search-form-custom-top-header input[type="text"] {
            padding: 5px;
            border: none;
            border-radius: 5px 0 0 5px;
          }
          
          .search-form-custom-top-header button {
            padding: 5px 10px;
            background-color: #666;
            border: none;
            border-radius: 0 5px 5px 0;
            color: #fff;
          }
          
          /* Responsive styles */
          @media screen and (max-width: 768px) {
            .navbar-custom-top-header {
              flex-direction: column;
              align-items: center;
            }
          
            .navbar-left-custom-top-header, .navbar-right-custom-top-header {
              width: 100%;
              text-align: center;
              margin-bottom: 10px;
            }
          
            .navbar-right-custom-top-header {
              order: -1; /* Move the search bar above the links */
            }
          
            .search-form-custom-top-header {
              width: 100%;
              /*flex-direction: row; /* Alterado para row */
              /*justify-content: space-between;  Novo */
              justify-content: center;
            }
          
            .search-form-custom-top-header input[type="text"], .search-form-custom-top-header button {
              width: calc(50% - 5px); /* Metade do espaço com 5px de margem entre eles */
              margin-bottom: 0; /* Remover margem inferior */
              border-radius: 5px;
            }
          
            .navbar-left-custom-top-header, .navbar-right-custom-top-header {
              justify-content: space-around; /* Alterado para space-around */
            }
          }
          
        </style>
                  
        <div class="dropdown-display">
            <div class="dropdown-menu-custom" id="dropdown-menu">
                <ul class="category-list">
                    <button class="dropdown-btn">Buscar</button>
                    <li class="category-item">
                        
                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Acessório para cães</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li><input name="verTodos" type="checkbox">Coleira</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Acessório para gatos</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li><input name="verTodos" type="checkbox">Coleira</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Acessório para pássaros</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li class="ver-todos">Ver Todos</li>
                            <li><input name="verTodos" type="checkbox">Bebedouro</li>
                            <li><input name="verTodos" type="checkbox">Banheira</li>
                            <li><input name="verTodos" type="checkbox">Caneca</li>
                            <li><input name="verTodos" type="checkbox">Comedouro</li>
                            <li><input name="verTodos" type="checkbox">Kit</li>
                            <li><input name="verTodos" type="checkbox">Porta vitamina</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Acessório para roedores</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li class="ver-todos">Ver Todos</li>
                            <li><input name="verTodos" type="checkbox">Bebedouro</li>
                            <li><input name="verTodos" type="checkbox">Comedouro</li>
                            <li><input name="verTodos" type="checkbox">Kit</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Alimento para pássaros</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li class="ver-todos">Ver Todos</li>
                            <li><input name="verTodos" type="checkbox">Sementes in natura</li>
                            <li><input name="verTodos" type="checkbox">Extrusada</li>
                            <li><input name="verTodos" type="checkbox">Farinha</li>
                            <li><input name="verTodos" type="checkbox">Ração</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Alimento para peixes ornamentais</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li><input name="verTodos" type="checkbox">Ração</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Alimento para roedores</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li class="ver-todos">Ver Todos</li>
                            <li><input name="verTodos" type="checkbox">Feno</li>
                            <li><input name="verTodos" type="checkbox">Sementes in natura</li>
                            <li><input name="verTodos" type="checkbox">Ração</li>
                            <li><input name="verTodos" type="checkbox">Extrusada</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Higiene para gatos</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li><input name="verTodos" type="checkbox">Granulado</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Higiene para roedores</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li class="ver-todos">Ver Todos</li>
                            <li><input name="verTodos" type="checkbox">Pó</li>
                            <li><input name="verTodos" type="checkbox">Granulado</li>
                            <li><input name="verTodos" type="checkbox">Serragem</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Petiscos para cães</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li class="ver-todos">Ver Todos</li>
                            <li><input name="verTodos" type="checkbox">Ossinhos</li>
                            <li><input name="verTodos" type="checkbox">Bifinhos</li>
                            <li><input name="verTodos" type="checkbox">Biscoito</li>
                            <li><input name="verTodos" type="checkbox">Naturais</li>
                            <li><input name="verTodos" type="checkbox">Palitos</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Petiscos para roedores</span>
                        </span>

                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li><input name="verTodos" type="checkbox">Biscoito</li>
                        </ul>
                    </li>
                    <li class="category-item">

                        <span class="">
                          <i class="bi bi-bag-fill"></i>
                          <span class="category">Suplemento para pássaros</span>
                        </span>
                      
                        <ul class="sub-category-list collapsed" style="padding-left: 20px;">
                            <li class="ver-todos">Ver Todos</li>
                            <li><input name="verTodos" type="checkbox">Areia</li>
                            <li><input name="verTodos" type="checkbox">Líquido</li>
                            <li><input name="verTodos" type="checkbox">Comprimido</li>
                            <li><input name="verTodos" type="checkbox">Farinha</li>
                            <li><input name="verTodos" type="checkbox">Ossos</li>
                        </ul>
                    </li>
                </ul>
                </div>
        </div>
        
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div id="itensProdutos" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                  <?php
                    while ($produt_data = $stm->fetch(PDO::FETCH_ASSOC)) {
                      echo "
                      <div class=\"col-12 mb-5\">
                          <div class=\"card h-100\">
                              <!-- Product image -->
                              <div class=\"card-cont\">
                                  <img class=\"card-img-top\" src=\"" . $produt_data['Img'] . "\" alt=\"...\" />
                              </div>

                              <!-- Product details -->
                              <div class=\"card-body p-4\">
                                  <div class=\"text-center\">
                                      <!-- Product name -->
                                      <h5 class=\"fw-bolder\">" . $produt_data['Name'] . "</h5>
                                      <!-- Product price -->
                                      <span class=\"price\">
                                          <span class=\"currency\">R$</span>
                                          <span class=\"value\">" . $produt_data['Price'] . "</span>
                                      </span>
                                  </div>
                              </div>

                              <!-- Product actions -->
                              <div class=\"card-footer p-4 pt-0 border-top-0 bg-transparent\">
                                  <div class=\"text-center\">
                                      <a class=\"custom-button mt-auto\" href=\"item.php\" onclick=\"loja.metodos.verPaginaDoItem([
                                          '" . $produt_data['Img'] . "',
                                          '" . $produt_data['Name'] . "',
                                          '" . $produt_data['Id'] . "',
                                          '" . $produt_data['Price'] . "',
                                          '" . $produt_data['Marca'] . "'
                                      ])\">Comprar</a>
                                  </div>
                              </div>
                          </div>
                      </div>";
                    }
                  ?>
                
                </div>
            </div>

            <div style="display: flex; justify-content: center; align-items: center">
                <button id="btnVerMais" class="btn btn-outline-dark mt-auto " type="submit" onclick="loja.metodos.verMais()">
                    Veja Mais
                </button>
            </div>

        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright © 2024 Rugido Digital | Designed by Rugido Digital</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script type="text/javascript" src="../public/js/jquery-3.7.1.js"></script>
        <script type="text/javascript" src="../public/js/dados.js"></script>
        <script type="text/javascript" src="../public/js/carrinho.js"></script>
        <script type="text/javascript" src="../public/js/app.js"></script>
        
        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RXN6MPS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    </body>
</html>
