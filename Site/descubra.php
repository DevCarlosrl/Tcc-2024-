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
    <link rel="stylesheet" href="assets/css/descubra.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" media="screen and (max-device-width: 799px)" />
    <title>Descubra</title>
    
</head>
<body>
    <header><!--Inicio do Cabeçalho-->
        
        <nav class="navbar">
            <div class="logo-container">
              <img src="assets/img/EditoraLogo.png" alt=""><!--Logo-->
            </div>

            <ul class="menu">
              <li><a href="index.php">Início</a></li>
              <li><a href="#">Descubra</a></li>
              <li><a href="sobre.php">Sobre</a></li>
            </ul>

            <ul class="login">
              <li><a href=""><img src="assets/img/procurar-bege.png" alt=""></a></li>
              <li><a href="carrinho.php"><img src="assets/img/carrinho-de-compras-bege.png" alt=""></i><span class="cart-count">0</span> <!-- Contador de itens --></a></li>
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
    <div class="img_container"></div>
    <div class="container">
      <aside class="sidebar">
        <h3>Filtrar Livros</h3>
        
        <!-- Campo de busca por nome -->
        <label for="search">Busca por Nome</label>
        <input type="text" id="search" placeholder="Digite o nome do livro">

        <label for="author">Busca por Autor</label>
        <input type="text" id="author" placeholder="Digite o nome do autor">
        
        <h3>Lançamentos</h3>
    <select id="new-release">
        <option value="">Todos</option>
        <option value="true">Lançamentos</option>
        <option value="false">Não são lançamentos</option>
    </select>

    <h3>Promoção</h3>
    <select id="on-sale">
        <option value="">Todos</option>
        <option value="true">Em Promoção</option>
        <option value="false">Sem Promoção</option>
    </select>

        <!-- Filtro de Gêneros -->
        <h3>Gêneros</h3>
        <div class="checkbox-group">
            <label><input type="checkbox" name="genre" value="Ficçao"><span>Ficção</span></label>
            <label><input type="checkbox" name="genre" value="Suspense"> <span>Suspense</span></label>
            <label><input type="checkbox" name="genre" value="Romance"> <span>Romance</span></label>
            <label><input type="checkbox" name="genre" value="Fantasia"> <span>Fantasia</span></label>
            <label><input type="checkbox" name="genre" value="Aventura"> <span>Aventura</span></label>
            <label><input type="checkbox" name="genre" value="História"> <span>História</span></label>
            <label><input type="checkbox" name="genre" value="Mangá"> <span>Mangá</span></label>
            <label><input type="checkbox" name="genre" value="Infantil"> <span>Infantil</span></label>
            <label><input type="checkbox" name="genre" value="Biografia"> <span>Biografia</span></label>
            <label><input type="checkbox" name="genre" value="Quadrinhos"> <span>Quadrinhos</span></label>
            <label><input type="checkbox" name="genre" value="Fantasia"> <span>Fantasia</span></label>
            <label><input type="checkbox" name="genre" value="Terror"> <span>Terror</span></label>
            <label><input type="checkbox" name="genre" value="Crônicas"> <span>Crônicas</span></label>
            <label><input type="checkbox" name="genre" value="Drama"> <span>Drama</span></label>
        </div>
        
        <!-- Filtro de Faixa de Preço -->
        <h3>Faixa de Preço</h3>
        <label for="price-min">Preço Mínimo</label>
        <input type="number" id="price-min" placeholder="R$ 0" min="0" max="1000">
        
        <label for="price-max">Preço Máximo</label>
        <input type="number" id="price-max" placeholder="R$ 1000"  min="0" max="1000">
        
        <button id="filter-button">Aplicar Filtros</button>
        <button id="reset-button">Resetar Filtros</button>
    </aside>
        <div class="products">
            <h2>Todos os produtos
            </h2>
            <div class="product-grid">
                <div class="product-card" data-genre="Romance" data-price="R$43,00" data-author="Beth O’Leary" data-sale="true">
                    <a href="comprar.php?id=1">
                        <img src="https://m.media-amazon.com/images/I/41OFW3DDZQL._SY445_SX342_.jpg" alt="Product Image">
                        <div class="product-card-content">
                            <h3 class="product-card-title">Um amor cinco estrelas</h3>
                            <div class="product-card-price">R$43,00 <span class="product-card-old-price">R$50,40</span></div>
                        </div>
                    </a>
                </div>

                <div class="product-card" data-genre="Romance" data-author="Jane Austen">
                    <a href="comprar.php?id=2">
                      <img src="https://m.media-amazon.com/images/I/51lC3sHYyML._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">Orgulho e Preconceito</h3>
                          <div class="product-card-price">R$39,00</div>
                      </div>
                    </a>
                </div>

                <div class="product-card" data-genre="Romance" data-author="Colleen Hoover">
                    <a href="comprar.php?id=3">
                      <img src="https://m.media-amazon.com/images/I/51i7kH+rh9L._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">É Assim que Acaba</h3>
                          <div class="product-card-price">R$36,02</div>
                      </div>
                    </a>
                </div>
                
                <div class="product-card" data-genre="Mangá" data-author="Sano Yuuto">
                    <a href="comprar.php?id=4">
                      <img src="https://m.media-amazon.com/images/I/61CFV6diVeL._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">Gokurakugai </h3>
                          <div class="product-card-price">R$35,90</div>
                      </div>
                    </a>
                </div>

                <div class="product-card" data-genre="Mangá"  data-author="Rokurou Ogaki">
                    <a href="comprar.php?id=5">
                      <img src="https://m.media-amazon.com/images/I/51UeuDARMsL._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">Crazy Food Truck</h3>
                          <div class="product-card-price">R$69,90</div>
                      </div>
                    </a>
                </div>

                <div class="product-card" data-genre="História" data-author="Martha Hall Kelly">
                    <a href="comprar.php?id=6" >
                      <img src="https://m.media-amazon.com/images/I/518Ekt4hFtL._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">Mulheres sem nome</h3>
                          <div class="product-card-price">R$14,07</div>
                      </div>
                    </a>
                </div>

                <div class="product-card" data-genre="História" data-author="Emilia Viotti">
                    <a href="comprar.php?id=7"  >
                      <img src="https://m.media-amazon.com/images/I/51jXUroAsAL._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">A abolição</h3>
                          <div class="product-card-price">R$36,58</div>
                      </div>
                    </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="Mariana Enriquez">
                    <a href="comprar.php?id=8">
                      <img src="https://m.media-amazon.com/images/I/81ipM1rerRL._SY425_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">Este É O Mar</h3>
                          <div class="product-card-price">R$40,00</div>
                      </div>
                    </a>
                </div>

                <div class="product-card" data-genre="História"  data-author="R. C. Sproul">
                    <a href="comprar.php?id=9">
                      <img src="https://m.media-amazon.com/images/I/51-1ppW+V0L._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">O legado de Lutero </h3>
                          <div class="product-card-price">R$70,00</div>
                      </div>
                    </a>
                </div>

                <div class="product-card" data-genre="Infantil" data-author="Dav Pilkey">
                  <a href="comprar.php?id=10">
                    <img src="https://m.media-amazon.com/images/I/51oqtsPW3hL._SY445_SX342_.jpg" alt="Product Image">
                    <div class="product-card-content">
                      <h3 class="product-card-title">O Homem-Cão: Imundície e castigo</h3>
                      <div class="product-card-price">R$35,00</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Romance" data-author="Fiódor Dostoiévski">
                    <a href="comprar.php?id=11">
                      <img src="https://m.media-amazon.com/images/I/31mjUV-3MVS._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">O idiota</h3>
                          <div class="product-card-price">R$56,19</div>
                      </div>
                    </a>
                  </div>

                <div class="product-card" data-genre="Biografia" data-author="Anne Frank">
                    <a href="comprar.php?id=12" >
                      <img src="https://m.media-amazon.com/images/I/41+PZUZS7LL._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">O diário de Anne Frank</h3>
                          <div class="product-card-price">R$15,00</div>
                      </div>
                    </a>
                  </div>

                <div class="product-card" data-genre="Mangá" data-author="Koyoharu Gotouge">
                    <a href="comprar.php?id=13">
                      <img src="https://m.media-amazon.com/images/I/61Io09gb90L._SY425_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">Demon Slayer: Academia</h3>
                          <div class="product-card-price">R$35,90</div>
                      </div>
                    </a>
                  </div>

                <div class="product-card" data-genre="Quadrinhos" data-author="Ian Flynn">
                    <a href="comprar.php?id=14">
                      <img src="https://m.media-amazon.com/images/I/91RcGOBaU3L._SY425_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">Sonic The Hedgehog: Cidade em crise</h3>
                          <div class="product-card-price">R$47,49</div>
                      </div>
                    </a>
                  </div>

                <div class="product-card" data-genre="Mangá" data-author="Yusuke Nomura">
                    <a href="comprar.php?id=15" >
                      <img src="https://m.media-amazon.com/images/I/61Ds6t9A2TL._SY425_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">Blue Lock Vol. 23</h3>
                          <div class="product-card-price">R$35,90</div>
                      </div>
                    </a>
                  </div>

                <div class="product-card" data-genre="Mangá" data-author="Eiichiro Oda">
                    <a href="comprar.php?id=16" >
                      <img src="https://m.media-amazon.com/images/I/51zPKHupwGL._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">One Piece Vol. 1</h3>
                          <div class="product-card-price">R$27,63</div>
                      </div>
                    </a>
                  </div>

                <div class="product-card" data-genre="Ficção" data-author="L. Frank Baum">
                    <a href="comprar.php?id=17" >
                      <img src="https://m.media-amazon.com/images/I/518xcvEcOFL._SY445_SX342_.jpg" alt="Product Image">
                      <div class="product-card-content">
                          <h3 class="product-card-title">O mágico de Oz</h3>
                          <div class="product-card-price">R$50,12</div>
                      </div>
                    </a>
                  </div>

                  <div class="product-card" data-genre="Romance" data-author="Machado de Assis" data-sale="true">
                    <a href="comprar.php?id=18" >
                        <img src="https://m.media-amazon.com/images/I/61Z2bMhGicL._SY425_.jpg" alt="Product Image">
                        <div class="product-card-content">
                            <h3 class="product-card-title">Dom Casmurro</h3>
                            <div class="product-card-price">R$17,68 <span class="product-card-old-price">R$24,90</span></div>
                        </div>
                    </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="Machado de Assis">
                  <a href="comprar.php?id=19">
                    <img src="https://m.media-amazon.com/images/I/41ls0DpJwOL._SY445_SX342_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">O Alienista</h3>
                        <div class="product-card-price">R$14,13</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Fantasia" data-author="BJ.R.R. Tolkien">
                  <a href="comprar.php?id=20">
                    <img src="https://m.media-amazon.com/images/I/511+-lOOtsL._SY445_SX342_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">O Hobbit</h3>
                        <div class="product-card-price">R$43,76</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Terror" data-author="Stephen King">
                  <a href="comprar.php?id=21">
                    <img src="https://m.media-amazon.com/images/I/51z0s3GcvwL._SY445_SX342_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">It: A Coisa</h3>
                        <div class="product-card-price">R$78,99</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Suspense" data-author="C. J. Tudor">
                  <a href="comprar.php?id=22">
                    <img src="https://m.media-amazon.com/images/I/414ONi-RmLL._SY445_SX342_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">O Homem de Giz</h3>
                        <div class="product-card-price">R$65,00</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Fantasia" data-author="Patrick Rothfuss">
                  <a href="comprar.php?id=23">
                    <img src="https://m.media-amazon.com/images/I/81CGmkRG9GL._SY425_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">O Nome do Vento</h3>
                        <div class="product-card-price">R$49,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Fantasia" data-author="Frank Herbert">
                  <a href="comprar.php?id=24">
                    <img src="https://m.media-amazon.com/images/I/41MRn6hy8-L._SY445_SX342_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">Duna</h3>
                        <div class="product-card-price">R$69,33</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="George Orwell" data-sale="true">
                  <a href="comprar.php?id=25">
                    <img src="https://m.media-amazon.com/images/I/819js3EQwbL._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">1984</h3>
                        <div class="product-card-price">R$39,90 <span class="product-card-old-price">R$49.90</span></div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Romance" data-author="F. Scott Fitzgerald">
                  <a href="comprar.php?id=26">
                    <img src="https://m.media-amazon.com/images/I/71+G89dpO4L._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">O Grande Gatsby</h3>
                        <div class="product-card-price">R$44,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="Franz Kafka">
                  <a href="comprar.php?id=27">
                    <img src="https://m.media-amazon.com/images/I/715JOcuqSSL._SL1021_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">A Metamorfose</h3>
                        <div class="product-card-price">R$29,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="Gabriel García Márquez">
                  <a href="comprar.php?id=28">
                    <img src="https://m.media-amazon.com/images/I/817esPahlrL._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">Cem Anos de Solidão</h3>
                        <div class="product-card-price">R$49,90</div>
                    </div>
                  </a>
                </div>
                
                <div class="product-card" data-genre="Ficção" data-author="Harper Lee">
                  <a href="comprar.php?id=29">
                    <img src="https://m.media-amazon.com/images/I/91WKPd60P4L._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">O Sol é para Todos</h3>
                        <div class="product-card-price">R$34,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="George Orwell">
                  <a href="comprar.php?id=30">
                    <img src="https://m.media-amazon.com/images/I/81DBKwEXkFL._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">A Revolução dos Bichos</h3>
                        <div class="product-card-price">R$29,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="Mary Shelley">
                  <a href="comprar.php?id=31">
                    <img src="https://m.media-amazon.com/images/I/91Kz+sC5X0L._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">Frankenstein</h3>
                        <div class="product-card-price">R$29,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="Alice Walker">
                  <a href="comprar.php?id=32">
                    <img src="https://m.media-amazon.com/images/I/719J3+g-GuL._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">A Cor Púrpura</h3>
                        <div class="product-card-price">R$42,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Fantasia" data-author="J.R.R. Tolkien">
                  <a href="comprar.php?id=33">
                    <img src="https://m.media-amazon.com/images/I/81hCVEC0ExL._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                      <h3 class="product-card-title">O Senhor dos Anéis: A Sociedade do Anel</h3>
                      <div class="product-card-price">R$59,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="Franz Kafka">
                  <a href="comprar.php?id=34">
                    <img src="https://m.media-amazon.com/images/I/61rHTFLIceL._SL1000_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">O Processo</h3>
                        <div class="product-card-price">R$34,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="Carlos Ruiz Zafón">
                  <a href="comprar.php?id=35">
                    <img src="https://m.media-amazon.com/images/I/91xOzA3VHtL._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">A Sombra do Vento</h3>
                        <div class="product-card-price">R$54,90</div>
                    </div>
                  </a>
                </div>

                <div class="product-card" data-genre="Ficção" data-author="Michael Ende">
                  <a href="comprar.php?id=36">
                    <img src="https://m.media-amazon.com/images/I/71X-YY3HIjL._SL1500_.jpg" alt="Product Image">
                    <div class="product-card-content">
                        <h3 class="product-card-title">A História Sem Fim </h3>
                        <div class="product-card-price">R$49,90</div>
                    </div>
                  </a>
                </div>

                  <div class="product-card" data-genre="Crônicas" data-author="Fabio Viccent" data-new="true">
                      <a href="comprar.php?id=37">
                        <div class="product-card-new">Novo</div>
                        <img src="https://acdn.mitiendanube.com/stores/001/018/983/products/whatsapp-image-2020-05-31-at-18-50-291-567faf02c9da72890815909627636200-1024-1024.webp" alt="Product Image">
                        <div class="product-card-content">
                            <h3 class="product-card-title">Com Amor, Clara</h3>
                            <div class="product-card-price">R$49,90</div>
                        </div>
                      </a>
                  </div>

                  <div class="product-card" data-genre="Crônicas" data-author="Fabio Viccent" data-new="true">
                      <a href="comprar.php?id=38">
                        <div class="product-card-new">Novo</div>
                        <img src="https://acdn.mitiendanube.com/stores/001/018/983/products/whatsapp-image-2021-03-23-at-20-03-161-b9673b4dd75b55c3c416165414220481-1024-1024.webp" alt="Product Image">
                        <div class="product-card-content">
                            <h3 class="product-card-title">Seja Livre</h3>
                            <div class="product-card-price">R$38,00</div>
                        </div>
                      </a>
                  </div>

                  <div class="product-card" data-genre="Crônicas" data-author="Fabio Viccent" data-new="true">
                      <a href="comprar.php?id=39">
                        <div class="product-card-new">Novo</div>
                        <img src="assets/img/Livros_Fabio/Diva_do_cotidiano.jpeg" alt="Product Image">
                        <div class="product-card-content">
                            <h3 class="product-card-title">Diva do Cotidiano</h3>
                            <div class="product-card-price">R$28,00</div>
                        </div>
                      </a>
                  </div>

                  <div class="product-card" data-genre="Drama" data-author="Daniel Lamarão" data-new="true">
                      <a href="comprar.php?id=40">
                        <div class="product-card-new">Novo</div>
                        <img src="assets/img/Livro_Editora/Frente.jpeg" alt="Product Image">
                        <div class="product-card-content">
                            <h3 class="product-card-title">Entre a Realidade e o Perdão</h3>
                            <div class="product-card-price">R$48,00</div>
                        </div>
                      </a>
                  </div>
                    <!-- Add more product cards as needed -->
                 
            </div>
        </div>
    </div>
  
<div class="footer">
  <div class="footer-newsletter">
      <h2>Inscreva-se na nossa Newsletter</h2>
      <p></p>
      <input type="email" placeholder="Your email">
      <button>Inscreva-se</button>
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

  <style>
        /* Animação ao passar o mouse nos produtos */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-8px); /* Leve elevação */
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2); /* Sombra suave */
        }
    </style>



  <div class="footer-bottom">
      <p>Copyright © 2024 Editora Transformar. Todos os direitos reservados. </p>
    
  </div>
</div>

</body>
<script src="assets/js/script.js"></script>
<script src="assets/js/descubra.js"></script>