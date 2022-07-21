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
    $page_title = "Profile";
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
    <link href="Profile.css" rel="stylesheet">
    <script src="jQuery.js"></script> 



   <div class="profile">
    <img  src="<?php if(!empty($user_data['profilepic'])){ echo $user_data['profilepic']; }else{ echo " "; } ?>" class="profile-pic"><a href="#" onclick="HidePinfo();" class="profile-info"><?php echo $fn; ?><img class="arrow-profile" src="../img/prof-down.png"></a>
        <div id="profile-information" style="display: none;"class="exp-inf">
        <li class="exp-opt"><a class="exp-link" href="#">Settings</a></li>    
        <li class="exp-opt"><a class="exp-link" href="../out.php">Logout</a></li>
        </div>    

</div>
   
    <div class="sidebardash">
        <ul>
                <li><a href="Dashboard.php"><div class="l1-icon"></div></a></li>
                <li><a href="3D.php"><div class="l2-icon"></div></a></li>
                <li><a href="#"><div class="l3-icon"></div></a></li>
                <li><a href="Files.php"><div class="l4-icon"></div></a></li>
            </ul>
        </div>

</head>
<body>
    <div class="page-content">
    <h2 class="page-title"><?php echo $page_title; ?> </h2>
        <div class="page-handler">
            <center>
            <div class="Profile-settings">
                <ul>
                <li class="profilelb"><img  src="<?php if(!empty($user_data['profilepic'])){ echo $user_data['profilepic']; }else{ echo " "; } ?>" class="profile-sPic"></li>
                <li class="profilelb"><label class="plabel">Fullname:<br> <?php echo $fn; ?></label></li>
                <li class="profilelb"><label class="plabel">Email:<br> <?php echo $logado; ?></label></li>
                </ul>
               
                <p class="pplabel">Change profile picture</p>
                <form action="/upload-avatar.php" class="uploadavatarform">
                <input type="file" id="myFile" name="filename">
                <input type="submit">
                </form>
            </div>
            </center>
        </div>
</div>
</body>
</html>