<?php
// Conectar ao banco de dados
$mysqli = new mysqli("localhost", "fabiohenrique", "Fabio1902", "cpaas_projeto");

// Verificar a conexão
if ($mysqli->connect_errno) {
    echo "Falha ao conectar ao MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

// Consulta SQL para obter os dados dos clientes
$sql = "SELECT * FROM cliente";
$result = $mysqli->query($sql);

if (!$result) {
    echo "Erro na consulta SQL: (" . $mysqli->errno . ") " . $mysqli->error;
    exit();
}

$usuarios = [];
while ($linha = $result->fetch_assoc()) {
    $usuarios[] = $linha;
}

// Fechar a conexão
$result->free();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/logo icom.png">
    <title>Consulta de usuário</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="flex-div"><br>
        <button id="button" class="animated-button" onclick="redirecionarParaOutraPagina()">Voltar</button> 
        <button id="button" class="animated-button" onclick="gerarPDF()">Gerar PDF</button>
        <main class="table" id="customers_table">
            <section class="table__header">
                <h1>Consulta de usuário</h1>
                <div class="input-group">
                    <input type="search" id="cpf" placeholder="Digite o CPF...">
                    <img src="img/search.png" alt="">
                </div>
                <script>
                    document.getElementById('cpf').addEventListener('input', function(e) {
                        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
                        e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + (x[3] ? '.' + x[3] : '') + (x[4] ? '-' + x[4] : '');
                    });
                </script>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th> Nome </th>
                            <th> Cpf </th>
                            <th> Data Nascimento </th>
                            <th> Email </th>
                            <th> Celular </th>
                            <th> Excluir </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $linha) { ?>
                        <tr>
                            <td><?php echo $linha['id_cliente']; ?></td>
                            <td><?php echo $linha['nome_cliente']; ?></td>
                            <td><?php echo $linha['cpf_cliente']; ?></td>
                            <td><?php echo $linha['datanasc_cliente']; ?></td>
                            <td><?php echo $linha['email_cliente']; ?></td>
                            <td><?php echo $linha['celular_cliente']; ?></td>
                            <td>
                                <a class='btn btn-sm btn-danger' onclick='showConfirmPopup(<?php echo $linha["id_cliente"]; ?>)' title='Deletar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                    </svg>
                                </a>
                                <!-- Pop-up de confirmação -->
                                <div id="confirmPopup_<?php echo $linha['id_cliente']; ?>" class="popup-container" style="display: none;">
                                    <div class="popup-content">
                                        <p>Tem certeza da exclusão do usuário?</p>
                                        <div class="btn-group">
                                            <button class="btn btn-danger" onclick="confirmDelete(<?php echo $linha['id_cliente']; ?>)">Sim</button>
                                            <button class="btn btn-secondary" onclick="closePopup(<?php echo $linha['id_cliente']; ?>)">Não</button>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <script>
                                function showConfirmPopup(id_cliente) {
                                    document.getElementById("confirmPopup_" + id_cliente).style.display = "block";
                                }

                                function confirmDelete(id_cliente) {
                                    window.location.href = 'delete.php?id_cliente=' + id_cliente;
                                }

                                function closePopup(id_cliente) {
                                    document.getElementById("confirmPopup_" + id_cliente).style.display = "none";
                                }
                            </script>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <script src="js/script.js"></script>

    <script>        
        // Redirecionamento para outra página
        function redirecionarParaOutraPagina() {
            window.location.href = "http://localhost/grupo4kkkjj/master.html"; 
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script>
        var { jsPDF } = window.jspdf;
        var usuarios = <?php echo json_encode($usuarios); ?>;

        function gerarPDF() {
            var doc = new jsPDF('landscape');

            // Adicionar título ao PDF
            doc.setFontSize(18);
            doc.text("Lista de Usuários", 148.5, 20, null, null, "center");

            // Adicionar linha de cabeçalho
            doc.setFontSize(12);
            var headers = ["Id", "Nome", "CPF", "Data Nascimento", "Email"];
            var startX = 25;
            var colWidths = [50, 50, 50, 50, 0]; // Larguras das colunas

            headers.forEach((header, i) => {
                doc.text(header, startX + colWidths.slice(0, i).reduce((a, b) => a + b, 0), 40, null, null, "center");
            });

            // Adicionar uma linha horizontal abaixo do cabeçalho
            doc.line(20, 45, 270, 45);

            // Adicionar dados dos usuários
            var y = 55;
            var lineHeight = 15; // Aumentar espaço vertical entre as linhas
            usuarios.forEach(function(usuario, index) {
                var values = [
                    String(usuario.id_cliente),
                    usuario.nome_cliente,
                    usuario.cpf_cliente,
                    usuario.datanasc_cliente,
                    usuario.email_cliente
                ];

                values.forEach((value, i) => {
                    var xPos = startX + colWidths.slice(0, i).reduce((a, b) => a + b, 0);
                    doc.text(value, xPos, y, null, null, "center");
                });

                y += lineHeight;

                // Adicionar uma linha horizontal a cada 10 registros
                if ((index + 1) % 10 === 0 && index + 1 !== usuarios.length) {
                    doc.addPage();
                    y = 20; // Resetar o y para a nova página
                }
            });

            // Salvar o PDF
            doc.save("usuarios.pdf");
        }
    </script>

</body>
</html>
