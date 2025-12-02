// Função para redirecionar para a página desejada
function redirecionarParaPagina() {
    // Redireciona para outra página
    window.location.href = "conclusaodesenha.html"; 
}

// Adiciona um evento de clique ao botao
document.getElementById("botao").addEventListener("click", function() {
    // Obtém o valor do campo de email
    var email = document.getElementById("password").value;

    // Chama a função para redirecionar para a página desejada
    redirecionarParaPagina(conclusaodesenha.html);
});