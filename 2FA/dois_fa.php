<?php
session_start();

// Verificar se veio do login e se 2FA está pendente
if (!isset($_SESSION['id_cliente']) || !isset($_SESSION['dois_fa_pendente']) || $_SESSION['dois_fa_pendente'] !== true) {
    header("Location: ../Login/login.php");
    exit();
}

$mysqli = new mysqli("localhost", "root", "avela123", "cpaas_projeto");
$user_id = $_SESSION['id_cliente'];

// Inicializar tentativas na sessão se não existir
if (!isset($_SESSION['tentativas_2fa'])) {
    $_SESSION['tentativas_2fa'] = 0;
}

// Processar resposta PRIMEIRO, antes de definir a pergunta
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta_2fa'])) {
    $resposta_usuario = trim($_POST['resposta_2fa']);
    
    // Buscar dados do usuário para comparação
    $user_info = $mysqli->query("SELECT nomematerno_cliente, datanasc_cliente, cep_cliente FROM cliente WHERE id_cliente = $user_id")->fetch_assoc();
    
    $tipo_pergunta = $_SESSION['tipo_pergunta_2fa'];
    
    // Preparar respostas para comparação
    $respostas_corretas = [
        'mae' => [
            'formatada' => trim($user_info['nomematerno_cliente']),
            'comparacao' => strtoupper(trim($user_info['nomematerno_cliente']))
        ],
        'nascimento' => [
            'formatada' => date('d/m/Y', strtotime($user_info['datanasc_cliente'])),
            'comparacao' => str_replace('-', '', $user_info['datanasc_cliente'])
        ],
        'cep' => [
            'formatada' => substr($user_info['cep_cliente'], 0, 5) . '-' . substr($user_info['cep_cliente'], 5, 3),
            'comparacao' => $user_info['cep_cliente']
        ]
    ];

    // Preparar resposta do usuário para comparação
    $resposta_usuario_limpa = $resposta_usuario;

    switch ($tipo_pergunta) {
        case 'mae':
            $resposta_usuario_limpa = strtoupper(trim($resposta_usuario));
            break;
        case 'nascimento':
            $resposta_usuario_limpa = str_replace('/', '', $resposta_usuario);
            if (strlen($resposta_usuario_limpa) === 8) {
                $dia = substr($resposta_usuario_limpa, 0, 2);
                $mes = substr($resposta_usuario_limpa, 2, 2);
                $ano = substr($resposta_usuario_limpa, 4, 4);
                $resposta_usuario_limpa = $ano . $mes . $dia;
            }
            break;
        case 'cep':
            $resposta_usuario_limpa = str_replace('-', '', $resposta_usuario);
            break;
    }

    // Comparar respostas
    if ($resposta_usuario_limpa === $respostas_corretas[$tipo_pergunta]['comparacao']) {
        // Resposta correta - Login bem-sucedido
        $_SESSION['dois_fa_pendente'] = false;
        $_SESSION['logado'] = true;
        $_SESSION['tentativas_2fa'] = 0;
        unset($_SESSION['tipo_pergunta_2fa']);
        unset($_SESSION['pergunta_texto']);
        header("Location: ../Tela Home/index.php");
        exit();
    } else {
        // Resposta incorreta
        $_SESSION['tentativas_2fa']++;

        if ($_SESSION['tentativas_2fa'] >= 3) {
            session_destroy();
            header("Location: ../Login/login.php");
            exit();
        } else {
            $erro = "Resposta incorreta. Tentativas: " . $_SESSION['tentativas_2fa'] . "/3";
            // Gerar nova pergunta para próxima tentativa
            unset($_SESSION['tipo_pergunta_2fa']);
            unset($_SESSION['pergunta_texto']);
        }
    }
}

// Gerar pergunta aleatória APENAS SE NÃO EXISTIR (depois do processamento do POST)
if (!isset($_SESSION['tipo_pergunta_2fa'])) {
    $perguntas = [
        'mae' => 'Qual o nome da sua mãe?',
        'nascimento' => 'Qual a data do seu nascimento?',
        'cep' => 'Qual o CEP do seu endereço?'
    ];
    $tipo_pergunta = array_rand($perguntas);
    $_SESSION['tipo_pergunta_2fa'] = $tipo_pergunta;
    $_SESSION['pergunta_texto'] = $perguntas[$tipo_pergunta];
}

$tipo_pergunta = $_SESSION['tipo_pergunta_2fa'];
$pergunta_texto = $_SESSION['pergunta_texto'];

// Definir placeholder e máscara baseada no tipo de pergunta ATUAL
$placeholder = "Digite sua resposta...";
$input_class = "";
$data_mask = "";

switch ($tipo_pergunta) {
    case 'nascimento':
        $placeholder = "dd/mm/aaaa";
        $input_class = "mask-date";
        $data_mask = "data";
        break;
    case 'cep':
        $placeholder = "00000-000";
        $input_class = "mask-cep";
        $data_mask = "cep";
        break;
    case 'mae':
        $placeholder = "Nome completo da mãe";
        $input_class = "mask-text";
        $data_mask = "text";
        break;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Segurança - CPaaS</title>
    <link rel="stylesheet" href="style_2fa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body>
    <div class="container-2fa">
        <div class="card-2fa">
            <div class="logo">
                <img src="../img/cpaas-removebg-preview.png" alt="CPaaS">
            </div>

            <h2>Verificação de Segurança</h2>
            <p class="subtitle">Por favor, responda à pergunta abaixo para continuar</p>

            <?php if (isset($erro)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo $erro; ?>
                    <?php if ($_SESSION['tentativas_2fa'] >= 2): ?>
                        <br><small>Última tentativa!</small>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="form-2fa">
                <div class="pergunta">
                    <label><?php echo $pergunta_texto; ?></label>
                    <input type="text"
                        name="resposta_2fa"
                        id="resposta_2fa"
                        class="<?php echo $input_class; ?>"
                        data-mask="<?php echo $data_mask; ?>"
                        required
                        autofocus
                        placeholder="<?php echo $placeholder; ?>"
                        value="">
                </div>

                <div class="btn-group-2fa">
                    <button type="submit" class="btn btn-verificar">
                        <i class="fas fa-shield-alt"></i>
                        Verificar
                    </button>
                    <button type="button" class="btn btn-voltar" onclick="window.location.href='../Login/login.php'">
                        <i class="fas fa-arrow-left"></i>
                        Voltar ao Login
                    </button>
                </div>
            </form>

            <div class="info-2fa">
                <i class="fas fa-info-circle"></i>
                <span>Esta é uma medida de segurança adicional para proteger sua conta.</span>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Aplicar máscaras baseadas no tipo de pergunta
            var maskType = $('#resposta_2fa').data('mask');

            switch (maskType) {
                case 'data':
                    $('#resposta_2fa').mask('00/00/0000');
                    break;
                case 'cep':
                    $('#resposta_2fa').mask('00000-000');
                    break;
                case 'text':
                    // Para nome, não aplicar máscara específica
                    break;
            }

            // Focar no campo de resposta
            $('#resposta_2fa').focus();

            // Permitir apenas números para data e CEP
            $('#resposta_2fa').on('input', function() {
                if (maskType === 'data' || maskType === 'cep') {
                    this.value = this.value.replace(/[^0-9\/\-]/g, '');
                }
            });
        });
    </script>
</body>

</html>