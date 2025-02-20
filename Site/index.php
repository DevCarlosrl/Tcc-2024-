<?php
session_start();include "conexao.php";

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" media="screen and (max-device-width: 799px)" />
    <title>Início</title>
    
</head>
<body>
    <header><!--Inicio do Cabeçalho-->
        
    <nav class="navbar">
            <div class="logo-container">
                <img src="assets/img/EditoraLogo.png" alt="Logo">
            </div>
            <ul class="menu">
                <li><a href="#">Início</a></li>
                <li><a href="descubra.php">Descubra</a></li>
                <li><a href="sobre.php">Sobre</a></li>
            </ul>
            <ul class="login">
                <li><a href="#"><img src="assets/img/procurar-bege.png" alt="Pesquisar"></a></li>
               <li><a href="carrinho.php"><img src="assets/img/carrinho-de-compras-bege.png" alt="Carrinho"><span class="cart-count">0</span></a></li>
               <span class="cart-count"><?php echo count($_SESSION['carrinho']); ?></span> 
               <div class="profile-dropdown">
                    <div onclick="toggle()" class="profile-dropdown-btn">
                        <div class="profile-img">
                    <i class="status-circle <?php echo isset($_SESSION['usuario']) ? 'logged-in' : ''; ?>"></i>
                        </div>
						  <span>
                                <?php 
                                echo isset($_SESSION['usuario']) ? 'Logado' : 'Login'; 
                                ?>
                                <i class="fa-solid fa-angle-down"></i>
                            </span>

                    </div>
                    <ul class="profile-dropdown-list">
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <li class="profile-dropdown-list-item">
                           <a href="<?php echo ($_SESSION['nivel'] === 'admin') ? 'dashboard.php' : 'perfil.php'; ?>">
                                    <i class="fa-regular fa-user"></i>
                                    Perfil
                                </a>
                            </li>
                            <li class="profile-dropdown-list-item">
                                <a href="logout.php">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Sair
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="profile-dropdown-list-item">
                                <a href="login.php">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Login
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </ul>
        </nav>
    </header> <!--Fim do Cabeçalho-->
    <div class="container">
      <div class="container_left"> 
        <div class="informacao">
          <h5>📚EM BREVE! O tão esperado lançamento de</h5>
          <h2>Entre a Realidade e o Perdão</h2>
          <p>"Entre a Realidade e o Perdão" acompanha a história de Ethan, um jovem que, após ter um sonho intenso e inquietante, começa a revisitar memórias esquecidas de sua infância. Assombrado por sensações de perda e mistério, ele percebe que há algo importante escondido em seu passado que foi suprimido. 
          </p>
           <a href="comprar.php?id=40">Saiba Mais</a>
        </div>
      </div>
      <div class="container_rigth">
        <div class="informacao">
          <img src="assets/img/Livro_Editora/Frente.jpeg" alt="" id="livro_frente">
          <img src="assets/img/Livro_Editora/Verso.jpeg" alt="" id="livro_verso">
      </div>
    </div>
    </div>


  <div class="featured-container">
    <div class="featured-header">
        <h2>Tópicos em destaque</h2>
        <a href="descubra.php">Mostrar tudo
        </a>
    </div>
    <div class="featured-topics">
        <div class="topic-card">
                <a href="comprar.php?id=1" >
                <img src="https://m.media-amazon.com/images/I/41OFW3DDZQL._SY445_SX342_.jpg" alt="Um amor cinco estrelas">
                <h3>Um amor cinco estrelas</h3>
                <p>Por Beth O’Leary
                </p>
        </a>
        </div>
        <div class="topic-card">
            <a href="comprar.php?id=2">
                <img src="https://m.media-amazon.com/images/I/51lC3sHYyML._SY445_SX342_.jpg" alt="Orgulho e preconceito">
                <h3>Orgulho e preconceito</h3>
                <p>Por Jane Austen</p>
            </a>
        </div>
        <div class="topic-card">
            <a href="comprar.php?id=3">
                <img src="https://m.media-amazon.com/images/I/51i7kH+rh9L._SY445_SX342_.jpg" alt="É Assim que Acaba">
                <h3>É Assim que Acaba</h3>
                <p> Por Colleen Hoover</p>
            </a>
        </div>
        <div class="topic-card">
            <a href="comprar.php?id=4">
                <img src="https://m.media-amazon.com/images/I/61CFV6diVeL._SY445_SX342_.jpg" alt="Coffee Machine">
                <h3>Gokurakugai</h3>
                <p>Por Sano Yuuto</p>
            </a>
        </div>
    </div>
  </div>
  
  <div class="all_container">
    <h1>Tópicos com desconto
    </h1>
   <!--  <div class="menu">
        <a href="#" class="active">Accessories</a>
        <a href="#">Clothing</a>
        <a href="#">Decor</a>
        <a href="#">Hoodies</a>
        <a href="#">Music</a>
        <a href="#">T-Shirts</a>
      </div>
