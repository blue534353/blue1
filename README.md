<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
</head>
<body>
    <h2>Formulário</h2>
    <form action="processar_cadastro.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>

        <label for="confirma_senha">Confirme a Senha:</label>
        <input type="password" name="confirma_senha" required>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>

