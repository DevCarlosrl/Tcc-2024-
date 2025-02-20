<?php
session_start();include "conexao.php";

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

// Verifique se o usuário está logado
$isLoggedIn = isset($_SESSION['usuario']); // chave que usa para identificar o usuário logado

// conectar ao banco de dados
$servername = "localhost";
$username = "root"; // seu nome de usuário
$password = ""; // sua senhas
$dbname = "sistema_login"; // nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recuperar ID do livro da URL
$productId = isset($_GET['id']) ? intval($_GET['id']) : 1; // Padrão para 1 se não houver ID

// Consulta para obter os detalhes do livro
$sql = "SELECT * FROM produtos WHERE id = $productId";
$result = $conn->query($sql);

// Verificar se o livro existe
if ($result->num_rows > 0) {
    // Recuperar os dados do livro
    $product = $result->fetch_assoc();
} else {
    echo "Produto não encontrado.";
    exit;
}

$conn->close();
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/comprar.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" media="screen and (max-device-width: 799px)" />
    <title>Início</title>
    <script>
        function addToCart() {
            const productId = document.getElementById("product-id").value;
            const quantity = document.getElementById("quantity").value;

       
            <?php if (!$isLoggedIn): ?>
                alert("Você precisa estar logado para adicionar produtos ao carrinho.");
                window.location.href = 'login.php'; // Redireciona para a página de login
                return;
            <?php endif; ?>
            // Redireciona para a página carrinho.php com os parâmetros necessários
            window.location.href = `carrinho.php?acao=add&id=${productId}&quantidade=${quantity}`;
        }
    </script>
