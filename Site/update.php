<?php
session_start();
include_once("conexao.php");

// Sanitizar entradas
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$nivel = filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

// Verificar em qual tabela o usuário está
$sql_check_usuario = "SELECT id FROM usuarios WHERE id = $id";

$result_usuario = mysqli_query($conexao, $sql_check_usuario);


if (mysqli_num_rows($result_usuario) > 0) {
    $tabela = "usuarios";
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Usuário não encontrado.</p>";
    header("Location: painelcadastro.php");
    exit;
}

// Atualizar com ou sem senha
if (empty($senha)) {
    $query_update = "UPDATE $tabela SET nome='$nome', nivel='$nivel', email='$email' WHERE id='$id'";
} else {
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha
    $query_update = "UPDATE $tabela SET nome='$nome', nivel='$nivel', email='$email', senha='$senha_hash' WHERE id='$id'";
}

// Executa a atualização
$resultado_update = mysqli_query($conexao, $query_update);

if (mysqli_affected_rows($conexao)) {
    $_SESSION['msg'] = "<p style='color:green;'>Usuário editado com sucesso</p>";
    header("Location: painelcadastro.php");
    exit;
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Usuário não foi editado com sucesso</p>";
    header("Location: editarusuario.php?id=$id");
    exit;
}
?>

