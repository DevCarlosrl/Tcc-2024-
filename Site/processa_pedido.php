<?php
session_start();
include "conexao.php"; // Certifique-se de que sua conexão está correta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $total = floatval($_POST['total']);
    
    // Verifique o conteúdo do carrinho para garantir que está no formato correto
    if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
        echo "<script>
                alert('Carrinho vazio. Não é possível processar o pedido. Você será redirecionado para o carrinho.');
                window.location.href = 'carrinho.php';
              </script>";
        exit;
    }

    // Converte o carrinho para JSON
    $produtos = json_encode($_SESSION['carrinho']);

    // Inserir pedido na tabela 'pedidos'
    $sql = "INSERT INTO pedidos (usuario, total, produtos) VALUES ('$usuario', '$total', '$produtos')";

    if (mysqli_query($conexao, $sql)) {
        // Limpa o carrinho após finalizar a compra
        unset($_SESSION['carrinho']);
        echo "<script>
                alert('Pedido realizado com sucesso!');
                window.location.href = 'carrinho.php';
              </script>";
    } else {
        echo "Erro ao processar pedido: " . mysqli_error($conexao);
    }
}
?>
