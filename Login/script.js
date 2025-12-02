// Função para realizar o login
function login() {
  var usuario = document.getElementById('usuario').value;
  var senha = document.getElementById('senha').value;

  verificarLogin(usuario, senha);
}

// Função para verificar o login
function verificarLogin(usuario, senha) {
  // Recuperar os usuários salvos do localStorage
  var usuariosSalvos = JSON.parse(localStorage.getItem('Usuarios')) || [];

  // Verificar se há um usuário com o nome de usuário fornecido e senha correspondente
  var usuarioEncontrado = usuariosSalvos.find(function(user) {
    return user.Login === usuario && user.Senha === senha;
  });

  if (
    usuario === "" ||
    senha === ""
  ) {
    exibirMensagemErro("Por favor, preencha todos os campos.");
    return false;
  }

  // Se não encontrar nenhum usuário com o nome de usuário e senha fornecidos
  if (!usuarioEncontrado) {
    exibirMensagemErro("Usuário ou senha incorretos.");
    return;
  }

  localStorage.setItem('UsuarioLogado', usuario);  

  // Salvar as informações do usuário no sessionStorage
  sessionStorage.setItem('ponte2fa', JSON.stringify(usuarioEncontrado));

  // Se o usuário for encontrado e a senha estiver correta, redirecionar para a página index.html
  window.location.href = '2fa.html';
}

// Início da função para exibir a mensagem de erro
function exibirMensagemErro(mensagem) {
  var mensagemErroDiv = document.getElementById('mensagensErro');
  mensagemErroDiv.innerHTML = mensagem;
}
// Fim da função para exibir a mensagem de erro

//Inicio da função para mostrar e não mostrar senha
function toggleSenha() {
  var senhaInput = document.getElementById("senha");
  var icone = document.getElementById("icone");

  if (senhaInput.type === "password") {
    senhaInput.type = "text";
    icone.className = "bi bi-eye-slash";
  } else {
    senhaInput.type = "password";
    icone.className = "bi bi-eye";
  }
}
