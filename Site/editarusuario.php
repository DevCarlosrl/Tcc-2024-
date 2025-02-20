<?php
include_once("conexao.php"); // Verifique se $conn está definido aqui

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitiza o ID para evitar injeção SQL

    // Consulta no banco de dados
    $sql = "SELECT id, nome, nivel, email, senha FROM usuarios WHERE id = $id";
    $resultado = mysqli_query($conexao, $sql); // Use $conn aqui

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row_usuario = mysqli_fetch_assoc($resultado);
    } else {
        echo "Usuário não encontrado.";
        exit;
    }
} else {
    echo "ID não fornecido.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-4">Editar Usuário</h1>
        <form method="POST" action="update.php" class="form-group">
            <input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>">
            
            <label>Nome: </label>
            <input type="text" name="nome" class="form-control" placeholder="Digite o nome completo" value="<?php echo htmlspecialchars($row_usuario['nome']); ?>"><br>
            
            <label>Nível: </label>
            <input type="text" name="nivel" class="form-control" placeholder="Digite o nível" value="<?php echo htmlspecialchars($row_usuario['nivel']); ?>"><br>
            
            <label>Email: </label>
            <input type="email" name="email" class="form-control" placeholder="Digite o email" value="<?php echo htmlspecialchars($row_usuario['email']); ?>"><br>
            
            <label>Senha: </label>
            <input type="password" name="senha" class="form-control" placeholder="Digite a senha" value="<?php echo htmlspecialchars($row_usuario['senha']); ?>"><br>
            
            <input type="submit" value="Editar" class="btn btn-primary btn-block mt-3">
        </form>
        <a href="painelcadastro.php" class="btn btn-secondary mt-2">Voltar</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
