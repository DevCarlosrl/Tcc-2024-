<?php
include "conexao.php"; // Certifique-se de que isso esteja carregando corretamente a variável de conexão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de Cadastro</title>
  <link rel="stylesheet" href="assets/css/painelcadastro.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
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
      width: 100px;
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
      <span>Clientes Cadastrados</span>
      <button onclick="window.print()" id="print-button">Imprimir Relatório</button>
    </div>

    <!-- Formulário de filtragem -->
    <form method="GET" class="filter-form">
      <label for="filtro_id">
        Filtrar por ID:
        <input type="number" id="filtro_id" name="filtro_id" required>
      </label>
      <label for="filtro_data">
        Filtrar por Data de Cadastro:
        <input type="date" id="filtro_data" name="filtro_data">
      </label>
      <label for="filtro_nome">
        Filtrar por Nome:
        <input type="text" id="filtro_nome" name="filtro_nome">
      </label>
      <button type="submit">Filtrar</button>
    </form>

    <div class="divTable">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Nível</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Data de Cadastro</th>
            <th class="acao">Editar</th>
            <th class="acao">Excluir</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Verifica se um ID de filtro, data de filtro ou nome de filtro foi enviado
          $filtro_id = isset($_GET['filtro_id']) ? intval($_GET['filtro_id']) : null;
          $filtro_data = isset($_GET['filtro_data']) ? $_GET['filtro_data'] : null;
          $filtro_nome = isset($_GET['filtro_nome']) ? mysqli_real_escape_string($conexao, $_GET['filtro_nome']) : null;

          // Monta a consulta de acordo com os filtros
          $result_usuarios = "SELECT * FROM usuarios WHERE 1=1";

          if ($filtro_id) {
            $result_usuarios .= " AND id = $filtro_id";
          }

          if ($filtro_data) {
            $result_usuarios .= " AND DATE(data_criacao) = '$filtro_data'";
          }

          if ($filtro_nome) {
            $result_usuarios .= " AND nome LIKE '%$filtro_nome%'";
          }

          $result_usuarios .= " ORDER BY nome ASC";

          $resultado_usuarios = mysqli_query($conexao, $result_usuarios);

          if (mysqli_num_rows($resultado_usuarios) > 0) {
            while ($linha = mysqli_fetch_assoc($resultado_usuarios)) {
              echo "<tr>";
              echo "<td>" . $linha['id'] . "</td>";
              echo "<td>" . $linha['nome'] . "</td>";
              echo "<td>" . $linha['nivel'] . "</td>";
              echo "<td>" . $linha['email'] . "</td>";
              echo "<td>" . $linha['senha'] . "</td>";
              echo "<td>" . date('d/m/Y', strtotime($linha['data_criacao'])) . "</td>";
              echo "<td class='acao'><a href='editarusuario.php?id=" . $linha['id'] . "' class='btn-primary'>Editar</a></td>";
              echo "<td class='acao'><a href='excluir.php?id=" . $linha['id'] . "' class='btn-danger'>Excluir</a></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='8'>Nenhum registro encontrado.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
