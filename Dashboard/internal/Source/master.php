<?php
 session_start();
 //print_R($_SESSION);
 if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
     unset($_SESSION['email']);
     unset($_SESSION['password']);
     header(('Location: ../home.php'));
 }
 include_once('../includes/config.php');
 $logado = $_SESSION['email'];
 $uid = hash('adler32', $logado);
 
 $sql2 = "SELECT * FROM users WHERE email = '$logado'";
 $resulto = $conexao->query($sql2);
 $user_data = mysqli_fetch_assoc($resulto);

 $fn = $user_data['firstname']." ".$user_data['lastname'];
 $nopconsult = "SELECT projects FROM resources WHERE uid='$uid'";
 $resultnop = $conexao->query($nopconsult);
 $nop = mysqli_fetch_assoc($resultnop); 

 // $fn = Full name
 // $nop = Number of projects associated with id

?>