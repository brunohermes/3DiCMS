<?php 
    if(isset($_POST['submit'])){
    include_once('includes/config.php');

    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pwdh = hash('sha512', $password);
    $uid = hash('adler32', $email); //Unique Id

    $consult = mysqli_query($conexao, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($consult)){
        exit('This email is already taken!');
    }else{
        $result = mysqli_query($conexao, "INSERT INTO users(firstname, lastname, email, password) 
        VALUES('$firstname', '$lastname', '$email', '$pwdh')");
        $result = mysqli_query($conexao, "INSERT INTO resources(email, uid) VALUES('$email','$uid')");
        if (!file_exists('Dashboard/internal/userfiles/'.$uid)) {
            mkdir('Dashboard/internal/userfiles/'.$uid, 0777, true);
            mkdir('Dashboard/internal/userfiles/'.$uid.'/projects', 0777, true);
        }
    
    }
    
    
    //$reg = mysqli_query($conexao, "SELECT * FROM users WHERE email != '$email'");
   
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS only -->
    <link href="css/newaccount.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <div class="header-nav">  <a href="home.php">
      <p class="backBtn" href="home.php"></p>
      </a>
      <img class="logo-main" src="img/logo.png"/> 
    </div>
   
</head>
<body class="backgroundattr">
<div class="main-forms">   
    <p class="sff">Start for free!</p>
    <p class="cacc">Create a new account</p>

    <form action="newaccount.php" method="POST" id="form">
        <input name="fname" placeholder="First Name" maxlength="11" autocomplete="off" required type="text" class="fn-form" id="firstname"> <input  name="lname" autocomplete="off" required placeholder="Last Name" maxlength="20" type="text" class="ln-form" id="lastname"><br>

        <input  name="email" placeholder="E-mail" maxlength="30" type="email" class="info-form" id="email" autocomplete="off" required aria-describedby="emailHelp"><br>
        <input placeholder="Confirm E-mail" autocomplete="off" required maxlength="30" type="email" class="info-form" id="emailConfirm" autocomplete="off" required aria-describedby="emailHelp"><br>

        <input  name="password" placeholder="Password" autocomplete="off" required maxlength="15" type="password" class="pwd-form" id="password"><br>
        <input placeholder="Confirm Password" autocomplete="off" required maxlength="15" type="password" class="pwd-form" id="PwdConfirm"><br>
       
        <button onclick="location.href='home.php'" class="hasaccount-button">Cancel</button><input type="submit" name="submit" value="Register" class="submit-button"></input>
      
    </form>
      <div class="message-s" id="success" role="alert" style="display: none;"></div>
      <div class="message" id="error" role="alert" style="display: none;"></div>
</div>

</body>
</html>