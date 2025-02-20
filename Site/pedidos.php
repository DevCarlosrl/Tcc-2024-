<?php
session_start();
include "conexao.php";

// Verifique se o usuário é admin
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
    echo "<script>alert('Acesso restrito.'); window.location.href = 'index.php';</script>";
    exit();
}

// Atualização de status do pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pedido_id'], $_POST['status'])) {
    $pedido_id = intval($_POST['pedido_id']);
    $status = $_POST['status'];
    
    $stmt = $conexao->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $pedido_id);
    $stmt->execute();
    $stmt->close();
}

// Remoção de pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_pedido_id'])) {
    $remover_pedido_id = intval($_POST['remover_pedido_id']);
    
    $stmt = $conexao->prepare("DELETE FROM pedidos WHERE id = ?");
    $stmt->bind_param("i", $remover_pedido_id);
    $stmt->execute();
    $stmt->close();
}

// Filtro de busca
$filtro_id = isset($_GET['filtro_id']) ? intval($_GET['filtro_id']) : null;
$filtro_usuario = isset($_GET['filtro_usuario']) ? $_GET['filtro_usuario'] : null;
$filtro_data = isset($_GET['filtro_data']) ? $_GET['filtro_data'] : null;

// Construção da consulta SQL com filtros
$sql = "SELECT pedidos.id AS pedido_id, pedidos.usuario, pedidos.total, pedidos.produtos, 
        pedidos.status, pedidos.data_pedido 
        FROM pedidos 
        WHERE 1=1";

if ($filtro_id) {
    $sql .= " AND pedidos.id = $filtro_id";
}

if ($filtro_usuario) {
    $filtro_usuario = $conexao->real_escape_string($filtro_usuario); // Proteção contra SQL Injection
    $sql .= " AND pedidos.usuario LIKE '%$filtro_usuario%'";
}

if ($filtro_data) {
    $sql .= " AND DATE(pedidos.data_pedido) = '$filtro_data'";
}

$sql .= " ORDER BY pedidos.data_pedido DESC";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pedidos</title>
    <style>
        /* Estilo global */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4B2E1A 30%, transparent 30%),
                        linear-gradient(45deg, #3E2516 30%, transparent 30%),
                        linear-gradient(225deg, #6B4226 30%, transparent 30%),
                        linear-gradient(315deg, #8B5E3C 30%, transparent 30%);
            background-size: 100% 100%;
            background-color: #4B2E1A;
            height: 100vh;
            padding: 20px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background-color: #8B5E3C;
            color: white;
            font-weight: bold;
            font-size: 1.2em;
        }

        /* Botão para imprimir */
        #print-button {
            padding: 8px 16px;
            font-size: 1em;
            color: white;
            background-color: #4B2E1A;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #print-button:hover {
            background-color: #A07047;
        }

        /* Formulário de filtro */
        .filter-form {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .filter-form label {
            display: flex;
            flex-direction: column;
            font-weight: 500;
            color: #4B2E1A;
        }

        .filter-form input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filter-form button {
            padding: 8px 12px;
            background-color: #4B2E1A;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .filter-form button:hover {
            background-color: #A07047;
        }

        /* Tabela */
        .divTable {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #4B2E1A;
        }

        th {
            background-color: #8B5E3C;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #FAF3E0;
        }

        tbody tr:hover {
            background-color: #F5D7B1;
            transition: background-color 0.3s;
        }

        /* Ações */
        .acao {
            text-align: center;
            width: 200px; /* Aumenta a largura para incluir ambos os botões */
        }

        .acao a {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .acao .btn-primary {
            background-color: #4B2E1A;
        }

        .acao .btn-primary:hover {
            background-color: #A07047;
        }

        .acao .btn-danger {
            background-color: #b31a1a;
        }

        .acao .btn-danger:hover {
            background-color: #e02525;
        }

        /* Botão voltar */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .back-button img {
            width: 32px;
            height: 32px;
        }

        .back-button:hover {
            opacity: 0.7;
        }

    </style>
</head>

<body>
    <!-- Botão de voltar -->
    <div class="back-button">
        <a href="dashboard.php" title="Voltar para a página dashboard">
            <img src="https://cdn-icons-png.flaticon.com/512/66/66822.png" alt="Voltar para o dashboard">
        </a>
    </div>

    <div class="container">
        <div class="header">
            <span>Pedidos</span>
            <button onclick="window.print()" id="print-button">Imprimir Relatório</button>
        </div>

        <!-- Formulário de filtragem -->
        <form method="GET" class="filter-form">
            <label for="filtro_id">
                Filtrar por ID:
                <input type="number" id="filtro_id" name="filtro_id">
            </label>
            <label for="filtro_usuario">
                Filtrar por Usuário:
                <input type="text" id="filtro_usuario" name="filtro_usuario">
            </label>
            <label for="filtro_data">
                Filtrar por Data de Pedido:
                <input type="date" id="filtro_data" name="filtro_data">
            </label>
            <button type="submit">Filtrar</button>
        </form>

        <div class="divTable">
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Usuário</th>
                        <th>Total</th>
                        <th>Produtos e Quantidades</th>
                        <th>Data do Pedido</th>
                        <th>Status</th>
                        <th class="acao">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['pedido_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                            <td>R$ <?php echo number_format($row['total'], 2, ',', '.'); ?></td>
                            <td class="produtos">
                                <?php
                                $produtos = json_decode($row['produtos'], true);
                                if ($produtos) {
                                    foreach ($produtos as $produto_id => $quantidade) {
                                        echo "ID: $produto_id - Quantidade: $quantidade<br>";
                                    }
                                } else {
                                    echo "Nenhum produto encontrado";
                                }
                                ?>
                            </td>
                            <td><?php echo $row['data_pedido']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td class="acao">
                                <!-- Formulário para atualizar o status -->
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="pedido_id" value="<?php echo $row['pedido_id']; ?>">
                                    <select name="status">
                                        <option value="pendente" <?php if ($row['status'] === 'pendente') echo 'selected'; ?>>Pendente</option>
                                        <option value="enviado" <?php if ($row['status'] === 'enviado') echo 'selected'; ?>>Enviado</option>
                                        <option value="entregue" <?php if ($row['status'] === 'entregue') echo 'selected'; ?>>Entregue</option>
                                    </select>
                                    <button type="submit">Atualizar</button>
                                </form>

                                <!-- Formulário para remover o pedido -->
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="remover_pedido_id" value="<?php echo $row['pedido_id']; ?>">
                                    <button type="submit" class="btn-danger">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
