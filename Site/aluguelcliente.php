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

// Verifica se o aluguel deve ser excluído
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['aluguel_id'])) {
    $aluguel_id = intval($_GET['aluguel_id']);
    $delete_query = "DELETE FROM alugueis WHERE id = $aluguel_id AND usuario = '$email'";
    if (mysqli_query($conexao, $delete_query)) {
        echo "<script>alert('Aluguel excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir o aluguel.');</script>";
    }
}

// Busca aluguéis do usuário
$aluguel_query = "SELECT * FROM alugueis WHERE usuario = '$email' ORDER BY data_saida DESC";
$aluguel_result = mysqli_query($conexao, $aluguel_query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugueis do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background: #5B3A29;
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
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
        }

        nav ul li a:hover {
            background: #7B4B3A;
        }

        main {
            padding: 20px;
            background: #fff;
            max-width: 800px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow-y: auto; /* Permite scroll vertical */
            max-height: 500px; /* Altura máxima do conteúdo */
        }

        h2, h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #5B3A29;
            color: white;
        }

        button {
            background: #5B3A29;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #7B4B3A;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background: #5B3A29;
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
                <li><a href="aluguelcliente.php">Alugueis</a></li>
          
            </ul>
        </nav>
    </header>

    <main>
        <h2>Seus Aluguéis</h2>
        <?php if (mysqli_num_rows($aluguel_result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID do Aluguel</th>
                        <th>Livro ID</th>
                        <th>Data de Saída</th>
                        <th>Data de Entrega</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($aluguel = mysqli_fetch_assoc($aluguel_result)): ?>
                        <tr>
                            <td><?= $aluguel['id'] ?></td>
                            <td><?= $aluguel['livro_id'] ?></td>
                            <td><?= date('d/m/Y', strtotime($aluguel['data_saida'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($aluguel['data_entrega'])) ?></td>
                            <td><?= $aluguel['quantidade'] ?></td>
                            <td>
                                <a href="aluguelcliente.php?acao=excluir&aluguel_id=<?= $aluguel['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este aluguel?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Você ainda não fez nenhum aluguel.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Editora Transformar</p>
    </footer>
</body>
</html>
