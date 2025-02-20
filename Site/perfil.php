<?php
session_start();
include('conexao.php'); // Conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

$email = $_SESSION['usuario'];

// Busca informações do usuário
$query = "SELECT * FROM usuarios WHERE email = '$email'";
$result = mysqli_query($conexao, $query);
$user = mysqli_fetch_assoc($result);

// Verifica se o pedido deve ser excluído
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['pedido_id'])) {
    $pedido_id = intval($_GET['pedido_id']);
    $delete_query = "DELETE FROM pedidos WHERE id = $pedido_id AND usuario = '$email'";
    if (mysqli_query($conexao, $delete_query)) {
        echo "<script>alert('Pedido excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir o pedido.');</script>";
    }
}

// Busca pedidos do usuário
$pedido_query = "SELECT * FROM pedidos WHERE usuario = '$email' ORDER BY data_pedido DESC";
$pedido_result = mysqli_query($conexao, $pedido_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);

    $update_query = "UPDATE usuarios SET nome = '$nome', telefone = '$telefone', cpf = '$cpf', endereco = '$endereco' WHERE email = '$email'";
    
    if (mysqli_query($conexao, $update_query)) {
        echo "<script>
                alert('Perfil atualizado com sucesso!');
                window.location.href = 'perfil.php';
              </script>";
        exit;
    } else {
        echo "<p>Erro ao atualizar o perfil. Por favor, tente novamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background: #5B3A29; /* Cor marrom mais escura para o cabeçalho */
            color: #fff;
            padding: 10px 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a {
            color: #fff; /* Cor dos links */
            text-decoration: none; /* Remove o sublinhado */
            padding: 5px 10px;
            border-radius: 4px;
        }

        nav ul li a:hover {
            background: #7B4B3A; /* Cor mais clara ao passar o mouse */
        }

        main {
            padding: 20px;
            background: #fff;
            max-width: 800px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2, h3 {
            color: #333;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #5B3A29; /* Cor marrom mais escura para o botão */
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #7B4B3A; /* Cor mais clara ao passar o mouse no botão */
        }

        .back-button {
            background: #ccc; /* Cor do botão voltar */
            color: #333;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        .back-button:hover {
            background: #aaa; /* Cor ao passar o mouse no botão voltar */
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background: #5B3A29; /* Cor marrom mais escura para o rodapé */
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bem-vindo ao seu Dashboard</h1>
        <nav>
            <ul>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="aluguelcliente.php">Aluguel</a></li>
    
            </ul>
        </nav>
    </header>

    <main>
        <h2>Perfil do Usuário</h2>
        
        <section>
            <h3>Informações Pessoais</h3>
            <form method="POST" action="perfil.php">
                <!-- Formulário de atualização de perfil -->
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                </div>
                <div>
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($user['telefone']) ?>" required>
                </div>
                <div>
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($user['cpf']) ?>" required>
                </div>
                <div>
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($user['endereco']) ?>" required>
                </div>
                <div>
                    <button type="submit">Atualizar Perfil</button>
                </div>
            </form>
            <button class="back-button" onclick="window.location.href='index.php';">Voltar para a Página Inicial</button>
        </section>

        <section>
            <h3>Seus Pedidos</h3>
            <?php if (mysqli_num_rows($pedido_result) > 0): ?>
                <table border="1" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID do Pedido</th>
                            <th>Data</th>
                            <th>Total (R$)</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($pedido = mysqli_fetch_assoc($pedido_result)): ?>
                            <tr>
                                <td><?= $pedido['id'] ?></td>
                                <td><?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?></td>
                                <td>R$ <?= number_format($pedido['total'], 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($pedido['status']) ?></td>
                                <td>
                                    <a href="perfil.php?acao=excluir&pedido_id=<?= $pedido['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este pedido?');">Excluir</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Você ainda não fez nenhum pedido.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Editora Transformar</p>
    </footer>
</body>
</html>
