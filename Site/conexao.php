<?php
// conexão.php - Configuração de Conexão com o Banco de Dados

$servidor = "localhost";
$usuario = "root"; // Altere para o usuário do seu banco de dados
$senha = ""; // Altere para a senha do seu banco de dados
$banco = "sistema_login";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica a Conexão
if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
?>
