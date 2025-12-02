<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['usuario'] !== 'Admin1') {
    die('Acesso negado.');
}
?>

<div class="master-content">
    <h3 style="color: #333; margin-bottom: 30px;">
        <i class="fas fa-crown"></i> Painel de Administração Master
    </h3>

    <div class="master-functions" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="function-card" onclick="carregarFuncao('gerenciar_usuarios')" style="background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s; border: 2px solid #e9ecef;">
            <i class="fas fa-users fa-3x" style="color: #667eea; margin-bottom: 15px;"></i>
            <h4 style="color: #333; margin: 15px 0;">Gerenciar Usuários</h4>
            <p style="color: #666;">Visualize e gerencie todos os usuários do sistema</p>
        </div>

        <div class="function-card" onclick="carregarFuncao('estatisticas')" style="background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s; border: 2px solid #e9ecef;">
            <i class="fas fa-chart-bar fa-3x" style="color: #667eea; margin-bottom: 15px;"></i>
            <h4 style="color: #333; margin: 15px 0;">Estatísticas</h4>
            <p style="color: #666;">Relatórios e métricas do sistema</p>
        </div>

        <div class="function-card" onclick="carregarFuncao('configuracoes')" style="background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s; border: 2px solid #e9ecef;">
            <i class="fas fa-cogs fa-3x" style="color: #667eea; margin-bottom: 15px;"></i>
            <h4 style="color: #333; margin: 15px 0;">Configurações</h4>
            <p style="color: #666;">Configurações gerais do sistema</p>
        </div>
    </div>

    <div id="funcaoDetalhes" style="margin-top: 20px; padding: 20px; background: #f8f9fa; border-radius: 8px; display: none;">
        <!-- Detalhes das funções serão carregados aqui -->
    </div>
</div>

<script>
    function carregarFuncao(funcao) {
        const detalhes = document.getElementById('funcaoDetalhes');

        switch (funcao) {
            case 'gerenciar_usuarios':
                detalhes.innerHTML = `
                <h4 style="color: #333; margin-bottom: 15px;">
                    <i class="fas fa-users"></i> Gerenciar Usuários
                </h4>
                <p style="color: #666; margin-bottom: 15px;">Funcionalidade em desenvolvimento...</p>
                <button onclick="alert('Funcionalidade será implementada!')" 
                        style="padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Carregar Usuários
                </button>
            `;
                break;
            case 'estatisticas':
                detalhes.innerHTML = `
                <h4 style="color: #333; margin-bottom: 15px;">
                    <i class="fas fa-chart-bar"></i> Estatísticas do Sistema
                </h4>
                <p style="color: #666; margin-bottom: 15px;">Funcionalidade em desenvolvimento...</p>
                <div style="background: #e9ecef; padding: 15px; border-radius: 5px;">
                    <p style="margin: 5px 0;">Total de usuários: <strong>Em breve</strong></p>
                    <p style="margin: 5px 0;">Logins hoje: <strong>Em breve</strong></p>
                    <p style="margin: 5px 0;">Cadastros este mês: <strong>Em breve</strong></p>
                </div>
            `;
                break;
            case 'configuracoes':
                detalhes.innerHTML = `
                <h4 style="color: #333; margin-bottom: 15px;">
                    <i class="fas fa-cogs"></i> Configurações do Sistema
                </h4>
                <p style="color: #666; margin-bottom: 15px;">Funcionalidade em desenvolvimento...</p>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button onclick="alert('Configuração 1')" style="padding: 8px 15px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Configuração 1
                    </button>
                    <button onclick="alert('Configuração 2')" style="padding: 8px 15px; background: #e67e22; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Configuração 2
                    </button>
                    <button onclick="alert('Configuração 3')" style="padding: 8px 15px; background: #9b59b6; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Configuração 3
                    </button>
                </div>
            `;
                break;
        }

        detalhes.style.display = 'block';

        // Adicionar efeito hover aos cards
        document.querySelectorAll('.function-card').forEach(card => {
            card.style.background = '#f8f9fa';
            card.style.borderColor = '#e9ecef';
        });

        // Destacar card selecionado
        event.currentTarget.style.background = '#e9ecef';
        event.currentTarget.style.borderColor = '#667eea';
    }
</script>