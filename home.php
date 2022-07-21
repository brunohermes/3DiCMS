<?php
include_once('includes/config.php');
session_start();
  if(isset($_SESSION['email'])){
      header('Location: Dashboard/mDashboard.php');
      exit;
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
   
    <link href="Login/design.css" rel="stylesheet"> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3Di CMS - Login</title>
    <div class="header-nav">
    </div>
</head>

<body>
<section class="Form my-4 mx-5">
  <div class="container">
  <div class="row g-0">
  <div class="col-lg-5">
    <img src="bg-login2.jpg" class="img-fluid" alt=""> 
    <!-- 460 * 600 -->

  </div>
  <div class="col-lg-7 px-5 pt-5">
  <h1 class="pt-5">3Di CMS</h1>
  <h4>Sign in</h4>  
    <form method="POST" action="login.php">
      <div class="form-row pt-5">
        <div class="col-lg-7">
        <input name="email" type="email" class="form-control my-3 p-3" placeholder="E-mail"/>
        </div>
      </div>
      <div class="form-row">
        <div class="col-lg-7">
        <input name="password" type="password" class="form-control  my-3 p-3" placeholder="Password"/>
        </div>
      </div>
      <div class="form-row">
        <div class="col-lg-7">
         <button class="loginbtn mt-1 mb-5" type="submit" name="submit">Login</button>
        </div>
        <a href="#">Forgot password?</a>
        <p>Don't have an account? <a href="#">Register new account.</a></p>
      </div>
    </form>
  </div>
  </div>
  </div>
</section>


<!--   
    <div>
          <img src="physys.png" class="logo"/>
      
          <form method="POST" action="login.php">
            <input name="email" type="email" class="input-email-m" placeholder="E-mail"/><br>
            <input name="password" type="password" class="input-pwd-m" placeholder="Password"/><br>
            <button class="login-btn-m" type="submit" name="submit">Login</button>
        </form>

    </div>   -->

</body>

</html>