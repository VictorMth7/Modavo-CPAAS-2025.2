<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Inclui o arquivo de estilo CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Define o ícone da página -->
  <link rel="icon" href="img/logo icom.png">
  <!-- Inclui o arquivo de script JavaScript -->
  <script src="script.js"></script>
  <!--Links do bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!--Nome da pagina-->
  <title>Pagina De Login</title>
</head>

<body>
  <div class="main-login">
    <div class="left-login">
      <h1>Bem Vindo A CPaaS<br>Faça Seu Login</h1>
      <img src="img/cpaas_logo.png" class="img-login" alt="CPaaS">
    </div>

    <div class="right-login">
      <div class="card-login">
        <h1>LOGIN</h1>
        <!-- Formulário com método POST -->
        <form method="POST" action="">
          <div class="textfiel">
            <label for="usuario">Login</label>
            <input type="text" name="usuario" id="usuario" placeholder="Usuário" maxlength="6" minlength="6" required>
          </div>
          <div class="textfiel">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Senha" maxlength="8" minlength="8" required>
            <button type="button" onclick="toggleSenha()">
              <i id="icone" class="bi bi-eye"></i>
            </button>
          </div>
          <!-- Botão tipo submit -->
          <button type="submit" id="btn-login" class="btn-login">Login</button>
        </form>
        <div id="mensagensErro"></div>
        <a href="../Tela de recuperação de senha/recuperaçãodesenha.html" class="Esqueci">Esqueci minha senha</a><br>
        <a href="../Cadastro/cadastro.html" class="cadastre-se">Ou cadastre-se aqui</a>
      </div>
    </div>
  </div>

<?php
// Processamento do login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("localhost", "root", "avela123", "cpaas_projeto");

    // Verifica a conexão
    if ($mysqli->connect_errno) {
        echo "<script>document.getElementById('mensagensErro').innerHTML = 'Erro de conexão com o banco de dados';</script>";
        exit();
    }

    // Obtém e sanitiza os dados do formulário
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $senha = $_POST['senha'];

    // Consulta o usuário no banco usando a tabela 'cliente'
    $query = "SELECT * FROM cliente WHERE login_cliente = '$usuario'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifica a senha
        if ($senha === $user['senha_cliente']) {
            // Login bem-sucedido - INÍCIO DAS MODIFICAÇÕES 2FA
            
            // Buscar configuração do 2FA do usuário
            $check_2fa = $mysqli->query("SELECT dois_fa_ativado FROM cliente WHERE id_cliente = " . $user['id_cliente']);
            $config_2fa = $check_2fa->fetch_assoc();
            
            // Iniciar sessão
            session_start();
            $_SESSION['usuario'] = $user['login_cliente'];
            $_SESSION['id_cliente'] = $user['id_cliente'];
            $_SESSION['nome_cliente'] = $user['nome_cliente'];
            
            if ($config_2fa['dois_fa_ativado']) {
                // Se 2FA está ativado, redireciona para verificação
                $_SESSION['dois_fa_pendente'] = true;
                $_SESSION['tentativas_2fa'] = 0; // Inicializar tentativas
                header("Location: ../2FA/dois_fa.php");
                exit();
            } else {
                // Se 2FA não está ativado, vai direto para home
                $_SESSION['logado'] = true;
                header("Location: ../Tela Home/index.php");
                exit();
            }
            // FIM DAS MODIFICAÇÕES 2FA
            
        } else {
            echo "<script>document.getElementById('mensagensErro').innerHTML = 'Senha incorreta';</script>";
        }
    } else {
        echo "<script>document.getElementById('mensagensErro').innerHTML = 'Usuário não encontrado';</script>";
    }

    $result->free();
    $mysqli->close();
}
?>
</body>
</html>