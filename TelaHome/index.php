<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: ../Login/login.php");
    exit();
}

// Verificar se é usuário master
$is_master = ($_SESSION['usuario'] === 'Admin1');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CPaaS Platform - Revolucionando comunicações empresariais com soluções inovadoras">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Estilo CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    <title>CPaaS Platform - Telecall</title>
    <link rel="icon" href="img/imageeeeeeem.png">
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <!-- Logo -->
            <div class="nav-logo">
                <a href="#home" class="logo-text">CPaaS</a>
            </div>

            <!-- Menu Principal -->
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#cpaas-section" class="nav-link smooth-scroll">
                        <i class="fas fa-info-circle"></i> CPaaS: O que é?
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#solucoes-1" class="nav-link smooth-scroll">
                        <i class="fas fa-cube"></i> Soluções
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#vantagens-1" class="nav-link smooth-scroll">
                        <i class="fas fa-star"></i> Vantagens
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#aplicativos-1" class="nav-link smooth-scroll">
                        <i class="fas fa-mobile-alt"></i> Aplicativos
                    </a>
                </li>
            </ul>

            <!-- Controles do Usuário -->
            <div class="user-controls">
                <a href="../Perfil/perfil.php" class="user-btn btn-perfil">
                    <i class="fas fa-user"></i> <span class="btn-text">Meu Perfil</span>
                </a>

                <?php if ($is_master): ?>
                    <button class="user-btn master-btn" onclick="abrirTelaMaster()">
                        <i class="fas fa-crown"></i> <span class="btn-text">Área Master</span>
                    </button>
                <?php endif; ?>

                <a href="../Login/logout.php" class="user-btn logout-btn">
                    <i class="fas fa-sign-out-alt"></i> <span class="btn-text">Sair</span>
                </a>
            </div>

            <!-- Menu Hamburguer -->
            <button class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </button>
        </nav>

        <!-- Botão Voltar ao Topo -->
        <div class="links">
            <a href="#" class="btn-topo">
                <i class="fas fa-chevron-up"></i>
            </a>
            <!-- Botão Contrate-nos -->
            <a href="#" id="contrateLink" class="contrate">
                <i class="fas fa-shopping-cart"></i> Contrate-nos
            </a>
        </div>

        <!-- Pop-ups de Compra -->
        <div id="overlay" class="overlay"></div>

        <!-- Pop-up Carrinho -->
        <div id="popup" class="popup">
            <div class="popup-header">
                <h2>
                    <i class="fas fa-shopping-cart"></i> Carrinho de compras
                </h2>
                <button id="fecharPopup" class="btn-fechar">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="popup-body">
                <h5>Selecione os produtos que deseja comprar</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="item1">
                            <label class="form-check-label" for="item1">
                                <i class="fas fa-shield-alt"></i> 2FA
                                <span class="valor">(R$ 179,90/mês)</span>
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="item2">
                            <label class="form-check-label" for="item2">
                                <i class="fas fa-phone-alt"></i> Número Máscara
                                <span class="valor">(R$ 184,90/mês)</span>
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="item3">
                            <label class="form-check-label" for="item3">
                                <i class="fab fa-google"></i> Google Verified Calls
                                <span class="valor">(R$ 189,90/mês)</span>
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="item4">
                            <label class="form-check-label" for="item4">
                                <i class="fas fa-sms"></i> SMS Programável
                                <span class="valor">(R$ 193,90/mês)</span>
                            </label>
                        </div>
                    </li>
                </ul>

                <div class="produtos-selecionados">
                    <h5>Produtos selecionados:</h5>
                    <ul id="produtosSelecionados"></ul>
                </div>

                <p id="selecionee" class="mensagem-erro">
                    <i class="fas fa-exclamation-circle"></i> Selecione ao menos um item para continuar
                </p>

                <div class="total-section">
                    <p id="valorTotal" class="valor-total">Valor total: R$ 0,00</p>
                </div>

                <button id="comprarButton" class="btn-comprar">
                    <i class="fas fa-credit-card"></i> Continuar para Pagamento
                </button>
            </div>
        </div>

        <!-- Pop-up Pagamento -->
        <div id="popupFormasPagamento" class="popup">
            <div class="popup-header">
                <h2><i class="fas fa-credit-card"></i> Formas de Pagamento</h2>
                <button id="fechamento" class="btn-fechar">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="popup-body">
                <p>Selecione a forma de pagamento desejada:</p>

                <div class="formas-pagamento">
                    <div class="forma-item">
                        <input type="radio" id="cartaoCredito" name="formaPagamento" value="cartaoCredito">
                        <label for="cartaoCredito">
                            <i class="fas fa-credit-card"></i> Cartão de Crédito
                        </label>
                    </div>
                    <div class="forma-item">
                        <input type="radio" id="pix" name="formaPagamento" value="pix">
                        <label for="pix">
                            <i class="fas fa-qrcode"></i> PIX
                        </label>
                    </div>
                </div>

                <!-- Formulário Cartão -->
                <div id="cartaoCreditoForm" class="form-cartao">
                    <div class="form-group">
                        <label for="numeroCartao">Número do Cartão</label>
                        <input type="text" id="numeroCartao" name="numeroCartao"
                            placeholder="0000 0000 0000 0000" maxlength="19" required>
                    </div>
                    <div class="form-group">
                        <label for="nomeTitular">Nome do Titular</label>
                        <input type="text" id="nomeTitular" name="nomeTitular"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="dataValidade">Validade</label>
                            <input type="text" id="dataValidade" name="dataValidade"
                                placeholder="MM/AAAA" maxlength="7" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="000"
                                maxlength="3" oninput="this.value = this.value.replace(/\D/g, '')" required>
                        </div>
                    </div>
                </div>

                <!-- PIX -->
                <div id="chavePix" class="pix-info">
                    <div class="pix-header">
                        <i class="fas fa-qrcode"></i>
                        <h4>Chave PIX</h4>
                    </div>
                    <div class="pix-chave">
                        <p>+55 21 98071-1278</p>
                        <button class="btn-copiar">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="pix-observacao">Pagamento identificado automaticamente</p>
                </div>

                <div class="mensagens">
                    <div id="mensagemConfirmacaoPix" class="mensagem mensagem-info">
                        <i class="fas fa-clock"></i> Aguardando confirmação de pagamento
                    </div>
                    <div id="mensagemConfirmacao" class="mensagem mensagem-sucesso">
                        <i class="fas fa-check-circle"></i> Pagamento confirmado com sucesso
                    </div>
                    <div id="mensagemErro" class="mensagem mensagem-erro">
                        <i class="fas fa-exclamation-circle"></i> Preencha todos os dados
                    </div>
                </div>

                <div class="popup-actions">
                    <button id="voltarPopup" class="btn-voltar">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </button>
                    <button id="confirmarPagamentoButton" class="btn-confirmar">
                        <i class="fas fa-check"></i> Confirmar Pagamento
                    </button>
                </div>
            </div>
        </div>



        <!-- Menu Mobile -->
        <div class="nav-mobile" id="navMobile">
            <div class="mobile-header">
                <span class="logo-text">CPaaS</span>
                <button class="mobile-close" id="mobileClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <ul class="mobile-menu">
                <li class="mobile-item">
                    <a href="#cpaas-section" class="mobile-link smooth-scroll">
                        <i class="fas fa-info-circle"></i> CPaaS: O que é?
                    </a>
                </li>
                <li class="mobile-item">
                    <a href="#solucoes-1" class="mobile-link smooth-scroll">
                        <i class="fas fa-cube"></i> Soluções
                    </a>
                </li>
                <li class="mobile-item">
                    <a href="#vantagens-1" class="mobile-link smooth-scroll">
                        <i class="fas fa-star"></i> Vantagens
                    </a>
                </li>
                <li class="mobile-item">
                    <a href="#aplicativos-1" class="mobile-link smooth-scroll">
                        <i class="fas fa-mobile-alt"></i> Aplicativos
                    </a>
                </li>
                <li class="mobile-item mobile-user">
                    <a href="../Perfil/perfil.php" class="mobile-link">
                        <i class="fas fa-user"></i> Meu Perfil
                    </a>
                </li>
                <?php if ($is_master): ?>
                    <li class="mobile-item mobile-user">
                        <a href="#" class="mobile-link" onclick="abrirTelaMaster()">
                            <i class="fas fa-crown"></i> Área Master
                        </a>
                    </li>
                <?php endif; ?>
                <li class="mobile-item mobile-user">
                    <a href="../Login/logout.php" class="mobile-link">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                </li>
            </ul>
        </div>
    </header>
    <!--Fim do Navbar-->


    <!-- Espaço entre o navbar e o conteúdo -->
    <div class="spacer"></div>

    <!-- Seção Hero -->
    <section id="home" class="hero">
        <div class="hero-content">
            <img src="img/image11.png" alt="CPaaS Platform" class="hero-image">
            <div class="hero-text">
                <h1>CPaaS Platform</h1>
                <p class="hero-description">
                    O CPaaS, com sua escalabilidade, flexibilidade, autenticação e segurança aprimoradas,
                    está revolucionando o modo como as empresas habilitadas em nuvem implementam
                    comunicações de voz, SMS e vídeo.
                </p>
                <a href="#cpaas-section" class="btn-hero smooth-scroll">
                    <i class="fas fa-rocket"></i> Nos conheça
                </a>
            </div>
        </div>
    </section>

    <!--Início do Título CPaaS: O que é?-->
    <div id="cpaas-section" class="titulo1">
        <h2 class="titulo">CPaaS: O que é?</h2>
    </div>
    <!--Fim do Título CPaaS: O que é?-->

    <!--Início da linha de separação personalizada-->
    <div class="border1"></div>
    <!--Fim da linha de separação personalizada-->

    <!--Início do conteúdo da CPaaS-->
    <div class="conteudo1">
        <div class="texto">
            <div class="titulo3">
                Communications Platform as a Service<br>
                Plataforma de Comunicação como Serviço
            </div>
            <div class="paragrafo">
                <p>É uma solução de software de comunicação que
                    atua como uma base sobre a qual desenvolvedores
                    podem integrar uma variedade de aplicativos.
                </p>

                <p>Métodos de comunicação típicos, como voz, chamadas
                    de vídeo ou mensagens de texto SMS, podem ser
                    incorporados em outros sistemas por meio de APIs que
                    se conectam à plataforma CPaaS.
                </p>

                <p>Essas APIs permitem que as empresas expandam suas
                    ofertas sem a necessidade de hardware ou software
                    adicional.
                </p>

                <p><strong><br><br>CPaaS e a Transformação Digital</strong></p>

                <p>•Expectativa de crescimento estimado de <strong>$ 8,2 bilhões</strong> em 2021;</p>
                <p>•<strong>85%</strong> dos profissionais se conectam de maneira diferente com colegas e clientes do
                    que faziam há apenas 5 anos;</p>
                <p>•As receitas de CPaaS estão crescendo mais de <strong>40%</strong> ao ano;</p>
                <p>•<strong>CPaaS</strong> já ultrapassou o mercado de <strong>UCaaS</strong> (Unified Communication as
                    a Service);</p>
                <p>• Marcas que estão em <strong>múltiplos canais</strong> melhoram a experiência do usuário e aumentam
                    seus resultados.</p>

            </div>
        </div>


        <!--Aplicação de imagem-->
        <div class="img2">
            <img src="img/desenho2-removebg-preview.png" alt="">
        </div>
        <!--Aplicação de imagem-->

    </div>
    <!--Fim do conteúdo da CPaaS-->

    <!--Início do Título Soluções-->
    <div id="solucoes-1" class="titulo-solucoes">Soluções</div>
    <!--Fim do Título Soluções-->

    <!--Início da linha de separação personalizada-->
    <div class="border2"></div>
    <!--Fim da linha de separação personalizada-->

    <!--Início do conteúdo de Soluções/Serviços-->
    <div class="solucoes">
        <div class="grid-container">
            <div class="grid-item">
                <a href="#con2" class="smooth-scroll"><img src="img/2fa-removebg-preview.png" alt="Imagem 1"
                        class="img-reduzida"></a>
                <p>2Fa</p>
            </div>
            <div class="grid-item">
                <a href="#mascnum" class="smooth-scroll"><img src="img/numascara-removebg-preview.png" alt="Imagem 2"
                        class="img-reduzida"></a>
                <p>Número Máscara</p>
            </div>
            <div class="grid-item">
                <a href="#googleee" class="smooth-scroll"><img src="img/google_verify-removebg-preview.png"
                        alt="Imagem 3" class="img-reduzida"></a>
                <p>Google Verified Calls</p>
            </div>
            <div class="grid-item">
                <a href="#title-sms" class="smooth-scroll"><img src="img/sms-removebg-preview.png" alt="Imagem 4"
                        class="img-reduzida"></a>
                <p>SMS Programável</p>
            </div>
        </div>
    </div>
    <!--Fim do conteúdo de Soluções/Serviços-->


    <div class="aqui"></div>
    <!--Início do conteúdo do 2FA-->
    <div id="2fatitle" class="titulo-2fa">2FA</div>

    <!--Início da linha de separação personalizada-->
    <div class="border3"></div>
    <!--Fim da linha de separação personalizada-->

    <div id="con2" class="conteudo2">
        <div class="txt">
            <div class="t1"></div>
            <div class="t2">Two-Factor Authentication <br> Autenticação de dois fatores</div>

            <div class="paragrafo2">
                <div class="texto-imagem">
                    <p>O 2FA é um procedimento de segurança que garante que serão necessários
                        2 fatores únicos para liberação de uma ação. O primeiro fator é a senha
                        que o usuário e o segundo pode ser autenticado via token, via detecção
                        de impressão digital, reconhecimento facial, código enviado via sms,
                        entre outros.</p>
                    <div class="img3">
                        <img src="img/img2fa-2-removebg-preview.png" alt="Descrição da Imagem">
                    </div>
                </div>

                <p class="possibilita">
                    <strong>O 2FA possibilita que você:</strong>
                </p>

                <ul class="poss">
                    <li><strong>Envie</strong> uma senha através de SMS, voz ou e-mail para autenticar o usuário;</li>
                    <li><strong>Adicione</strong> uma camada extra de segurança além da senha pessoal;</li>
                    <li><strong>Proporcione</strong> maior segurança aos usuários.</li>

                </ul>

                <br>

                <p class="fortalece">
                    <strong>Fortaleça a estratégia de segurança de seu negócio</strong>
                </p>

                <ul class="fort">
                    <li><strong>100%</strong> dos bots automatizados;</li>
                    <li><strong>99%</strong> dos ataques de phishing em massa;</li>
                    <li><strong>66%</strong> dos ataques direcionados.</li>

                </ul>

            </div>
        </div>
    </div>
    <!--Fim do conteúdo do 2FA-->



    <!--Início do conteúdo do 2FA (como funciona na prática?)-->
    <div class="titulo-pratica"><strong>Como funciona na prática?</strong></div>

    <section class="como">
        <div class="serviços2">

            <div class="card2">
                <img src="img/photo_3_2023-06-08_19-01-45-removebg-preview.png" alt="">
                <div class="card-text">
                    <p style="margin-top: 45px;">Usuário acessa seu site, o
                        aplicativo e digita a senha
                        cadastrada para entrar em
                        seu perfil ou completar uma
                        transação.</p>
                </div>
            </div>

            <div class="card2">
                <img src="img/photo_4_2023-06-08_19-01-45-removebg-preview.png" alt="">
                <div class="card-text">
                    <p style="margin-top: 40px;">A Telecall recebe a tentativa
                        de login e solicita que o
                        usuário insira seu número de
                        telefone para autorizar o
                        acesso.</p>
                </div>
            </div>

            <div class="card2">
                <img src="img/photo_1_2023-06-08_19-01-45-removebg-preview.png" alt="">
                <div class="card-text">
                    <p style="margin-top: 22px;">Após inserir seu número, a
                        Telecall envia para o usuário
                        por SMS, chamada ou e-mail
                        um código PIN de uso único.</p>
                </div>
                <br>
                <img class="seta" src="img/png-transparent-blue-arrow-arrow-cartoon-blue-removebg-preview.png" alt=""
                    style="width: 70px; margin-top: 0px; margin-left: auto; margin-right: auto;">
                <p class="seta1">Esse código PIN é também
                    conhecido como OTP (One
                    Time Password).</p>
            </div>

            <div class="card2">
                <img src="img/photo_2_2023-06-08_19-01-45-removebg-preview.png" alt="">
                <div class="card-text">
                    <p style="margin-top: 55px;">O usuário insere o código no
                        site ou aplicativo para
                        concluir o processo de
                        verificação.</p>
                </div>
            </div>
        </div>

    </section>
    <!--Fim do conteúdo do 2FA (como funciona na prática?)-->

    <!--Início do conteúdo do 2FA (Benefícios)-->
    <div class="beneficios">
        <h3>Benefícios</h3>
        <ul>
            <li>Ofereça <strong>segurança aprimorada </strong>para seus clientes.</li>
            <li>Reduza casos de <strong>fraude e invasões</strong>e evite o acesso a dados por invasores.</li>
            <li>Envio de OTP por meio de <strong>vários canais</strong>, incluindo SMS, voz ou e-mail.</li>
            <li><strong>Flexibilidade </strong>de canais garante que o usuário conseguirá completar a tarefa
                desejada mesmo quando tiver problema com um deles. Exemplo: Enviar OTP por SMS, em caso de falha,
                enviar OTP por chamada de voz, em caso de outra falha, enviar por e-mail.</li>
            <li>API simples e de <strong>rápida implementação.</strong> </li>
            <li><strong>Plataforma intuitiva </strong>que permite visualizar relatórios de uso por dia, mês ou ano e
                pesquisar
                usando diversos critérios de filtro.</li>
        </ul>
    </div>
    <!--Fim do conteúdo do 2FA (Benefícios)-->

    <!--Início do conteúdo do 2FA (Quem utiliza o 2FA?) (texto)-->
    <div class="utiliza">
        <h3>Quem utiliza o 2Fa?</h3>
    </div>

    <section class="como1">
        <div class="serviços3">
            <div class="card3">
                <img src="img/financaas.png" alt="">
                <div class="card-text">
                    <div class="card-text">
                        <br>
                        <h3>Finanças</h3>
                        <br>
                        <p>• Acesso ao portal/app</p>
                        <br>
                        <p>• Autenticação para
                            transações bancárias</p>
                        <br>
                        <p>• Pagamentos Online
                            (PicPay, PayPal)</p>
                        <br>
                        <p>• Digital Wallets (Google
                            Pay, Apple Pay,
                            Samsung Pay)</p>
                        <br>
                    </div>
                </div>
            </div>

            <div class="card3">
                <img src="img/sauude.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Saúde</h3>
                    <br>
                    <p>• Acesso aoportal/app</p>
                    <br>
                    <p>• Agenda</p>
                    <br>
                    <p>• Tokens de autorização</p>
                    <br>
                    <p>• Telemedicina</p>
                </div>
            </div>

            <div class="card3">
                <img src="img/turiismo.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Turismo</h3>
                    <br>
                    <p>• Acesso ao
                        portal/app</p>
                    <br>
                    <p>• Gestão de Reservas</p>
                    <br>
                    <p>• Acesso ao histórico</p>
                    <br>
                    <p>• Salvar dados de pagamentos</p>
                    <br>
                    <p>• Recuperação de Senha</p>
                </div>
            </div>

            <div class="card3">
                <img src="img/vaarejo.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Varejo</h3>
                    <br>
                    <p>• Acesso ao
                        portal/app</p>
                    <br>
                    <p>• Salvar dados de
                        pagamentos</p>
                    <br>
                    <p>• Acesso ao histórico</p>
                    <br>
                    <p>• Recuperação de Senha</p>
                    <br>
                    <p>• Recibo Eletrônico</p>
                </div>
            </div>

            <div class="card3">
                <img src="img/gooverno.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Governo</h3>
                    <br>
                    <p>• Acesso ao portal/app</p>
                    <br>
                    <p>• Gestão de
                        informações</p>
                    <br>
                    <p>• Recuperação de Senha</p>
                </div>
            </div>
        </div>

    </section>
    <!--Fim do conteúdo do 2FA (Quem utiliza o 2FA?) (texto)-->


    <!--Início do conteúdo do 2FA (Quem utiliza o 2FA?) (ícones)-->
    <div class="utiliza">
        <h3>Quem utiliza o 2Fa?</h3>
    </div>
    <section class="como1">
        <div class="serviços3">
            <div class="card3">
                <img src="img/financaas.png" alt="">
                <div class="card-text">
                    <div class="card-text">
                        <br>
                        <h3>Finanças</h3>
                        <br>
                        <img src="img/bancos.png">
                    </div>
                </div>
            </div>

            <div class="card3">
                <img src="img/sauude.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Saúde</h3>
                    <br>
                    <img src="img/amil.png">
                </div>
            </div>

            <div class="card3">
                <img src="img/turiismo.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Turismo</h3>
                    <br>
                    <img src="img/turismoss.png">
                </div>
            </div>

            <div class="card3">
                <img src="img/vaarejo.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Varejo</h3>
                    <br>
                    <img src="img/varejosss.png">
                </div>
            </div>

            <div class="card3">
                <img src="img/gooverno.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Governo</h3>
                    <br>
                    <img src="img/goovernoapps.png">
                </div>
            </div>
        </div>
    </section>
    <!--Fim do conteúdo do 2FA (Quem utiliza o 2FA?) (ícones)-->

    <!--Início do conteúdo do Número Máscara-->
    <div id="mascnum" class="nummasc">
        <h2>Número Máscara</h2>
    </div>

    <!--Início da linha de separação personalizada-->
    <div class="border4"></div>
    <!--Fim da linha de separação personalizada-->

    <div class="nummasc2">
        <div class="texto-masc">
            <div class="titulo-mas1">Number Masking<br>Número Máscara</div>
            <div class="oque">
                <p>O Número Máscara, também conhecido como Number Masking em inglês, é uma tecnologia avançada
                    de comunicação que permite mascarar (ocultar) números de telefones ao realizar chamadas, ou
                    enviar mensagens. Dessa forma, os números de telefones reais dos usuários são substituídos
                    por números virtuais, o que proporciona privacidade e segurança.
                </p>

                <img src="img/celular-nummasc-removebg-preview.png" alt="">

            </div>
        </div>
    </div>

    <div class="mascara">
        <ul class="possi">
            <li><strong>Envie</strong> uma senha através de SMS, voz ou e-mail para autenticar o usuário;</li>
            <li><strong>Adicione</strong> uma camada extra de segurança além da senha pessoal;</li>
            <li><strong>Proporcione</strong> maior segurança aos usuários.</li>

        </ul>
        <br>
        <p class="fortalecendo">
            <strong>Fortaleça a estratégia de segurança de seu negócio</strong>
        </p>
        <ul class="forte">
            <li><strong>100%</strong> dos bots automatizados;</li>
            <li><strong>99%</strong> dos ataques de phishing em massa;</li>
            <li><strong>66%</strong> dos ataques direcionados;</li>
            <br><br>
            <li><strong>SMS –</strong> Número máscara é totalmente funcional para chamadas de voz e SMS;</li>
            <li><strong>Geo Match –</strong> Combine o código do país do número mascarado com o da chamada de origem
                passando pro cliente a impressão de que vocês estão na mesma região;</li>
            <li><strong>Gestão de Sessões –</strong> Habilite números máscara permanentes, bloqueie chamadas
                indesejadas,validade de sessão e etc;</li>
            <li><strong>Relatórios –</strong> Acesso direto do cliente à relatórios detalhados;</li>
            <li><strong>Números Simultâneos -</strong> Use o mesmo número máscara em várias ligações simultâneas;</li>
            <li><strong>Triagem de Conteúdo –</strong> Recurso SMS onde você pode sinalizar conteúdos sensíveis para
                proteger dados do cliente;</li>
            <li><strong>Escalabilidade Ilimitada –</strong> e adicione números conforme necessário.</li>
        </ul>
    </div>
    <!--Fim do conteúdo do Número Máscara-->

    <!--Início do conteúdo do Número Máscara (Como funciona?)-->
    <div class="funcionamento">
        <h3>Como funciona ?</h3>
        <div class="imagens-container">
            <img src="img/comofuncionapt1-removebg-preview.png">
            <img src="img/comofuncionapt2-removebg-preview.png">
            <img src="img/comofuncionapt3-removebg-preview.png">
        </div>
    </div>
    <!--Fim do conteúdo do Número Máscara (Como funciona?)-->

    <!--Início do conteúdo do Número Máscara (Quem utiliza?)-->
    <div class="utilizamento">
        <h3>Quem utiliza ?</h3>
        <div class="imagens-utilizamento">
            <img src="img/quemutilizapt1-removebg-preview.png">
            <img src="img/quemutilizapt2-removebg-preview.png">
            <img src="img/quemutilizapt3-removebg-preview.png">
            <img src="img/quemutilizapt4-removebg-preview.png">
        </div>
    </div>
    <!--Fim do conteúdo do Número Máscara (Quem utiliza?)-->

    <!--Início do conteúdo do Número Máscara (Quem utiliza? - ícones)-->
    <div class="quemusaicone">
        <h3>Quem utiliza ?</h3>
        <div class="imagens-utilizamento">
            <img src="img/quemusaiconespt1-removebg-preview.png">
            <img src="img/quemusaiconespt2-removebg-preview.png">
            <img src="img/quemusaiconespt3-removebg-preview.png">
            <img src="img/quemusaiconespt4-removebg-preview.png">
        </div>
    </div>
    <!--Fim do conteúdo do Número Máscara (Quem utiliza? - ícones)-->

    <!--Início do conteúdo do Número Máscara (Quem mais utiliza?)-->
    <div class="quemmais">
        <h3>Quem mais utiliza?</h3>
        <p>43% das empresas brasileiras adotou o Home Office como padrão.
            Mesmo após o fim da pandemia, estatísticas indicam que o modelo de trabalho Home Office deve crescer
            cerca de 30%.<br> <br>
            Funcionários que não possuem celular empresarial ou ramal virtual podem se beneficiar do uso de
            um número máscara permanente do trabalho vinculado ao seu telefone celular, assim protegendo
            seus número pessoais.</p>
    </div>
    <!--Fim do conteúdo do Número Máscara (Quem mais utiliza?)-->


    <!--Início do conteúdo do Google Verified Calls-->
    <div id="googleee" class="google-title">
        <h2>Google Verified Calls</h2>
    </div>

    <!--Início da linha de separação personalizada-->
    <div class="border5"></div>
    <!--Fim da linha de separação personalizada-->

    <!--Início do conteúdo do Google Verified Calls-->
    <div class="google">
        <div class="texto-google">
            <div class="titulo-google2">Google Verified Calls<br>Verificado pelo Google Chamadas</div>
            <div class="oqueg">
                <p>São chamadas verificadas, é um novo recurso do Google, exclusivo para telefones Android, permite que
                    empresas exibam para o cliente na hora
                    da chamada sua marca, logotipo e até mesmo o motivo da chamada.
                    A Telecall é a primeira operadora de telecom no Brasil a oferecer esse recurso do Google.<br><br>

                    <strong>O problema</strong> <br>
                    Ligações de spam<br><br>
                    O Brasil é o país que mais sofre com ligações de spam no mundo. Desde 2017, as chamadas
                    telefônicas de spam no Brasil aumentaram 141%. O brasileiro recebe em média 49,9 ligações de spam
                    por mês.
                </p>
                <br> <br>
                <img src="img/google-ve.png" alt="">
            </div>
        </div>
    </div>

    <div class="spam-chamada">
        <img src="img/spam.png">
    </div>
    <!--Fim do conteúdo do Google Verified Calls-->

    <!--Início do conteúdo do Google Verified Calls (Compatibilidade e Benefícios)-->
    <div class="compat">
        <p>
            <strong>Compatibilidade<br> <br></strong>Exclusivo para sistema operacional Android através do aplicativo
            Telefone.
            Pré-instalado em telefones mais recentes ou pode ser baixado do Google Play Store para a maioria dos
            dispositivos com Android 9.0.
            Hoje no Brasil existem quase 239 milhões de celulares smartphone ativos, sendo que o sistema Android detém
            uma participação de mais
            de 86% do mercado de sistema operacional móvel no país.<br><br><br>

            <strong>Benefícios<br><br></strong>

            • Estabeleça Confiança - Clientes são mais propensos a atender chamadas de organizações com as quais estão
            familiarizadas e com as quais
            já têm relação;<br>
            • Agilize a Conexão - Quando o motivo da chamada é claro, a chance de o cliente atender é muito maior e a
            conexão com ele mais rápida
            e eficiente;<br>
            • Melhore a Experiência do Cliente -O nome da marca, logotipo e a visualização do motivo da chamada oferecem
            uma experiência melhor e
            muito mais amigável para o cliente.
        </p>
        <img src="img/telefone.png">
    </div>
    <!--Fim do conteúdo do Google Verified Calls (Compatibilidade e Benefícios)-->

    <!--Início do conteúdo do Google Verified Calls (Como Funciona?)-->
    <div class="funciona-titulo">
        <h3>Como funciona?</h3>
    </div>

    <div class="funciona-como">
        <div class="imagens">
            <img src="img/funciona-como-1-removebg-preview.png">
            <img src="img/funciona-como-2-removebg-preview.png">
            <img src="img/funciona-como-3-removebg-preview.png">
        </div>
    </div>
    <!--Fim do conteúdo do Google Verified Calls (Como Funciona?)-->

    <!--Início do conteúdo do Google Verified Calls (Usos)-->
    <div class="usos-titulo">
        <h3>Usos</h3>
    </div>

    <div class="usos11">
        <p>
            • Aviso de problemas de fraude de cartão de crédito;<br>
            • Aviso de atrasos e cancelamentos de voos;<br>
            • Agendamentos de serviços, entregas, reparos e instalações;<br>
            • Avisos sobre agendamentos, exames e resultados;<br>
            • Oferecer uma melhor experiência de vendas e promoções.
        </p>

        <img src="img/usos.png">

    </div>
    <!--Início do conteúdo do Google Verified Calls (Usos)-->


    <!--Início do conteúdo do SMS Programável-->
    <div id="title-sms" class="sms-title">
        <h2>SMS Programável</h2>
    </div>

    <!--Início da linha de separação personalizada-->
    <div class="border6"></div>
    <!--Fim da linha de separação personalizada-->

    <!--Início do conteúdo do SMS Programável-->
    <div class="sms-programavel">
        <div class="texto-sms">
            <div class="titulo-sms2">Programmable SMS<br>SMS Programável</div>
            <div class="oque-sms">
                <p>
                    <strong>Conecte-se com seus clientes.</strong> <br>
                    <br>
                    É muito provável que você já tenha recebido uma mensagem de texto de uma empresa ou organização.
                    Com uma API, qualquer empresa pode enviar mensagens de texto e impactar clientes, prospects ou
                    fornecedores
                    como parte de seu processo comercial. Com essa ferramenta você envia mensagens de SMS com as
                    informações que o
                    seu cliente precisa e com a segurança, a velocidade e a confiabilidade que você espera.
                </p>
                <br> <br>
                <img src="img/iphonex.png" alt="">

            </div>
        </div>
    </div>
    <!--Fim do conteúdo do SMS Programável-->


    <!--Início do conteúdo do SMS Programável (forma mais rápida)-->
    <div class="forma-rapida-titulo">
        <h3>SMS é a forma mais rápida, eficiente e de baixo custo para se comunicar com seus clientes</h3>
    </div>

    <div class="forma-rapida">
        <div class="imgss">
            <img src="img/porcentagem-1-removebg-preview.png">
            <img src="img/porcentagem-2-removebg-preview.png">
            <img src="img/porcentagem-3-removebg-preview.png">
            <img src="img/porcentagem-4-removebg-preview.png">
        </div>
    </div>
    <!--Fim do conteúdo do SMS Programável (forma mais rápida)-->

    <!--Início do conteúdo do SMS Programável (Quem utiliza ?)-->
    <div class="uso-titlee">
        <h3>Quem utiliza ?</h3>
    </div>

    <div class="uso-tel">
        <div class="imagenzz">
            <img src="img/varios-telefones-1-removebg-preview.png">
            <img src="img/varios-telefones-2-removebg-preview.png">
            <img src="img/varios-telefones-3-removebg-preview.png">
            <img src="img/varios-telefones-4-removebg-preview.png">
            <img src="img/varios-telefones-5-removebg-preview.png">
        </div>
    </div>
    <!--Fim do conteúdo do SMS Programável (Quem utiliza ?)-->

    <!--Início do conteúdo do SMS Programável (Jornada do Cliente)-->
    <div class="jornada">
        <h3>Jornada do Cliente</h3>
        <p>Ofereça uma melhor experiência ao cliente acompanhando a sua jornada de compra.</p>
    </div>

    <div class="jornada-moto">
        <div class="img-moto">
            <img src="img/motinha.png">
        </div>
    </div>
    <!--Fim do conteúdo do SMS Programável (Jornada do Cliente)-->

    <!--Início do conteúdo do SMS Programável (Usos)-->
    <div class="usos22-titulo">
        <h3>Usos</h3>
    </div>

    <!--Início da linha de separação personalizada-->
    <div class="border7"></div>
    <!--Fim da linha de separação personalizada-->

    <div class="usos22">
        <p>
            • Aviso de problemas de fraude de cartão de crédito;<br>
            • Aviso de atrasos e cancelamentos de voos;<br>
            • Agendamentos de serviços, entregas, reparos e instalações;<br>
            • Avisos sobre agendamentos, exames e resultados;<br>
            • Oferecer uma melhor experiência de vendas e promoções.
        </p>
    </div>
    <!--Fim do conteúdo do SMS Programável (Usos)-->

    <!--Início do conteúdo do SMS Programável (Usos-cards)-->
    <section class="como1">
        <div class="serviços3">
            <div class="card3">
                <img src="img/logistica-1.png" alt="">
                <div class="card-text">
                    <div class="card-text">
                        <br>
                        <h3>Logística</h3>
                        <br>
                        <p>• Acesso seguro com 2FA;</p>
                        <br>
                        <p>• Uso de números mascarados
                            para proteção de funcionário
                            e cliente;</p>
                        <br>
                        <p>• Mantenha o cliente
                            informado sobre entrega e
                            serviços;</p>
                        <br>
                        <p>• Verified calling para
                            confirmação de entregas;</p>
                        <br>
                    </div>
                </div>
            </div>

            <div class="card3">
                <img src="img/varejo-1.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Varejo</h3>
                    <br>
                    <p>• Compra segura 2FA;</p>
                    <br>
                    <p>• Avisos sobre compras e
                        e entregas;</p>
                    <br>
                    <p>• Upsell com novas ofertas e
                        vantagens via SMS ou
                        Verified Calling.</p>
                    <br>
                    <p></p>
                </div>
            </div>

            <div class="card3">
                <img src="img/call-center1.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Call Center</h3>
                    <br>
                    <p>• Melhores taxas de abertura
                        utilizando alertas SMS para
                        confirmações;</p>
                    <br>
                    <p>• Economia de números com o
                        uso de um único número
                        máscara por todos os agentes;</p>
                    <br>
                    <p>• Verified calling para
                        confirmação de
                        agendamentos.</p>
                    <br>
                    <p></p>
                    <br>
                    <p></p>
                </div>
            </div>

            <div class="card3">
                <img src="img/saude1.png" alt="">
                <div class="card-text">
                    <br>
                    <h3>Saúde</h3>
                    <br>
                    <p>• Acesso seguro com 2FA;</p>
                    <br>
                    <p>• Melhore o agendamento e
                        reduza faltas com lembretes por
                        SMS;</p>
                    <br>
                    <p>• Tokens de autorização para
                        procedimentos com 2FA;</p>
                    <br>
                    <p>• Verified Calling para avisos de
                        resultados e agendamentos.</p>
                    <br>
                    <p></p>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--Fim do conteúdo do SMS Programável (Usos-cards)-->

    <!--Início do conteúdo do SMS Programável (Exemplos)-->
    <div class="example-titulo">
        <h3>Exemplos: </h3>
    </div>

    <div class="example">
        <div class="exampleimagens">
            <img src="img/desenho4-removebg-preview.png">
            <img src="img/desenho5-removebg-preview.png">
            <img src="img/desenho6-removebg-preview.png">
            <img src="img/desenho7-removebg-preview.png">
        </div>
    </div>
    <!--Fim do conteúdo do SMS Programável (Exemplos)-->

    <!--Início do conteúdo Vantagens Telecall (cards)-->
    <div id="vantagens-1" class="example-titulo">
        <h3>Vantagens Telecall </h3>
    </div>
    <section class="como1">
        <div class="serviços3">
            <div class="card3">
                <div class="card-text">
                    <div class="card-text">
                        <h3>Confiança</h3>
                        <br>
                        <p>Empresa que já conhecem e confiam.</p>
                        <br>
                    </div>
                </div>
            </div>

            <div class="card3">
                <div class="card-text">
                    <h3>Agibilidade</h3>
                    <br>
                    <p>Aplicativos de rápida implementação.</p>
                    <br>
                </div>
            </div>

            <div class="card3">
                <div class="card-text">
                    <h3>Garantia de Rede</h3>
                    <br>
                    <p>Rede própria de alta capacidade e controle.</p>
                    <br>
                </div>
            </div>

            <div class="card3">
                <div class="card-text">
                    <h3> Suporte ao Cliente</h3>
                    <br>
                    <p>Representantes locais de vendas e suporte.</p>
                    <br>
                </div>
            </div>

            <div class="card3">
                <div class="card-text">
                    <h3>Preço</h3>
                    <br>
                    <p>Melhor custo benefício para um conjunto completo de recursos e serviços</p>
                    <br>
                </div>
            </div>
        </div>
    </section>
    <!--Fim do conteúdo Vantagens Telecall (cards)-->

    <!--Início do conteúdo Aplicativos que utilizam-->
    <div id="aplicativos-1" class="example-titulo">
        <h3>Aplicativos que utilizam </h3>
    </div>

    <div class="example">
        <div class="exampleimagens">
            <img src="img/varios-apps-removebg-preview.png">
        </div>
    </div>
    <!--Fim do conteúdo Aplicativos que utilizam-->

    <!--Início do Rodapé-->
    <footer>
        <img src="img/telecall_logo-removebg-preview.png" alt="Logo da Telecall">
        <div class="contact-info">
            <p>CONTATO COMERCIAL<br>comercial@telecall.com<br>(21) 3030-1010</p>
        </div>

        <div class="copyright">
            <p>Copyright 2024 © - Telecall</p>
        </div>
    </footer>
    <!--Fim do Rodapé-->


    <!-- Modal Master -->
    <div id="modalMaster">
        <div class="modal-master-content">
            <h2 style="color: #333; margin-bottom: 20px;">
                <i class="fas fa-crown"></i> Área Master
            </h2>
            <div id="conteudoMaster">
                <!-- Conteúdo carregado via AJAX -->
            </div>
            <button onclick="fecharTelaMaster()" style="margin-top: 20px; padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Fechar
            </button>
        </div>
    </div>

    <!-- JavaScript -->
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="script.js"></script>

    <script>
        function abrirTelaMaster() {
            fetch('../Master/master_content.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('conteudoMaster').innerHTML = data;
                    document.getElementById('modalMaster').style.display = 'block';
                })
                .catch(error => {
                    document.getElementById('conteudoMaster').innerHTML = '<p>Erro ao carregar conteúdo master.</p>';
                    document.getElementById('modalMaster').style.display = 'block';
                });
        }

        function fecharTelaMaster() {
            document.getElementById('modalMaster').style.display = 'none';
        }

        // Fechar modal clicando fora
        document.getElementById('modalMaster').addEventListener('click', function(e) {
            if (e.target.id === 'modalMaster') {
                fecharTelaMaster();
            }
        });

        // Foco no usuário logado
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Usuário logado: <?php echo $_SESSION['nome_cliente']; ?>');
        });
    </script>
</body>

</html>