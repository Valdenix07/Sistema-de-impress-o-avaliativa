<?php
require('Config.php');

$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');

if ($email && $senha) {
    $sql = $conn->prepare("SELECT id, email, senha FROM usuarios WHERE LOWER(email) = :email");
    $sql->bindValue(':email', strtolower($email));
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // Verifica se a senha fornecida é válida usando password_verify
        if (password_verify($senha, $user['senha'])) {
            // A senha é válida, autenticação bem-sucedida
            session_start();
            $_SESSION['token'] = md5($user['email']);
            $_SESSION['userName'] = $user['email'];
            header('Location: ../Tabela.php');
            exit();
        } else {
            // Senha incorreta - inclua a mensagem de erro na URL
            $errorMessage = urlencode('Senha incorreta');
            header("Location: ../index.html?error=$errorMessage");
            exit();
        }
    } else {
        // E-mail não encontrado - inclua a mensagem de erro na URL
        $errorMessage = urlencode('E-mail não encontrado');
        header("Location: ../index.html?error=$errorMessage");
        exit();
    }
}

// Se não foi redirecionado para o main, vá para o login novamente
header('Location: ../index.html');
exit();
?>
