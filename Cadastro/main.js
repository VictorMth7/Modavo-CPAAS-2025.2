//Inicio da função para puxar endereço pelo cep
function limpa_formulário_cep() {
  document.getElementById('rua').value = ("");
  document.getElementById('bairro').value = ("");
  document.getElementById('cidade').value = ("");
  document.getElementById('uf').value = ("");
  document.getElementById('ibge').value = ("");
}

function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    document.getElementById('rua').value = (conteudo.logradouro);
    document.getElementById('bairro').value = (conteudo.bairro);
    document.getElementById('cidade').value = (conteudo.localidade);
    document.getElementById('uf').value = (conteudo.uf);
    document.getElementById('ibge').value = (conteudo.ibge);
  }
  else {
    limpa_formulário_cep();
    alert("CEP não encontrado.");
  }
}

function pesquisacep(valor) {

  var cep = valor.replace(/\D/g, '');

  if (cep != "") {

    var validacep = /^[0-9]{8}$/;

    if (validacep.test(cep)) {

      document.getElementById('rua').value = "...";
      document.getElementById('bairro').value = "...";
      document.getElementById('cidade').value = "...";
      document.getElementById('uf').value = "...";

      var script = document.createElement('script');

      script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

      document.body.appendChild(script);

    }
    else {
      limpa_formulário_cep();
      alert("Formato de CEP inválido.");
    }
  }
  else {
    limpa_formulário_cep();
  }
};
//fim da função para puxar endereço pelo cep

//Inicio da função para bloquar caracteres
function bloquearCaracteres(event) {
  var tecla = event.which || event.keyCode;
  var teclaCaracter = String.fromCharCode(tecla);

  var regex = /^[a-zA-Z0-9!@#$%^&*(),.?":{}|<>]+$/;

  if (!regex.test(teclaCaracter)) {
    event.preventDefault();
  }
}

//Inicio da função para limpar formulario
function limparFormulario() {
  document.getElementById("cadastroForm").reset();
}

//Inicio da função para mostrar e não mostrar senha
function togglePasswordVisibility() {
  var senhaInput = document.getElementById("senha");
  var eyeIcon = document.getElementById("eyeIcon");

  if (senhaInput.type === "password") {
    senhaInput.type = "text";
    eyeIcon.classList.remove("bi-eye");
    eyeIcon.classList.add("bi-eye-slash");
  } else {
    senhaInput.type = "password";
    eyeIcon.classList.remove("bi-eye-slash");
    eyeIcon.classList.add("bi-eye");
  }
}

function togglePasswordVisibility(fieldId) {
  var field = document.getElementById(fieldId);
  var eyeIcon = document.getElementById("eyeIcon" + fieldId.charAt(0).toUpperCase() + fieldId.slice(1));
  if (field.type === "password") {
    field.type = "text";
    eyeIcon.classList.remove("bi-eye");
    eyeIcon.classList.add("bi-eye-slash");
  } else {
    field.type = "password";
    eyeIcon.classList.remove("bi-eye-slash");
    eyeIcon.classList.add("bi-eye");
  }
}

// Inicio da função para validar CPF
function validarCPF(cpf) {
  cpf = cpf.replace(/[^\d]+/g, '');
  if (cpf === '') return false;

  // Eliminar CPFs inválidos conhecidos
  if (
    cpf.length !== 11 ||
    cpf === '00000000000' ||
    cpf === '11111111111' ||
    cpf === '22222222222' ||
    cpf === '33333333333' ||
    cpf === '44444444444' ||
    cpf === '55555555555' ||
    cpf === '66666666666' ||
    cpf === '77777777777' ||
    cpf === '88888888888' ||
    cpf === '99999999999'
  ) {
    return false;
  }

  // Validar 1º dígito
  var add = 0;
  for (var i = 0; i < 9; i++) add += parseInt(cpf.charAt(i)) * (10 - i);
  var rev = 11 - (add % 11);
  if (rev === 10 || rev === 11) rev = 0;
  if (rev !== parseInt(cpf.charAt(9))) return false;

  // Validar 2º dígito
  add = 0;
  for (var i = 0; i < 10; i++) add += parseInt(cpf.charAt(i)) * (11 - i);
  rev = 11 - (add % 11);
  if (rev === 10 || rev === 11) rev = 0;
  if (rev !== parseInt(cpf.charAt(10))) return false;

  return true;
}

// Inicio da Função para exibir as mensagens de erro
function exibirMensagemErro(campo, mensagem) {
  var campoId = campo.id;
  var divErro = document.getElementById('error-' + campoId);
  if (divErro) {
    divErro.innerHTML = mensagem;
  }
}

// Inicio da Função para limpar todas as mensagens de erro
function limparMensagensErro() {
  var errorMessages = document.querySelectorAll('.error-message');
  errorMessages.forEach(function (error) {
    error.innerHTML = '';
  });
}

// Função para validar o formulário
function validarFormulario() {
  // Obtenha referências para os elementos do formulário
  var campos = document.querySelectorAll('input[required], select[required]');
  
  // Limpe as mensagens de erro anteriores
  limparMensagensErro();

  // Variáveis para verificar se houve algum erro de validação
  var erroEncontrado = false;

  // Verifique cada campo individualmente
  campos.forEach(function(campo) {
    if (campo.value.trim() === "") {
      exibirMensagemErro(campo, "Por favor, preencha este campo.");
      erroEncontrado = true;
    }

    // Validação de CPF
    if (campo.id === 'cpf') {
      if (!validarCPF(campo.value)) {
        exibirMensagemErro(campo, "CPF inválido.");
        erroEncontrado = true;
      }
    }

    // Validação de senha
    if (campo.id === 'confirmarSenha') {
      var senha = document.getElementById('senha');
      if (senha.value !== campo.value) {
        exibirMensagemErro(campo, "As senhas não coincidem.");
        erroEncontrado = true;
      }
    }
  });

  // Se houver erros, impede o envio do formulário
  if (erroEncontrado) {
    return false;
  }

  // Se não houver erros, permite o envio
  return true;
}
// Fim da função para validar o formulário
