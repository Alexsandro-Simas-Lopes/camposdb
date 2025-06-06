<?php ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Produtos Campos Fazer Pedido</title>
        <link rel="icon" type="image/x-icon" href="assets/ICONE.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16540121873"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
    
            gtag('config', 'AW-16540121873');
        </script>
        
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5RXN6MPS');</script>
        <!-- End Google Tag Manager -->
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

        <section id="Etapa1">
            <div class="container-mensagens" id="container-mensagens"></div>
            <!-- test section items section-->
            <div class="container-finalizar-compra">
                <h2 class="fw-bolder mb-4">Endereço de entrega: <button class="btn btn-success" type="button" onclick="preencherFormulario()">Já sou cliente</button></h2>
                
                <form id="clienteForm">
                    <div class="input-wrapper">
                        <label for="txtNome">Nome:</label>
                        <input type="text" id="txtNome" name="txtNome" placeholder="Informe seu Nome" required>
                    </div>

                    <div class="input-wrapper">
                        <label for="txtEmpresa">Nome da Empresa:</label>
                        <input type="text" id="txtEmpresa" name="txtEmpresa" placeholder="Informe o Nome da sua empresa" required>
                    </div>
                    
                    <div class="input-wrapper">
                        <label for="txtTelefone">Telefone de Conato:</label>
                        <input type="text" id="txtTelefone" name="txtTelefone" pattern="\(\d{2}\)\d{5}-\d{4}" maxlength="15" placeholder="(DD) 00000-0000" autocomplete="tel" required>
                    </div>

                    <div class="input-wrapper">
                        <label for="txtEndereco">Endereço:</label>
                        <input type="text" id="txtEndereco" name="txtEndereco" placeholder="Digite seu endereço" required>
                    </div>

                    <!-- Informacoes do Cliente BTN-Salvar -->
                    <div class="mb-3">
                        <label for="InformacoesCliente" class="form-label">Salvar informações:</label>
                        <div>
                            <button id="InformacoesCliente" name="InformacoesCliente" class="btn btn-outline-dark" type="button" onclick="salvarInformacoesCliente()">
                                Salvar <i class="bi bi-check2-circle"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <section class="py-5 bg-light">
                <div class="container-button-cart">
                    <button class="btn btn-outline-dark flex-shrink-1 mb-3" style="width: fit-content;"  type="button"
                        onclick="loja.metodos.voltar()">
                        <i class="bi-cart-fill me-1"></i>
                        Voltar
                    </button>
                    <button class="btn btn-outline-dark flex-shrink-1 mb-3" style="width: fit-content;"  type="button"
                        onclick="loja.metodos.resumoPedido()">
                        Revisar pedido
                        <i class="bi-cart-fill me-1"></i>
                    </button>
                </div>
            </section>
        </section>
        <section id="Etapa2" class="disable">
        
            <section class="py-5 bg-light">
                <div class="container px-4 px-lg-5 mt-5">
                    <h2 class="fw-bolder mb-4">Resumo do pedido:</h2>
                    <div id="itensProdutosCarrinho" class="col mr-0 ml-0 animated fadeIn hidden">
                        <!-- Lista -->

                        <div id="itensProdutosCarrinho" class="col mb-4">
                            <!-- Product image-->
                        </div>
                    </div>
                    <br>
                    <h2 id="total_compra" class="fw-bolder mb-4"> Total: <sup>R$ </sup> </h2>
                    <div class="container-button-cart">
                    <a class="btn btn-outline-dark flex-shrink-1 mb-3"  type="button"
                        onclick="loja.metodos.etapa1()">
                        <i class="bi-cart-fill me-1"></i>
                        Voltar
                    </a>
                    <a id="btnEtapaResumo" class="btn btn-outline-dark flex-shrink-1 mb-3"  type="button" href="">
                        <i class="bi-cart-fill me-1"></i>
                        Enviar Pedido
                    </a>
                </div>
            </section>
        </section>
        
        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RXN6MPS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright © 2024 Rugido Digital | Designed by Rugido Digital</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script type="text/javascript" src="http://localhost/camposdb/public/js/jquery-3.7.1.js"></script>
        <script type="text/javascript" src="http://localhost/camposdb/public/js/carrinho.js"></script>
        <script type="text/javascript" src="http://localhost/camposdb/public/js/fazerPedido.js"></script>
        

    </body>
</html>
