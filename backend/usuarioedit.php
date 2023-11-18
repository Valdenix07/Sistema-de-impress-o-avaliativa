<?php
require('Config.php');

if (isset($_POST['novaSenha']) && isset($_POST['confirmarsenha'])) {
    $email = $_POST['email'];
    $novaSenha = $_POST['novaSenha'];
    $confirmarsenha = $_POST['confirmarsenha'];

    if ($novaSenha == $confirmarsenha) { // Verifica se as senhas coincidem.
        // Se as senhas coincidirem, prossiga com a atualização.
        // O código de atualização permanece inalterado.
        $sql = "UPDATE usuarios 
                SET senha=:novaSenha 
                WHERE email=:email";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':novaSenha', $novaSenha);
        $stmt->bindValue(':email', $email);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Senha atualizada com sucesso!";
        } else {
            echo "Email não encontrado. Senha não atualizada.";
        }
    } else {
        echo "Senhas diferentes";
    }

    header('Location: ../index.html');

}
