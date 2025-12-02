//Simulando; 
let logEntries = [
    { name: "Usuário 1", cpf: "123.456.789-00", authType: "SMS" },
    { name: "Usuário 2", cpf: "987.654.321-00", authType: "Token" },
    { name: "Usuário 3", cpf: "456.789.123-00", authType: "Token" },

];
 // Comando para exibir data e hora atuais;
function searchLog() {
    const searchValue = document.getElementById("searchInput").value.trim().toLowerCase();

    const currentDateTime = new Date().toISOString().replace("T", " ").substr(0, 19); 
   

    const filteredLogs = logEntries.filter(entry => {
        return entry.name.toLowerCase().includes(searchValue) ||
               entry.cpf.toLowerCase().includes(searchValue) ||
               searchValue === "";
    });


    filteredLogs.forEach(entry => {
        entry.timestamp = currentDateTime;
    });

    displayLogSummary(filteredLogs);
}

function displayLogSummary(logs) {
    const logSummaryContainer = document.getElementById("logSummary");
    logSummaryContainer.innerHTML = "";

    if (logs.length === 0) {
        logSummaryContainer.innerText = "Nenhum Registro Encontrado.";
        return;
    }

    logs.forEach(entry => {
        const logEntry = document.createElement("div");
        logEntry.classList.add("logEntry");
        logEntry.innerHTML = `
            <p><strong>Data e Hora:</strong> ${entry.timestamp}</p>
            <p><strong>Nome:</strong> ${entry.name}</p>
            <p><strong>CPF:</strong> ${entry.cpf}</p>
            <p><strong>2FA:</strong> ${entry.authType}</p>
        `;
        logSummaryContainer.appendChild(logEntry);
    });
}

// Verificação do usúario Master; 
const isMasterUser = true;
if (isMasterUser) {
   
    searchLog();
}


//exibe o conteudo da tela novamente
document.addEventListener("DOMContentLoaded", function() {  document.querySelector('.container').classList.add('fade-in');
});