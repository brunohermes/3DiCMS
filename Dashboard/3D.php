<?php
error_reporting(E_ERROR | E_PARSE);
include_once('../includes/config.php');
include_once('master.php');
    session_start();
    //print_R($_SESSION);
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        header(('Location: ../home.php'));
    }
    include_once('../includes/config.php');
    $logado = $_SESSION['email'];
    $usrname = $user_data['firstname'];

    $sql2 = "SELECT * FROM users WHERE email = '$logado'";
    $resulto = $conexao->query($sql2);
    $user_data = mysqli_fetch_assoc($resulto);

    $fn = $user_data['firstname']." ".$user_data['lastname'];
    //custom profile 
    function getProfilePicture($name){
        $name_slice = explode(' ',$name);
          $name_slice = array_filter($name_slice);
          $initials = '';
        $initials .= (isset($name_slice[0][0]))?strtoupper($name_slice[0][0]):'';
        $initials .= (isset($name_slice[count($name_slice)-1][0]))?strtoupper($name_slice[count($name_slice)-1][0]):'';
        return '<div class="profile-pic">'.$initials.'</div>';
    }
    $page_title = "3D Resources";
?>
 <script>
       function HidePinfo()
    {
        var profileI= document.getElementById('profile-information');
        if(profileI.style.display =="none"){
            profileI.style.display = "block";
        }else{
            profileI.style.display = "none";
        }
    }
      
    function ShowPinfo()
    {
    document.getElementById('avmenu').style.display="block";
    }

 


    </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title." | ".$fn; ?></title>
    <link href="3D.css" rel="stylesheet">
    <script src="jQuery.js"></script> 



    <div class="sidebardash">
        <ul>
                <li><a href="Dashboard.php"><div class="l1-icon"></div><span class="menu-text">Dashboard</span></a></li>
                <li><a href="3D.php"><div class="l2-icon"></div><span class="menu-text">Requests</span></a></li>
                <li><a href="Projects.php"><div class="l3-icon"></div><span class="menu-text">Projects</span></a></li>
                <li><a href="Files.php"><div class="l4-icon"></div><span class="menu-text">Upload</span></a></li>

                <div class="profile">
                <a href="#" onclick="HidePinfo();" class="profile-info">
                    <div class="profilesecc">
                <img  src="<?php if(!empty($user_data['profilepic'])){ echo $user_data['profilepic']; }else{ echo " "; } ?>" class="profile-pic">
                <?php echo $usrname; ?><br><img class="arrow-profile" src="../img/dots.png"> </div></a>
                    <div id="profile-information" style="display: none;"class="exp-inf">
                    <li class="exp-opt"><a class="exp-link" href="Profile.php">Settings</a></li>    
                    <li class="exp-opt"><a class="exp-link" href="../out.php">Logout</a></li>
                    </div>  
            </ul>
        </div>

</head>
<body>
    <div class="page-content">
    <h2 class="page-title"><?php echo $page_title; ?> </h2>
        <div class="page-handler">
            
        </div>
</div>
</body>
</html>