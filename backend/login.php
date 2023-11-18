<?php

    require('Config.php');
    
    $email = FILTER_INPUT(INPUT_POST,'email');
    $senha = FILTER_INPUT(INPUT_POST,'senha');
    echo $email;

    if($email && $senha){
        $sql = $conn->prepare("SELECT id, email, senha FROM usuarios WHERE LOWER(email)= :email");
        $sql->bindValue(':email',strtolower($email));
        $sql->execute();

         if($sql->rowCount() > 0 ){
            $user = $sql->fetch( PDO::FETCH_ASSOC);
   
            if($user['senha'] === $senha){
                $_SESSION['token'] = md5($user['email']);
                $_SESSION['userName'] = $user['email'];
                header('Location: ../Tabela.php');
            } 
         }
    }else {
        //se não foi redirecionado para o main então vá para login de novo
        header('Location: ../index.html'); 
    }

?>