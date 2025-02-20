<?php
// Iniciar sessão para mensagens de erro/sucesso
session_start();
include('conexao.php'); // Conecta ao banco de dados

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber dados do formulário
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografa a senha
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);

    // Verificar se o usuário já existe pelo e-mail ou CPF
    $check_query = "SELECT * FROM usuarios WHERE email = '$email' OR cpf = '$cpf'";
    $check_result = mysqli_query($conexao, $check_query);

    if (!$check_result) {
        // Caso ocorra um erro na query, exibir o erro
        die("Erro na consulta: " . mysqli_error($conexao));
    }

    if (mysqli_num_rows($check_result) > 0) {
        // Usuário já existe
        $mensagem = "Este e-mail ou CPF já está cadastrado.";
    } else {
        // Inserir novo usuário no banco de dados
        $query = "INSERT INTO usuarios (usuario, senha, nome, email, telefone, cpf, endereco) 
                  VALUES ('$nome', '$senha', '$nome', '$email', '$telefone', '$cpf', '$endereco')";

        if (mysqli_query($conexao, $query)) {
            $mensagem = "Conta criada com sucesso! Você já pode <a href='login.php'>fazer login</a>.";
        } else {
            $mensagem = "Erro ao criar a conta. Por favor, tente novamente. Erro: " . mysqli_error($conexao);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#phone').mask('(00) 00000-0000');
            $('#cpf').mask('000.000.000-00');
        });

        function togglePasswordVisibility() {
            const passwordField = document.getElementById('senha');
            const toggleIcon = document.getElementById('toggle-password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.textContent = '😀';
            } else {
                passwordField.type = 'password';
                toggleIcon.textContent = '😑';
            }
        }
    </script>
    <style>
        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 35px;
            transform: translateY(40%);
        }

        .text-field {
            position: relative;
        }

        .info-side {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            max-height: 80rem;
            border-radius: 2rem;
            background: url('assets/img/background.jpg') repeat center center;
            background-position: 55% 50%;
        }

        .mensagem {
            margin-bottom: 1rem;
            padding: 0.75rem;
            border-radius: 5px;
            background-color: #f8d7da;
            color: #721c24;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="form-wrapper">
        <main class="form-side">
            <?php if ($mensagem): ?>
                <div class="mensagem"><?= $mensagem; ?></div>
            <?php endif; ?>
            <form method="POST" name="form1" id="form1" action="" class="my-form">
                <div class="form-welcome-row">
                    <h1>Registre! &#128079;</h1>
                    <h2>Caso não tenha login</h2>
                </div>
                <div class="socials-row">
                    <a href="#" title="Use Google">
                        <img src="assets/img/google.png" alt="Google">
                        Faça login no Google
                    </a>
                </div>
                <div class="socials-row">
                    <a href="#" title="Use Apple">
                        <img src="assets/img/apple.png" alt="Apple">
                        Faça login na Apple
                    </a>
                </div>
                <div class="divider">
                    <div class="divider-line"></div>
                    ou faça login com e-mail
                    <div class="divider-line"></div>
                </div>
                <div class="text-field">
                    <label for="name">Nome</label>
                    <input id="name" type="text" name="nome" placeholder="Nome" autocomplete="off" required>
                    <div class="error-message">Nome obrigatório</div>
                </div>
                <div class="text-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="off" required>
                    <div class="error-message">Formato de e-mail incorreto</div>
                </div>
                <div class="text-field">
                    <label for="senha">Senha</label>
                    <input id="senha" type="password" name="senha" placeholder="Senha" title="Mínimo 6 caracteres, pelo menos  1 letra e 1 número" autocomplete="off" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required>
                    <span id="toggle-password" class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                    <div class="error-message">Mínimo 6 caracteres, pelo menos 1 letra e 1 número</div>
                </div>
                <div class="text-field">
                    <label for="phone">Telefone</label>
                    <input id="phone" type="text" name="telefone" placeholder="(00) 00000-0000" autocomplete="off" required>
                    <div class="error-message">Formato de telefone inválido</div>
                </div>
                <div class="text-field">
                    <label for="cpf">CPF</label>
                    <input id="cpf" type="text" name="cpf" placeholder="000.000.000-00" autocomplete="off" required>
                    <div class="error-message">Formato de CPF inválido</div>
                </div>
                <div class="text-field">
                    <label for="address">Endereço</label>
                    <input id="address" type="text" name="endereco" placeholder="Seu endereço" autocomplete="off" required>
                    <div class="error-message">Endereço obrigatório</div>
                </div>
                <button class="my-form__button" type="submit">Entrar</button>
                <div class="my-form__actions">
                    <div class="my-form__row">
                        <span>Já tem um login? </span>
                        <a href="login.php" title="Login">Entre de volta</a>
                    </div>
                </div>
            </form>
        </main>
        <aside class="info-side">
            <article class="blockquote-wrapper">
                <h2>Por que devo fazer login?</h2>
                <p>
                    Ao fazer login, você pode acessar seu painel pessoal, onde poderá gerenciar sua conta, visualizar seu perfil e muito mais.
                </p>
                <img src="assets/img/dashboard.png" alt="Dashboard">
            </article>
        </aside>
    </div>
</body>

</html>
