<?php
session_start();
include "conexao.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Verifica se o carrinho tem itens
if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
    echo "<script>alert('Seu carrinho está vazio! Adicione livros antes de alugar.'); window.location.href = 'carrinho.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_SESSION['usuario'];
    $data_saida = $_POST['data_saida'];
    $data_entrega = $_POST['data_entrega'];

    // Processa cada livro do carrinho
    foreach ($_SESSION['carrinho'] as $id => $qtd) {
        $sql = "INSERT INTO alugueis (usuario, livro_id, data_saida, data_entrega, quantidade) 
                VALUES ('$usuario', '$id', '$data_saida', '$data_entrega', '$qtd')";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    }

    // Limpa o carrinho após o aluguel ser registrado
    unset($_SESSION['carrinho']);
    echo "<script>alert('Aluguel realizado com sucesso!'); window.location.href = 'index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguel de Livros</title>
    <link rel="stylesheet" href="assets/css/aluguel.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <h1>Confirmação de Aluguel</h1>
    </header>
    <main class="container mt-5">
        <form method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Email do usuário:</label>
                <input type="text" id="usuario" class="form-control" value="<?php echo $_SESSION['usuario']; ?>" readonly>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Livro</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION['carrinho'] as $id => $qtd) {
                        $sql = "SELECT nome FROM produtos WHERE id='$id'";
                        $result = mysqli_query($conexao, $sql);
                        $livro = mysqli_fetch_assoc($result);

                        echo "<tr>
                                <td>{$livro['nome']}</td>
                                <td>$qtd</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="mb-3">
                <label for="data_saida" class="form-label">Data de Saída:</label>
                <input type="date" name="data_saida" id="data_saida" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="data_entrega" class="form-label">Data de Entrega:</label>
                <input type="date" name="data_entrega" id="data_entrega" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Confirmar Aluguel</button>
            <a href="carrinho.php" class="btn btn-secondary">Voltar ao Carrinho</a>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
