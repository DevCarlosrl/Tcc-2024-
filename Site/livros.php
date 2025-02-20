<?php
session_start();
include "conexao.php";

// Verifica se o usuário é admin
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
    echo "<script>alert('Acesso restrito.'); window.location.href = 'index.php';</script>";
    exit();
}

// Inicializa os filtros
$idFilter = isset($_POST['id']) ? $_POST['id'] : '';
$nomeFilter = isset($_POST['nome']) ? $_POST['nome'] : '';
$categoriaFilter = isset($_POST['categoria']) ? $_POST['categoria'] : '';
$precoFilter = isset($_POST['preco']) ? $_POST['preco'] : '';

// Consulta SQL para buscar produtos com filtros
$sql = "SELECT * FROM produtos WHERE 1=1";

if ($idFilter !== '') {
    $sql .= " AND id = " . intval($idFilter);
}
if ($nomeFilter !== '') {
    $sql .= " AND nome LIKE '%" . $conexao->real_escape_string($nomeFilter) . "%'";
}
if ($categoriaFilter !== '') {
    $sql .= " AND categoria LIKE '%" . $conexao->real_escape_string($categoriaFilter) . "%'";
}
if ($precoFilter !== '') {
    $sql .= " AND preco <= " . floatval($precoFilter);
}

$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Produtos</title>
    <style>
        /* Fundo com sobreposições de tons marrons */
        body {
            font-family: Arial, sans-serif;
            color: #FFFFFF;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: linear-gradient(135deg, #4B2E1A 30%, transparent 30%),
                        linear-gradient(45deg, #3E2516 30%, transparent 30%),
                        linear-gradient(225deg, #6B4226 30%, transparent 30%),
                        linear-gradient(315deg, #8B5E3C 30%, transparent 30%);
            background-size: 100% 100%;
            background-color: #4B2E1A;
            position: relative; /* Para posicionar os botões */
        }

        h1 {
            color: #fff;
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Estilos para o botão de voltar ao dashboard */
        .back-to-dashboard {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #8B5E3C;
            color: #FFFFFF;
            font-size: 0.9em;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        /* Efeito de hover no botão */
        .back-to-dashboard:hover {
            background-color: #A07047;
            transform: scale(1.05);
        }

        /* Estilos para o botão de voltar ao topo */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #8B5E3C;
            color: #FFFFFF;
            font-size: 0.9em;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: opacity 0.4s ease, transform 0.3s ease;
            cursor: pointer;
            opacity: 0; /* Esconde o botão inicialmente */
            transform: translateY(10px); /* Move o botão levemente para baixo */
            visibility: hidden;
        }

        /* Mostra o botão com transição */
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            background-color: #A07047;
            transform: scale(1.05);
        }

        /* Estilos para a tabela */
        table {
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
            margin: 40px auto; /* Margin maior para não conflitar com o botão superior */
            background-color: #ffffff;
            border: 2px solid #D2B48C;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border-radius: 12px;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            color: #4b3d33;
            border-bottom: 1px solid #D2B48C;
        }

        th {
            background-color: #8B5E3C;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        /* Cor de fundo alternada para as linhas */
        tbody tr:nth-child(odd) {
            background-color: #FAF3E0;
        }

        tbody tr:nth-child(even) {
            background-color: #FFFFFF;
        }

        /* Efeito de hover para linhas da tabela */
        tr:hover {
            background-color: #F5D7B1;
            transition: background-color 0.4s ease;
        }

        /* Estilo das imagens */
        .product-image {
            width: 80px;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para o formulário de filtro */
        .filter-form {
            margin: 20px auto;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .filter-form input, .filter-form button {
            margin: 5px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #D2B48C;
            outline: none;
        }

        .filter-form button {
            background-color: #8B5E3C;
            color: white;
            cursor: pointer;
        }

        .filter-form button:hover {
            background-color: #A07047;
        }
    </style>
</head>
<body>
    <!-- Botão de Voltar ao Dashboard no Canto Superior Esquerdo -->
    <a href="dashboard.php" class="back-to-dashboard">Voltar ao Dashboard</a>

    <h1>Produtos</h1>
    
    <!-- Formulário de filtro -->
    <form method="post" class="filter-form">
        <input type="text" name="id" placeholder="ID" value="<?php echo htmlspecialchars($idFilter); ?>">
        <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($nomeFilter); ?>">
        <input type="text" name="categoria" placeholder="Categoria" value="<?php echo htmlspecialchars($categoriaFilter); ?>">
        <input type="number" step="0.01" name="preco" placeholder="Preço Máximo" value="<?php echo htmlspecialchars($precoFilter); ?>">
        <button type="submit">Filtrar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Imagem</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
                echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
                echo "<td>" . htmlspecialchars($row['quantidade']) . "</td>";
                if (!empty($row['imagem'])) {
                    echo "<td><img src='" . htmlspecialchars($row['imagem']) . "' alt='Imagem do Produto' class='product-image'></td>";
                } else {
                    echo "<td>Não disponível</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Botão de Voltar ao Topo no Canto Inferior Direito -->
    <button class="back-to-top" onclick="scrollToTop()">Voltar ao Topo</button>

    <script>
        // Função para rolar a página para o topo
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Função para exibir o botão "Voltar ao Topo" ao chegar no fim da página
        window.addEventListener('scroll', function() {
            const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = window.scrollY;
            const backToTopButton = document.querySelector('.back-to-top');
            
            // Exibe o botão com uma classe para transição
            if (scrolled >= scrollableHeight) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });
    </script>
</body>
</html>
