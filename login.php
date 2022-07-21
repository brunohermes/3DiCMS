<?php
    session_start();

    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])){
        include_once('includes/config.php');
        $email = $_POST['email'];
        $senha = $_POST['password'];
        $pwd = hash('sha512', $senha);
   

        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$pwd'";
        $result = $conexao->query($sql);
        
        if(mysqli_num_rows($result) < 1){
            unset($_SESSION['email']);
            unset($_SESSION['password']);
            header('Location: home.php');
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $pwd;
            header('Location: Dashboard/Dashboard.php');
        }

    }else{
        header('Location: home.php');
    }
?>