-->
    <div class="products">
        <div class="product">
            <a href="comprar.php?id=5">
                <img src="https://m.media-amazon.com/images/I/51UeuDARMsL._SY445_SX342_.jpg" alt="Crazy Food Truck">
                <h3>Crazy Food Truck</h3>
                <span class="old-price">R$69,00</span>
                <span class="new-price">R$43,03</span>
            </a>
        </div>
        <div class="product">
            <a href="comprar.php?id=6">
                <img src="https://m.media-amazon.com/images/I/518Ekt4hFtL._SY445_SX342_.jpg" alt="Mulheres sem nome">
                <h3>Mulheres sem nome</h3>
                <span class="new-price">R$14,04</span>
            </a>
        </div>
        <div class="product">
            <a href="comprar.php?id=7">
                <img src="https://m.media-amazon.com/images/I/51jXUroAsAL._SY445_SX342_.jpg" alt="A abolição">
                <h3>A abolição</h3>
                <span class="old-price">R$54,00</span>
                <span class="new-price">R$36,58</span>
            </a>
        </div>
        <div class="product">
            <a href="comprar.php?id=8">
                <img src="https://m.media-amazon.com/images/I/81ipM1rerRL._SY425_.jpg" alt="Este é o mar " >
                <h3>Este é o mar </h3>
                <span class="new-price">R$10,00</span>
            </a>
        </div>
        <a href="comprar.php?id=9">
            <div class="product">
                <img src="https://m.media-amazon.com/images/I/51-1ppW+V0L._SY445_SX342_.jpg" alt="O legado de Lutero Sleeve Tee">
                <h3>O legado de Lutero</h3>
                <span class="new-price">R$70,00</span>
        </a>
        </div>

        <div class="product">
            <a href="comprar.php?id=10">
                <img src="https://m.media-amazon.com/images/I/51oqtsPW3hL._SY445_SX342_.jpg" alt="O Homem-Cão: Imundície e castigo">
                <h3>O Homem-Cão</h3>
                <span class="old-price">R$45.00</span>
                <span class="new-price">R$35.00</span>
            </a>
        </div>

        <div class="product">
            <a href="comprar.php?id=11">
                <img src="https://m.media-amazon.com/images/I/31mjUV-3MVS._SY445_SX342_.jpg" alt="O idiota">
                <h3>O idiota</h3>
                <span class="old-price">R$89,00</span>
                <span class="new-price">R$56,19</span>
            </a>
        </div>
        <div class="product">
            <a href="comprar.php?id=12">
                <img src="https://m.media-amazon.com/images/I/41+PZUZS7LL._SY445_SX342_.jpg" alt="O diário de Anne Frank">
                <h3>O diário de Anne Frank</h3>
                <span class="new-price">R$15.00</span>
                        </div>
            </a>
    
    </div>
</div>

<section class="banner">
  <div class="discount">%</div>
  <div class="content">
      <h2>Ofertas em ótimas leituras para 2024
      </h2>
      <p>O mais novo segmento de romance do autor por trás de The Winds Between Us nos apresenta Jessica Fenix.</p>
      <a href="descubra.php" class="btn">Veja Mais</a>
  </div>
</section>


