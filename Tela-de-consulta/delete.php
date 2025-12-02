<?php
if (!empty($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

    // Conecte-se ao banco de dados
    $conn = new mysqli("localhost", "root", "Fabio1902", "cpaas_projeto"); // Substitua pelas suas informações de conexão

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $id_cliente = $conn->real_escape_string($id_cliente);

    $sqlSelect = "SELECT * FROM cliente WHERE id_cliente=$id_cliente";
    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM cliente WHERE id_cliente=$id_cliente";
        $resultDelete = $conn->query($sqlDelete);

        // Redirecione para a mesma página (ou outra página)
        header("Location: pag.php");
            exit;
        } else {
            echo "Nenhum registro encontrado para o ID do cliente informado.";
        }
    }

    // Feche a conexão
    $conn->close();
?>