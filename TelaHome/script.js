// ===== NAVEGAÇÃO E SCROLL =====
document.addEventListener("DOMContentLoaded", function () {
    // Smooth Scroll para todos os links com a classe
    var smoothScrollLinks = document.querySelectorAll('.smooth-scroll');

    smoothScrollLinks.forEach(function(link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            var targetId = this.getAttribute('href');
            var targetElement = document.querySelector(targetId);

            if (targetElement) {
                var offsetTop = targetElement.offsetTop;
                var offset = 100;
                var targetOffset = offsetTop - offset;

                // Ajuste especial para #2fatitle
                if (targetId === '#2fatitle' && targetOffset < 0) {
                    targetOffset = 0;
                }

                window.scrollTo({
                    top: targetOffset,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Botão Voltar ao Topo
    var btnTopo = document.querySelector('.btn');
    if (btnTopo) {
        btnTopo.addEventListener('click', function (event) {
            event.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Botão "Nos conheça"
    var botaoConheca = document.querySelector('.botao');
    if (botaoConheca) {
        botaoConheca.addEventListener('click', function (event) {
            event.preventDefault();
            var targetId = this.getAttribute('href');
            var targetElement = document.querySelector(targetId);

            if (targetElement) {
                var offset = 100;
                var offsetTop = targetElement.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    }
});

// ===== SISTEMA DE COMPRAS/POPUPS =====
document.addEventListener("DOMContentLoaded", function () {
    // Elementos principais
    const contrateLink = document.getElementById('contrateLink');
    const popupCarrinho = document.getElementById('popup');
    const popupPagamento = document.getElementById('popupFormasPagamento');
    const overlay = document.getElementById('overlay');
    const fecharPopup = document.getElementById('fecharPopup');
    const fechamento = document.getElementById('fechamento');
    const voltarPopup = document.getElementById('voltarPopup');
    const comprarButton = document.getElementById('comprarButton');
    const confirmarPagamentoButton = document.getElementById('confirmarPagamentoButton');

    // Controle de visibilidade do botão "Contrate-nos"
    if (contrateLink) {
        const solucoesTitle = document.getElementById('solucoes-1');
        contrateLink.style.opacity = '0';
        contrateLink.style.transition = 'opacity 0.3s ease';

        if (solucoesTitle) {
            const solucoesPosition = solucoesTitle.offsetTop - 100;

            window.addEventListener('scroll', function () {
                if (window.scrollY > solucoesPosition) {
                    contrateLink.style.opacity = '1';
                } else {
                    contrateLink.style.opacity = '0';
                }
            });
        }

        // Abrir carrinho
        contrateLink.addEventListener('click', function (event) {
            event.preventDefault();
            abrirCarrinho();
        });
    }

    // Funções de controle dos popups
    function abrirCarrinho() {
        if (popupCarrinho && overlay) {
            popupCarrinho.style.display = 'block';
            overlay.style.display = 'block';
        }
    }

    function abrirPagamento() {
        if (popupPagamento && popupCarrinho && overlay) {
            popupCarrinho.style.display = 'none';
            popupPagamento.style.display = 'block';
            overlay.style.display = 'block';
        }
    }

    function fecharTodosPopups() {
        if (popupCarrinho) popupCarrinho.style.display = 'none';
        if (popupPagamento) popupPagamento.style.display = 'none';
        if (overlay) overlay.style.display = 'none';
    }

    // Event Listeners para controles dos popups
    if (comprarButton) {
        comprarButton.addEventListener('click', abrirPagamento);
    }

    if (fecharPopup) {
        fecharPopup.addEventListener('click', fecharTodosPopups);
    }

    if (fechamento) {
        fechamento.addEventListener('click', fecharTodosPopups);
    }

    if (voltarPopup) {
        voltarPopup.addEventListener('click', function() {
            abrirCarrinho();
        });
    }

    if (overlay) {
        overlay.addEventListener('click', fecharTodosPopups);
    }
});

// ===== CARRINHO DE COMPRAS =====
document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('#popup input[type="checkbox"]');
    const produtosSelecionados = document.getElementById('produtosSelecionados');
    const valorTotal = document.getElementById('valorTotal');
    const comprarButton = document.getElementById('comprarButton');
    const mensagemSelecionee = document.getElementById('selecionee');

    if (checkboxes.length > 0 && produtosSelecionados && valorTotal && comprarButton) {
        // Valores dos produtos
        const precos = {
            'item1': 179.90,
            'item2': 184.90,
            'item3': 189.90,
            'item4': 193.90
        };

        // Função para atualizar carrinho
        function atualizarCarrinho() {
            const produtosSelecionadosArray = [];
            let total = 0;

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    const label = checkbox.nextElementSibling.textContent.split(" (")[0];
                    produtosSelecionadosArray.push(label);
                    total += precos[checkbox.id] || 0;
                }
            });

            // Atualiza lista de produtos
            produtosSelecionados.innerHTML = '';
            produtosSelecionadosArray.forEach(function (item) {
                const li = document.createElement('li');
                li.textContent = item;
                produtosSelecionados.appendChild(li);
            });

            // Atualiza valor total
            valorTotal.textContent = 'Valor total: R$' + total.toFixed(2);

            // Controla visibilidade da mensagem e botão
            const algumSelecionado = produtosSelecionadosArray.length > 0;
            if (mensagemSelecionee) {
                mensagemSelecionee.style.display = algumSelecionado ? 'none' : 'block';
            }
            comprarButton.disabled = !algumSelecionado;
        }

        // Adiciona eventos aos checkboxes
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', atualizarCarrinho);
        });

        // Inicializa carrinho
        atualizarCarrinho();
    }
});

// ===== FORMULÁRIO DE PAGAMENTO =====
document.addEventListener("DOMContentLoaded", function () {
    const cartaoCreditoRadio = document.getElementById('cartaoCredito');
    const pixRadio = document.getElementById('pix');
    const cartaoCreditoForm = document.getElementById('cartaoCreditoForm');
    const chavePix = document.getElementById('chavePix');
    const confirmarPagamentoButton = document.getElementById('confirmarPagamentoButton');
    const mensagemErro = document.getElementById('mensagemErro');
    const mensagemConfirmacao = document.getElementById('mensagemConfirmacao');

    // Configura máscaras para campos do cartão
    if (typeof jQuery !== 'undefined' && jQuery.fn.inputmask) {
        $('#numeroCartao').inputmask('9999 9999 9999 9999');
        $('#dataValidade').inputmask('99/9999');
        $('#cvv').inputmask('999');
    } else {
        // Fallback sem jQuery
        const numeroCartao = document.getElementById('numeroCartao');
        const dataValidade = document.getElementById('dataValidade');
        const cvv = document.getElementById('cvv');

        if (numeroCartao) {
            numeroCartao.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
                this.value = value.substring(0, 19);
            });
        }

        if (dataValidade) {
            dataValidade.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 6);
                }
                this.value = value;
            });
        }

        if (cvv) {
            cvv.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '').substring(0, 3);
            });
        }
    }

    // Controle de exibição dos formulários de pagamento
    function atualizarFormularioPagamento() {
        if (cartaoCreditoRadio && cartaoCreditoRadio.checked) {
            if (cartaoCreditoForm) cartaoCreditoForm.style.display = 'block';
            if (chavePix) chavePix.style.display = 'none';
        } else if (pixRadio && pixRadio.checked) {
            if (cartaoCreditoForm) cartaoCreditoForm.style.display = 'none';
            if (chavePix) chavePix.style.display = 'block';
        }
    }

    // Event listeners para os radios
    if (cartaoCreditoRadio) {
        cartaoCreditoRadio.addEventListener('change', atualizarFormularioPagamento);
    }
    if (pixRadio) {
        pixRadio.addEventListener('change', atualizarFormularioPagamento);
    }

    // Validação do pagamento
    if (confirmarPagamentoButton) {
        confirmarPagamentoButton.addEventListener('click', function() {
            let valido = true;
            
            // Esconde mensagens anteriores
            if (mensagemErro) mensagemErro.style.display = 'none';
            if (mensagemConfirmacao) mensagemConfirmacao.style.display = 'none';

            if (cartaoCreditoRadio.checked) {
                // Validação do cartão
                const campos = ['numeroCartao', 'nomeTitular', 'dataValidade', 'cvv'];
                campos.forEach(function(campoId) {
                    const campo = document.getElementById(campoId);
                    if (campo && !campo.value.trim()) {
                        valido = false;
                    }
                });

                if (!valido) {
                    if (mensagemErro) {
                        mensagemErro.textContent = 'Preencha todos os dados do cartão';
                        mensagemErro.style.display = 'block';
                    }
                    return;
                }
            }

            // Exibe mensagem de confirmação
            if (mensagemConfirmacao) {
                if (pixRadio.checked) {
                    mensagemConfirmacao.textContent = 'Aguardando confirmação do PIX';
                    mensagemConfirmacao.style.color = 'blue';
                } else {
                    mensagemConfirmacao.textContent = 'Pagamento confirmado com sucesso ✓';
                    mensagemConfirmacao.style.color = 'green';
                }
                mensagemConfirmacao.style.display = 'block';
            }

            // Simula processamento
            setTimeout(function() {
                alert('Compra realizada com sucesso!');
                fecharTodosPopups();
            }, 2000);
        });
    }

    // Inicializa formulário
    atualizarFormularioPagamento();
});