<div class="featured-container">
  <div class="featured-header">
      <h2>HQs, Mangás e Graphic Novels
      </h2>
      <a href="descubra.php">Mostrar tudo
      </a>
  </div>
  <div class="featured-topics">
      <div class="topic-card">
              <a href="comprar.php?id=13">
                  <img src="https://m.media-amazon.com/images/I/61Io09gb90L._SY425_.jpg" alt="Demon Slayer: Academia">
                  <h3>Demon Slayer: Academia</h3>
                  <p>por Koyoharu Gotouge</p>
              </a>
      </div>
      <div class="topic-card">
          <a href="comprar.php?id=14">
              <img src="https://m.media-amazon.com/images/I/91RcGOBaU3L._SY425_.jpg" alt="Sonic The Hedgehog ">
              <h3>Sonic The Hedgehog </h3>
              <p>por Ian Flynn </p>
          </a>
      </div>
      <div class="topic-card">
          <a href="comprar.php?id=15">
              <img src="https://m.media-amazon.com/images/I/61Ds6t9A2TL._SY425_.jpg" alt="Blue Lock">
              <h3>Blue Lock Vol. 23</h3>
              <p>por Yusuke Nomura </p>
          </a>
      </div>
      <div class="topic-card">
          <a href="comprar.php?id=16">
              <img src="https://m.media-amazon.com/images/I/51zPKHupwGL._SY445_SX342_.jpg" alt="One Piece ">
              <h3>One Piece Vol. 1</h3>
              <p>por Eiichiro Oda</p>
          </a>
      </div>
  </div>
</div>

<div class="featured-container">
  <div class="featured-header">
          <h2>Literatura e Ficção</h2>
          <a href="descubra.php">Mostrar tudo
      </a>
  </div>
  <div class="featured-topics">
      <div class="topic-card">
          <a href="comprar.php?id=17">
              <img src="https://m.media-amazon.com/images/I/518xcvEcOFL._SY445_SX342_.jpg" alt="O mágico de Oz ">
              <h3>O mágico de Oz </h3>
              <p>por L. Frank Baum</p>
          </a>
      </div>
      <div class="topic-card">
          <a href="comprar.php?id=18">
              <img src="https://m.media-amazon.com/images/I/61Z2bMhGicL._SY425_.jpg" alt="Dom Casmurro">
              <h3>Dom Casmurro</h3>
              <p>por Machado de Assis</p>
          </a>
      </div>
      <div class="topic-card">
          <a href="comprar.php?id=19">
              <img src="https://m.media-amazon.com/images/I/41ls0DpJwOL._SY445_SX342_.jpg" alt="O Alienista">
              <h3>O Alienista</h3>
              <p>por Machado de Assis</p>
          </a>
      </div>
      <div class="topic-card">
          <a href="comprar.php?id=20">
              <img src="https://m.media-amazon.com/images/I/511+-lOOtsL._SY445_SX342_.jpg" alt="O Hobbit ">
              <h3>O Hobbit</h3>
              <p>por J.R.R. Tolkien </p>
          </a>
      </div>
  </div>
</div>

<div class="featured-container">
  <div class="featured-header">
      <h2>Fantasia, Horror e Ficção Científica
      </h2>
      <a href="descubra.php">Mostrar tudo
      </a>
  </div>
  <div class="featured-topics">
      <div class="topic-card">
          <a href="comprar.php?id=21">
              <img src="https://m.media-amazon.com/images/I/51z0s3GcvwL._SY445_SX342_.jpg" alt="It: A coisa">
              <h3>It: A coisa</h3>
              <p>por Stephen King</p>
          </a>
      </div>
      <div class="topic-card">
          <a href="comprar.php?id=22">
              <img src="https://m.media-amazon.com/images/I/414ONi-RmLL._SY445_SX342_.jpg" alt="O homem de giz">
              <h3>O homem de giz</h3>
              <p>por C. J. Tudor </p>
          </a>

      </div>
      <div class="topic-card">
          <a href="comprar.php?id=23">
              <img src="https://m.media-amazon.com/images/I/81CGmkRG9GL._SY425_.jpg" alt="Office Chair">
              <h3>O nome do vento </h3>
              <p>por Patrick Rothfuss </p>
          </a>
      </div>
      <div class="topic-card">
          <a href="comprar.php?id=24">
              <img src="https://m.media-amazon.com/images/I/41MRn6hy8-L._SY445_SX342_.jpg" alt="Duna">
              <h3>Duna</h3>
              <p>por Frank Herbert</p>
          </a>
      </div>
  </div>
</div>
  
<div class="footer">
  <div class="footer-newsletter">
      <h2>Inscreva-se na nossa Newsletter</h2>
      <p></p>
      <input type="email" placeholder="Your email">
      <button>SUBSCRIBE</button>
  </div>

  <div class="footer-content">
      <div class="footer-column">
          <h3>Navegar</h3>
          <ul>
              <li><a href="#">Sobre Nós</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Contate-nos
              </a></li>
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

  <div class="footer-bottom">
      <p>Copyright © 2024 Editora Transformar. Todos os direitos reservados. </p>
    
  </div>
</div>

</body>
<script src="assets/js/script.js"></script>
