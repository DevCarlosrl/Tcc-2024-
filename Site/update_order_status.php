<?php
// Inclui a conexão com o banco de dados
include "conexao.php";

// Verifica se o ID do pedido e o novo status foram passados via POST
if (isset($_POST['id']) && isset($_POST['status'])) {
    // Proteção contra SQL Injection
    $id = intval($_POST['id']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    // Atualiza o status do pedido no banco de dados
    $sql = "UPDATE pedidos SET status = '$status' WHERE id = $id";
    if (mysqli_query($conexao, $sql)) {
        // Redireciona de volta para a página de pedidos com mensagem de sucesso
        header("Location: pedidos.php?status=atualizado");
        exit;
    } else {
        echo "Erro ao atualizar o status: " . mysqli_error($conexao);
    }
} else {
    echo "ID do pedido ou status não fornecido.";
}
?>