</head>
<body>
    <header><!--Inicio do Cabeçalho-->
        <nav class="navbar">
            <div class="logo-container">
              <img src="assets/img/EditoraLogo2.png" alt=""><!--Logo-->
            </div>

            <ul class="menu">
              <li><a href="index.php">Início</a></li>
              <li><a href="descubra.php">Descubra</a></li>
              <li><a href="sobre.php">Sobre</a></li>
            </ul>

            <ul class="login">
              <li><a href=""><img src="assets/img/lupa.png" alt=""></a></li>
              <li><a href="carrinho.php"><img src="assets/img/carrinho-de-compras.png" alt=""></i><span class="cart-count">0</span> <!-- Contador de itens --></a></li>
              <span class="cart-count"><?php echo count($_SESSION['carrinho']); ?></span> 
              <div class="profile-dropdown">
                <div onclick="toggle()" class="profile-dropdown-btn">
                  <div class="profile-img">
                  <i class="status-circle"></i>
                            </div>
                            <span>
                               
                  </span>
                </div>
        
                <ul class="profile-dropdown-list">
                  <li class="profile-dropdown-list-item">
                    <a href="#">
                      <i class="fa-regular fa-user"></i>
                      Perfil
                    </a>
                  </li>
        
                  <li class="profile-dropdown-list-item">
                    <a href="#">
                      <i class="fa-regular fa-envelope"></i>
                      Caixa de entrada
                    </a>
                  </li>
        
                  <li class="profile-dropdown-list-item">
                    <a href="#">
                      <i class="fa-solid fa-chart-line"></i>
                      Análises
                    </a>
                  </li>
        
                  <li class="profile-dropdown-list-item">
                    <a href="#">
                      <i class="fa-solid fa-sliders"></i>
                      Configurações 
                    </a>
                  </li>
        
                  <li class="profile-dropdown-list-item">
                    <a href="#">
                      <i class="fa-regular fa-circle-question"></i>
                      Suporte
                    </a>
                  </li>
                  <hr />
        
                  <li class="profile-dropdown-list-item">
                    <a href="#">
                      <i class="fa-solid fa-arrow-right-from-bracket"></i>
                      Login
                    </a>
                  </li>
                </ul>
              </div>
            </ul>
          </nav>
    </header> <!--Fim do Cabeçalho-->

    <div class="body">
        <div class="product-page">
            <div class="image-gallery">
                <div class="thumbnail" ><img id="img1" src="" alt=""></div>
                <div class="thumbnail" ><img id="img2" src="" alt=""></div>
                <div class="thumbnail" ><img id="img3" src="" alt=""></div>
                <div class="thumbnail" ><img id="img4" src="" alt=""></div>
            </div>
            <div class="main-image">
                <img  id="img0" src="" alt="">
            </div>
            <div class="product-details">
                <div class="product-brand" id="Autor">Teste</div>
                <h1 class="product-title" id="Titulo">Teste</h1>
                <div class="product-price">
                    <span id="Preco">$750.00</span> 
                    <span class="original-price" id="OriginalPreco">$980.00</span>
                </div>
                <div class="product-rating" id="Avaliacao">☆☆☆☆☆ | Add review</div>
                <p class="product-description" id="Descricao">
                    Donec vel odio commodo, cursus orci sed, tincidunt mauris. Donec
                    quis mattis dui facilisis. Fusce purus ipsum, accumsan a nisl sollicitudin,
                    sagittis tincidunt justo non porttitor.
                </p>
                <div class="quantity-selector">
                    <input type="hidden" id="product-id" value="<?php echo $product['id']; ?>">
                    <input type="number" class="quantity-input" value="1" min="1" id="quantity">
                    <button class="add-to-cart-button" onclick="addToCart()">Adicionar</button>
                </div>
                <div class="product-actions">
                    <a href="index.php">Volte para o Início</a>
                    <a href="descubra.php">Continue Comprando</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <div class="footer-newsletter">
            <h2>Inscreva-se na nossa Newsletter</h2>
            <p>Assine hoje gratuitamente e economize 10% na sua primeira compra.</p>
            <input type="email" placeholder="Your email">
            <button>SUBSCRIBE</button>
        </div>
        
        <div class="footer-content">
            <div class="footer-column">
                <h3>Navegar</h3>
                <ul>
                    <li><a href="#">Sobre Nós</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contate-nos</a></li>
                    <li><a href="#">Sitemap</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Categorias</h3>
                <ul>
                    <li><a href="#">Novas chegadas</a></li>
                    <li><a href="#">Featured</a></li>
                    <li><a href="#">Catalog</a></li>
                    <li><a href="#">Popular Brands</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Coleção</h3>
                <ul>
                    <li><a href="#">Innovative</a></li>
                    <li><a href="#">Sport</a></li>
                    <li><a href="#">Italian</a></li>
                    <li><a href="#">Gold</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contato</h3>
                <address>
                    Rua Marechal Soares de Andréia, 90 <br>
                    Realengo, Rio de Janeiro<br>
                    hello@sitecompany.co<br>
                    +1-512-758-7589
                </address>
            </div>
        </div>
        <script>
    function addToCart() {
        const productId = document.getElementById("product-id").value;
        const quantity = document.getElementById("quantity").value;

        <?php if (!$isLoggedIn): ?>
            alert("Você precisa estar logado para adicionar produtos ao carrinho.");
            window.location.href = 'login.php';
            return;
        <?php endif; ?>

        // Redireciona para o carrinho com a quantidade especificada
        window.location.href = `carrinho.php?acao=add&id=${productId}&quantidade=${quantity}`;
    }
</script>

        <div class="footer-bottom">
            <p>Copyright © 2024 Editora Transformar. Todos os direitos reservados. </p>
        </div>
    </div>
</body>
<script src="assets/js/compra.js"></script>
<script src="assets/js/script.js"></script>
<script>
        function addToCart() {
    const productId = document.getElementById("product-id").value;
    const quantity = document.getElementById("quantity").value;

    <?php if (!$isLoggedIn): ?>
        alert("Você precisa estar logado para adicionar produtos ao carrinho.");
        window.location.href = 'login.php'; // Redireciona para a página de login
        return;
    <?php endif; ?>

    // Redireciona para a página carrinho.php com os parâmetros necessários
    window.location.href = `carrinho.php?acao=add&id=${productId}&quantidade=${quantity}`;
}

    </script>
</html>