// ===== MENU MOBILE =====
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('navToggle');
    const mobileClose = document.getElementById('mobileClose');
    const navMobile = document.getElementById('navMobile');
    
    if (navToggle && mobileClose && navMobile) {
        // Criar overlay
        const overlay = document.createElement('div');
        overlay.className = 'mobile-overlay';
        document.body.appendChild(overlay);
        
        // Abrir menu mobile
        navToggle.addEventListener('click', function() {
            navMobile.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        // Fechar menu mobile
        function closeMobileMenu() {
            navMobile.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        mobileClose.addEventListener('click', closeMobileMenu);
        overlay.addEventListener('click', closeMobileMenu);
        
        // Fechar menu ao clicar em um link
        const mobileLinks = document.querySelectorAll('.mobile-link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
    }
});

// ===== FUNÇÕES GLOBAIS =====
function fecharTodosPopups() {
    const popupCarrinho = document.getElementById('popup');
    const popupPagamento = document.getElementById('popupFormasPagamento');
    const overlay = document.getElementById('overlay');
    
    if (popupCarrinho) popupCarrinho.style.display = 'none';
    if (popupPagamento) popupPagamento.style.display = 'none';
    if (overlay) overlay.style.display = 'none';
}

// Função auxiliar para debug
function debugLog(mensagem) {
    if (console && console.log) {
        console.log('DEBUG: ' + mensagem);
    }
}