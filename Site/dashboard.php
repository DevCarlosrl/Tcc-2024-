<?php
session_start();

// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
    // Se não for um administrador, redireciona para a mesma página (ou apenas mostra uma mensagem)
    echo "<script>alert('Acesso restrito. Você não tem permissão para acessar esta página.');</script>";
    // Opcionalmente, você pode redirecionar para outra página, descomente a linha abaixo se necessário
    // header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="assets/css/dashboard.css">

	<title>Pagina de Adm</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="index.php" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Editora transformar</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
	
			<li>
				<a href="pedidos.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Pedidos</span>
				</a>
			</li>
			<li>
				<a href="visualizaraluguel.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Aluguel</span>
				</a>
			</li>

			<li>
				<a href="painelcadastro.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Painel de Cadastro</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="livros.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Livros
                    </span>
				</a>
			</li>
			<li>
				<a href="index.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Sair</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categorias</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="data:image/jpeg;base64,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">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Inicio</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>1020</h3>
						<p>Nova ordem</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>2834</h3>
						<p>Visitantes</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>$2543</h3>
						<p>Vendas totais</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Ordem recente</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Usuario</th>
								<th>Ordem de data</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<img src="img/people.png">
									<p>Ana Silva</p>
								</td>
								<td>15-09-2024</td>
								<td><span class="status completed">Completo</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>Carlos Souza</p>
								</td>
								<td>13-08-2024</td>
								<td><span class="status pending">Pendencia</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>Maria Santos</p>
								</td>
								<td>11-07-2024</td>
								<td><span class="status process">Em Processo</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>João Pereira</p>
								</td>
								<td>22-06-2024</td>
								<td><span class="status pending">Pendencia</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>Pedro Lima</p>
								</td>
								<td>30-05-2024</td>
								<td><span class="status completed">Completo</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="assets/js/dashboard.js"></script>
</body>
</html>