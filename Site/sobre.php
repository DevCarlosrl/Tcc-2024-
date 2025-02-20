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
    <link rel="stylesheet" href="assets/css/sobre.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" media="screen and (max-device-width: 799px)" />
    <title>Sobre</title>
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
          <li><a href="#">Sobre</a></li>
        </ul>

        <ul class="login">
          <li><a href=""><img src="assets/img/lupa.png" alt=""></a></li>
          <li><a href="carrinho.php"><img src="assets/img/carrinho-de-compras.png" alt=""></i><span class="cart-count">0</span> <!-- Contador de itens --></a></li>
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
              <li class="profile-dropdown-list-item">
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
<section class="section hero" id="home" aria-label="home">
    <div class="container">

      <div class="hero-content">

        <p class="section-subtitle">INVISTA NO FUTURO COM A GENTE</p>

        <h1 class="h1 hero-title">Saiba mais sobre a nossa Empresa
        </h1>

        <p class="section-text">
          Conheça a nossa equipe.
        </p>

      </div>

      <div class="hero-banner has-before">
        <img src="https://viverdeblog.com/wp-content/uploads/2021/03/livro-digital.png" width="431" height="596"
          alt="" class="w-100">


      </div>

    </div>
  </section>





  <!-- 
    - #BENEFITS
  -->

  <section class="section benefits" id="benefits" aria-label="benefits">
    <div class="container">

      <div class="grid-list">

        <li class="benefits-content">
          <h2 class="h2 section-title">Missão, Visão e Valores</h2>

          <p class="section-text">Entenda um pouco mais sobre a Missão, Visão e Valores da nossa empresa.

          </p>
        </li>

        <li>
          <div class="benefits-card has-before has-after">

            <div class="card-icon">
              <img src="./assets/img/benefits-1.svg" width="40" height="40" loading="lazy" alt="Experience">
            </div>

            <h3 class="h3 card-title">Experiencia</h3>

            <p class="card-text">
                A Editora possui ampla experiência no mercado editorial, com foco na promoção da leitura e da educação . 
            </p>

            <a href="#" class="btn-link">
              <span class="span">Leia mais</span>

              <ion-icon name="chevron-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>
        </li>

        <li>
          <div class="benefits-card has-before has-after">

            <div class="card-icon">
              <img src="./assets/img/benefits-2.svg" width="40" height="40" loading="lazy" alt="Motivation">
            </div>

            <h3 class="h3 card-title">Motivação</h3>

            <p class="card-text">
                A principal motivação da Editora é tornar a leitura e a educação acessíveis a todos. Criando um ambiente sustentável e equilibrado. 
            </p>

            <a href="#" class="btn-link">
              <span class="span">Leia mais</span>

              <ion-icon name="chevron-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>
        </li>

        <li>
          <div class="benefits-card has-before has-after">

            <div class="card-icon">
              <img src="./assets/img/benefits-3.svg" width="40" height="40" loading="lazy" alt="Goals">
            </div>

            <h3 class="h3 card-title">Metas</h3>

            <p class="card-text">
                Expandir a distribuição de livros físicos e digitais para alcançar um público maior, promovendo a leitura em diversas regiões.

            </p>

            <a href="#" class="btn-link">
              <span class="span">Leia mais</span>

              <ion-icon name="chevron-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>
        </li>

        <li>
          <div class="benefits-card has-before has-after">

            <div class="card-icon">
              <img src="./assets/img/benefits-4.svg" width="40" height="40" loading="lazy" alt="Vision">
            </div>

            <h3 class="h3 card-title">Visão</h3>

            <p class="card-text">
              A Editora visa ser reconhecida como uma referência global em leitura, promovendo a acessibilidade ao conhecimento. 
            </p>

            <a href="#" class="btn-link">
              <span class="span">Leia mais</span>

              <ion-icon name="chevron-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>
        </li>

        <li>
          <div class="benefits-card has-before has-after">

            <div class="card-icon">
              <img src="./assets/img/benefits-5.svg" width="40" height="40" loading="lazy" alt="Mission">
            </div>

            <h3 class="h3 card-title">Missão </h3>

            <p class="card-text">
                A missão da Editora é promover a leitura como uma ferramentas para a construção de um futuro mais inclusivo.
            </p>

            <a href="#" class="btn-link">
              <span class="span">Leia mais</span>

              <ion-icon name="chevron-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>
        </li>

        <li>
          <div class="benefits-card has-before has-after">

            <div class="card-icon">
              <img src="./assets/img/benefits-6.svg" width="40" height="40" loading="lazy" alt="Strategy">
            </div>

            <h3 class="h3 card-title">Valores</h3>

            <p class="card-text">
              Operar com integridade e responsabilidade, sempre visando o bem-estar de clientes, colaboradores e da sociedade como um todo.
            </p>

            <a href="#" class="btn-link">
              <span class="span">Leia mais</span>

              <ion-icon name="chevron-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>
        </li>

      </div>

    </div>
  </section>


  <!-- 
    - #PREVIEW
  -->

 
  <!-- 
    - #AUTHOR
  -->

  <section class="section author" id="author">
    <div class="container">

      <figure class="author-banner img-holder" style="--width: 700; --height: 720;">
        <img src="assets/img/Livro_Editora/Frente.jpeg" width="700" height="720" loading="lazy" alt="Martin Jenny"
          class="img-cover">
      </figure>

      <div class="author-content">

        <p class="section-subtitle">Daniel Lamarão</p>

        <h2 class="h2 section-title">Entre a Realidade e o Perdão</h2>

        <p class="author-name">Gênero: Drama e Suspense </p>

        <div class="section-text">
          "Entre a Realidade e o Perdão" acompanha a história de Ethan, um jovem que, após ter um sonho intenso e inquietante, começa a revisitar memórias esquecidas de sua infância. 
        </div>

      </div>

    </div>
  </section>





  <!-- 
    - #ACHIEVEMENT
  -->

  <section class="section achievement" id="achievements" aria-label="achievement">
    <div class="container">

      <p class="section-subtitle">Nosso Time</p>

      <h2 class="h2 section-title has-underline">
        Integrantes da Equipe
        <span class="span has-before"></span>
      </h2>

      <ul class="grid-list">

        <li>
          <div class="achievement-card">

            <figure class="card-banner img-holder" style="--width: 450; --height: 300;">
              <img src="assets/img/Integrantes/Ana.jpeg" width="450" height="300" loading="lazy" alt="Nominated"
                class="img-cover">
            </figure>

            <div class="card-content">

              <h3 class="h3 card-title">Ana Beatriz</h3>

              <p class="card-text">
                Diretora Administrativa
              </p>

            </div>

          </div>
        </li>

        <li>
          <div class="achievement-card">

            <figure class="card-banner img-holder" style="--width: 450; --height: 300;">
              <img src="assets/img/Integrantes/Daniel.jpeg" width="450" height="300" loading="lazy" alt="Winner"
                class="img-cover">
            </figure>

            <div class="card-content">

              <h3 class="h3 card-title">Daniel Lamarão</h3>

              <p class="card-text">
                Gerente de Marketing
              </p>

            </div>

          </div>
        </li>

        <li>
          <div class="achievement-card">

            <figure class="card-banner img-holder" style="--width: 450; --height: 300;">
              <img src="assets/img/Integrantes/Giovanna.jpeg" width="450" height="300" loading="lazy"
                alt="Guest of Honor" class="img-cover">
            </figure>

            <div class="card-content">

              <h3 class="h3 card-title">Giovanna Aguiar</h3>

              <p class="card-text">
                Supervisora de Operações
              </p>

            </div>

          </div>
        </li>

        <li>
          <div class="achievement-card">

            <figure class="card-banner img-holder" style="--width: 450; --height: 300;">
              <img src="assets/img/Integrantes/Giullia.jpeg" width="450" height="300" loading="lazy" alt="Finalist"
                class="img-cover">
            </figure>

            <div class="card-content">

              <h3 class="h3 card-title">Giullia Gomes</h3>

              <p class="card-text">
                Gerente Financeira
              </p>

            </div>

          </div>
        </li>

        <li>
          <div class="achievement-card">

            <figure class="card-banner img-holder" style="--width: 450; --height: 300;">
              <img src="assets/img/Integrantes/Hipolito.jpeg" width="450" height="300" loading="lazy" alt="Winner"
                class="img-cover">
            </figure>

            <div class="card-content">

              <h3 class="h3 card-title">Julia Hipolito</h3>

              <p class="card-text">
                Gerente de Operações
              </p>

            </div>

          </div>
        </li>

        <li>
          <div class="achievement-card">

            <figure class="card-banner img-holder" style="--width: 450; --height: 300;">
              <img src="assets/img/Integrantes/Laura.jpeg" width="450" height="300" loading="lazy" alt="Nominated"
                class="img-cover">
            </figure>

            <div class="card-content">

              <h3 class="h3 card-title">Laura Mariana</h3>

              <p class="card-text">
                Supervisora de Marketing
              </p>

            </div>

          </div>
        </li>

        <li>
          <div class="achievement-card">

            <figure class="card-banner img-holder" style="--width: 450; --height: 300;">
              <img src="assets/img/Integrantes/Leticia.jpeg" width="450" height="300" loading="lazy" alt="Nominated"
                class="img-cover">
            </figure>

            <div class="card-content">

              <h3 class="h3 card-title">Letícia Silva</h3>

              <p class="card-text">
                Gerente de Recursos Humanos
              </p>

            </div>

          </div>
        </li>

      </ul>

    </div>
  </section>





  <!-- 
    - #CONTACT
  -->


<!-- 
- #FOOTER
-->
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




<script src="assets/js/script.js"></script>
</body>

</html>