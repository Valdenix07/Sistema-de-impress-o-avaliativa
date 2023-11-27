<?php
require('Config.php');

// Este código é utilizado para adicionar criptografia as 
// senhas, basta roda-lo e ele irá criptografar todas as senhas do banco

$sql = $conn->prepare("SELECT id, senha FROM usuarios");
$sql->execute();

while ($user = $sql->fetch(PDO::FETCH_ASSOC)) {
    // Aplica a função password_hash à senha existente
    $hash_senha = password_hash($user['senha'], PASSWORD_BCRYPT);

    // Atualiza o valor no banco de dados
    $update_sql = $conn->prepare("UPDATE usuarios SET senha = :novaSenha WHERE id = :id");
    $update_sql->bindValue(':id', $user['id']);
    $update_sql->bindValue(':novaSenha', $hash_senha);
    $update_sql->execute();
}

echo "Senhas atualizadas com sucesso!";
header('Location: ../index.html');
?>


