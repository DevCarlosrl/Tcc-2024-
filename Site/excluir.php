<?php
include("conexao.php");

$id = $_GET['id'];

// Excluir da tabela 'usuarios'
$query_usuarios = "DELETE FROM usuarios WHERE id = '$id'";
$resultado_usuarios = mysqli_query($conexao, $query_usuarios);

// Verifica se a exclusão foi bem-sucedida nas duas tabelas
if ($resultado_usuarios) {
    header("Location: painelcadastro.php");
    exit;
} else {
    echo "Erro ao excluir: " . mysqli_error($conn);
    exit;
}
?>


}
?>