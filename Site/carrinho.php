<?php
session_start();
include "conexao.php";

// Inicializa o carrinho, caso não exista
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

// Verifica se o usuário está logado e define a variável $usuario
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} else {
    $usuario = "Visitante";  // Defina um valor padrão caso o usuário não esteja logado
}

// Lógica do carrinho
if (isset($_GET['acao'])) {
    if ($_GET['acao'] == 'add') {
        $id = intval($_GET['id']);
        $quantidade = isset($_GET['quantidade']) ? intval($_GET['quantidade']) : 1;

        if (!isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = $quantidade;
        } else {
            $_SESSION['carrinho'][$id] += $quantidade;
        }
    }

    if ($_GET['acao'] == 'del') {
        $id = intval($_GET['id']);
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    if ($_GET['acao'] == 'clear') {
        $_SESSION['carrinho'] = array();
    }

    if ($_GET['acao'] == 'up') {
        if (isset($_POST['prod']) && is_array($_POST['prod'])) {
            foreach ($_POST['prod'] as $id => $qtd) {
                $id = intval($id);
                $qtd = intval($qtd);
                if (!empty($qtd) && $qtd != 0) {
                    $_SESSION['carrinho'][$id] = $qtd;
                } else {
                    unset($_SESSION['carrinho'][$id]);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="assets/css/carrinho.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <nav class="navbar_carrinho">
            <div class="logo-container">
                <img src="assets/img/EditoraLogo2.png" alt="Logo">
            </div>
            <ul class="menu_carrinho">
                <li><a href="index.php">Início</a></li>
                <li><a href="descubra.php">Descubra</a></li>
                <li><a href="sobre.php">Sobre</a></li>
            </ul>
            <ul class="login_">
                <li><a href="#"><img src="assets/img/lupa.png" alt=""></a></li>
                <li>
                    <a href="#">
                        <img src="assets/img/carrinho-de-compras.png" alt="">
                        <span class="cart-count"><?php echo count($_SESSION['carrinho']); ?></span>
                    </a>
                </li>
                <div class="profile-dropdown">
                    <div onclick="toggle()" class="profile-dropdown-btn">
                        <div class="profile-img">
                            <i class="status-circle <?php echo isset($_SESSION['usuario']) ? 'logged-in' : ''; ?>"></i>
                        </div>
                        <span>
                            <?php echo isset($_SESSION['usuario']) ? 'Logado' : 'Login'; ?>
                        </span>
                    </div>
                    <ul class="profile-dropdown-list">
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <li class="profile-dropdown-list-item"><a href="perfil.php"><i class="fa-regular fa-user"></i> Perfil</a></li>
                            <li class="profile-dropdown-list-item"><a href="#"><i class="fa-regular fa-envelope"></i> Caixa de entrada</a></li>
                            <li class="profile-dropdown-list-item"><a href="#"><i class="fa-solid fa-chart-line"></i> Análises</a></li>
                            <li class="profile-dropdown-list-item"><a href="#"><i class="fa-solid fa-sliders"></i> Configurações</a></li>
                            <li class="profile-dropdown-list-item"><a href="#"><i class="fa-regular fa-circle-question"></i> Suporte</a></li>
                            <hr />
                            <li class="profile-dropdown-list-item"><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sair</a></li>
                        <?php else: ?>
                            <li class="profile-dropdown-list-item"><a href="login.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </ul>
        </nav>
    </header>

    <main>
        <div class="page-title">Seu Carrinho</div>
        <div class="content">
            <section>
                <form name="form1" id="form1" method="post" action="?acao=up">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Total</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($_SESSION['carrinho']) == 0) {
                                echo '<tr><td colspan="5">NÃO HÁ PRODUTO NO CARRINHO</td></tr>';
                                $total = 0;
                            } else {
                                $total = 0;
                                foreach ($_SESSION['carrinho'] as $id => $qtd) {
                                    $sql = "SELECT * FROM produtos WHERE id='$id'";
                                    $qr = mysqli_query($conexao, $sql);
                                    $ln = mysqli_fetch_assoc($qr);

                                    if ($ln) {
                                        $nome_produtos = $ln['nome'];
                                        $preco = number_format($ln['preco'], 2, ",", ".");
                                        $sub = number_format($ln['preco'] * $qtd, 2, ',', '.');
                                        $total += ($ln['preco'] * $qtd);
                                        $imagem = $ln['imagem'];

                                        echo "<tr>
                                                <td>
                                                    <div class='product'>
                                                        <img src='$imagem' alt='$nome_produtos' class='product-image'>
                                                        <div class='info'>
                                                            <div class='name'>$nome_produtos</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>R$ $preco</td>
                                                <td><input type='number' name='prod[$id]' value='$qtd' min='1' class='form-control'></td>
                                                <td>R$ $sub</td>
                                                <td><a href='?acao=del&id=$id' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a></td>
                                            </tr>";
                                    }
                                }
                                echo "<tr>
                                        <td colspan='3'><strong>TOTAL</strong></td>
                                        <td colspan='2'><strong>R$ " . number_format($total, 2, ',', '.') . "</strong></td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <button type="submit" class="btn btn-custom">Atualizar Carrinho</button>
                                    <a href="?acao=clear" class="btn btn-warning">Apagar Tudo</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5"><a href="index.php" class="btn btn-link">Continuar Comprando</a></td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </section>
            <aside>
                <div class="box">
                    <header>Resumo da compra</header>
                    <div class="info">
                        <div><span>Sub-total</span><span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span></div>
                        <div><span>Frete</span><span>Gratuito</span></div>
                    </div>
                    <footer>
                        <span>Total</span>
                        <span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                    </footer>
                </div>
                <form action="processa_pedido.php" method="post">
                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                    <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
                    <button type="submit" class="btn btn-primary">Finalizar Compra</button>
                    <a href="aluguel.php" class="btn btn-secondary">Alugar Produto</a>
                </form>
            </aside>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
