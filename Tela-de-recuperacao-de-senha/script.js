// Função para redirecionar para a página desejada
function redirecionarParaPagina() {
    // Redireciona para outra página
    window.location.href = "conclusaodeemail.html"; 
}

// Adiciona um evento de clique ao botão
document.getElementById("enviar").addEventListener("click", function() {
    // Obtém o valor do campo de email
    var email = document.getElementById("email").value;

    // Chama a função para redirecionar para a página desejada
    redirecionarParaPagina(conclusaodeemail.html);
});