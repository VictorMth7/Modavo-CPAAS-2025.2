<?php
// Conexão com o banco
$mysqli = new mysqli("localhost", "root", "avela123", "cpaas_projeto");

// Verifica a conexão
if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

// Pega os dados do formulário
$nome_cliente = $_POST['nomeCompleto'];
$cpf_cliente = str_replace(['.', '-'], '', $_POST['cpf']);
$nomematerno_cliente = $_POST['nomeMaterno'];
$sexo_cliente = $_POST['sexo'];

// Converte data
$data_nascimento = $_POST['dataNascimento'];
$data_parts = explode('/', $data_nascimento);
$datanasc_cliente = $data_parts[2] . '-' . $data_parts[1] . '-' . $data_parts[0];

$email_cliente = $_POST['email'];
$celular_cliente = preg_replace('/[^0-9]/', '', $_POST['celular']);
$fixo_cliente = preg_replace('/[^0-9]/', '', $_POST['telefoneFixo']);
$cep_cliente = str_replace('-', '', $_POST['cep']);
$rua_cliente = $_POST['rua'];
$numero_cliente = $_POST['numero'];
$bairro_cliente = $_POST['bairro'];
$complemento_cliente = $_POST['complete'];
$cidade_cliente = $_POST['cidade'];
$estado_cliente = $_POST['estado'];
$login_cliente = $_POST['Usuario'];
$senha_cliente = $_POST['senha']; // Senha sem hash para teste

// Query de inserção
$query = "INSERT INTO cliente (
    nome_cliente, 
    cpf_cliente, 
    nomematerno_cliente, 
    sexo_cliente, 
    datanasc_cliente, 
    email_cliente, 
    celular_cliente, 
    fixo_cliente, 
    cep_cliente, 
    rua_cliente, 
    numero_cliente, 
    bairro_cliente, 
    complemento_cliente, 
    cidade_cliente, 
    estado_cliente, 
    login_cliente, 
    senha_cliente
) VALUES (
    '$nome_cliente',
    '$cpf_cliente',
    '$nomematerno_cliente',
    '$sexo_cliente',
    '$datanasc_cliente',
    '$email_cliente',
    '$celular_cliente',
    '$fixo_cliente',
    '$cep_cliente',
    '$rua_cliente',
    '$numero_cliente',
    '$bairro_cliente',
    '$complemento_cliente',
    '$cidade_cliente',
    '$estado_cliente',
    '$login_cliente',
    '$senha_cliente'
)";

// Executa a query
if ($mysqli->query($query)) {
    echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location.href = '../Login/login.php';
    </script>";
} else {
    echo "<script>
        alert('Erro: " . $mysqli->error . "');
        window.history.back();
    </script>";
}

$mysqli->close();
?>