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
    
    $uid = hash('adler32', $logado);

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
    $page_title = "Projects";



    /// LOGICA PARA CRIAÇÃO DOS PROJETOS:
    // SE A PASTA NÃO EXISTIR = CRIE 
    //CRIE A PASTA + ARQUIVOS BASE DO 3D
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


    function hideProj()
    {
        var profileI= document.getElementById('editprojectmenu');
        if(profileI.style.display =="none"){
            profileI.style.display = "block";
        }else{
            profileI.style.display = "none";
        }
    }
      
    function ShowProj()
    {
    document.getElementById('avmenu').style.display="block";
    }

    </script>
<style>
    .modal {
  position: fixed;
  margin-left: 15vw;
  margin-top: 2vw;
  padding: 15vw;
  font-family: Arial, Helvetica, sans-serif;
  background: rgba(0,0,0,0.8);
  z-index: 10;
  color: #fff;
  opacity:0;
  -webkit-transition: opacity 400ms ease-in;
  -moz-transition: opacity 400ms ease-in;
  transition: opacity 400ms ease-in;
  pointer-events: none;
}
.modal:target {
  opacity: 1;
  pointer-events: auto;
}
.modal > div {
  width: 400px;
  position: relative;
  margin: 10% auto;
  padding: 15px 20px;
  background: #fff;
}
.fechar {
  position: absolute;
  width: 30px;
  right: -15px;
  top: -20px;
  text-align: center;
  line-height: 30px;
  margin-top: 5px;
  background: #ff4545;
  border-radius: 50%;
  font-size: 16px;
  color: #8d0000;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title." | ".$fn; ?></title>
    <link href="Projects.css" rel="stylesheet">
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
        <div class="page-handler" >

<!-- MODAL -->
            <div id="abrirModal" class="modal">
            <a href="#fechar" title="Fechar" class="fechar">x</a>
            <h2>Edit Project</h2>
            <p>Renomear</p>
            <p>Deletar</p>
            </div>

            <div class="modelviewer">
                <embed id="emb" class="viewmodule" src=""></embed>
            </div>
            <div class="projectlist">
                <nav>
                <?php 
                        $sql3 = "SELECT * FROM projects WHERE uid = '$uid'";
                        $resulta = $conexao->query($sql3);
                        
                        if ($resulta->num_rows != 0) {
                            echo "<ul  name='projectselection'>";
                            // output data of each row
                            while($row = mysqli_fetch_array($resulta, MYSQLI_ASSOC)) {
                                $projpath = $row['projectpath'];
                                $projname = $row['projectname'];
                                
                                $html = <<< EOD
                                <a  href="#{$projname}" onclick="document.getElementById('emb').src='{$projpath}'"><li class="listofprojects" value="{$projname}">{$projname}<a class="editprjd" onclick="hideProj();" id="editprj" href="#{$projname}"></li></a></a>
                                <div id="editprojectmenu" style="display: none;" class="proj-inf">
                                <li class="exp-opt"><a class="exp-link" href="Profile.php">Rename</a></li>    
                                <li class="exp-opt"><a class="exp-link" href="../out.php">Delete</a></li>
                                </div>  
                                EOD;
                              echo $html;
                            
                //  "<a id='projectref' href='". $row['projectpath'] . "' >" ."<li class='listofprojects' value='" . $row['projectname'] . "'>" .  $row['projectname']  ."</li>". "</a>";
                            }
                            echo "</ul>";
                        } 
                        ?>
        </nav>
        
            </div>

        </div>
</div>




</body>
</html>