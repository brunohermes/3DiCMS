<?php

    include_once('../includes/config.php');
    include_once('master.php');
    $logado = $_SESSION['email'];
    $hostExt = "/Dashboard/";
    $hostex = "118268.duckdns.org/Dashboard/";
    $darkmode = " dark-theme-variables"; 
    $themetoggler = "theme-toggler";

    $sql2 = "SELECT * FROM users WHERE email = '$logado'";
    $resulto = $conexao->query($sql2);
    $user_data = mysqli_fetch_assoc($resulto);

    $id = $_GET['id'];
        
    $projectConsult = "SELECT * FROM projects WHERE id='$id'";
    $sql5 = mysqli_query($conexao, $projectConsult)  or die(mysqli_error($db));
    $projectData = mysqli_fetch_assoc($sql5);
    $extProjPath = $hostex.$projectData['projectpath'];
    $extProjPaths = $hostExt.$projectData['projectpath'];
    // echo $projectData['projectname'];

    


    $fn = $user_data['firstname']." ".$user_data['lastname'];
    $plan = $user_data['plan'];
    $usrname = $user_data['firstname'];
    //custom profile 
    function getProfilePicture($name){
        $name_slice = explode(' ',$name);
          $name_slice = array_filter($name_slice);
          $initials = '';
        $initials .= (isset($name_slice[0][0]))?strtoupper($name_slice[0][0]):'';
        $initials .= (isset($name_slice[count($name_slice)-1][0]))?strtoupper($name_slice[count($name_slice)-1][0]):'';
        return '<div class="profile-pic">'.$initials.'</div>';
    }
    $page_title = "Project Manager";


    $sql3 = "SELECT * FROM projects WHERE uid = '$uid'";
    $resulta = $conexao->query($sql3);
    if ($resulta->num_rows != 0) {
        echo "<tr>";
        // output data of each row
        while($row = mysqli_fetch_array($resulta, MYSQLI_ASSOC)) {
            $projpath = $row['projectpath'];
            $projname = $row['projectname'];
            $projdate = $row['date'];
            $projst = $row['status'];
            $cstt = $row['cst'];
            $npp;
            
           
          
         }
        echo "</tr>";
    } 

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

    // VERSION CONTROL
    $dash_ver = '0.01 alpha';

    </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title." | ".$fn; ?></title>
    <link href="design.css" rel="stylesheet">
    <script src="jQuery.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="qrious.min.js"></script>


    <script src="sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <aside>
        <div class="top">
            <div class="logo">
            <img src="logo2.png"><h2>HMS 3D</h2>
            </div>
            <div class="close" id="closebtn"><i class='bx bx-x' ></i></div>
        </div>
        <div class="sidebar">
            <a href="Dashboard.php" class="">
            <i class='bx bx-grid-alt' ></i>
                <h3>Dashboard</h3>
            </a>

            <a href="New-Project.php" class="">
            <i class='bx bx-copy-alt' ></i>
                <h3>New Project</h3>
            </a>

            <a href="#" class="active">
            <i class='bx bx-copy-alt' ></i>
                <h3>Project Manager</h3>
            </a>

            <a href="#">
            <i class='bx bx-crown' ></i>
                <h3>Upgrade Plan</h3>
            </a>

            <a href="#">
            <i class='bx bx-coin'></i>
                <h3>Purchase Credits</h3>
            </a>

            <a href="#">
            <i class='bx bx-user-circle' ></i>
                <h3>User Preferences</h3>
            </a>

            <a href="#">
            <i class='bx bx-cylinder' ></i>
                <h3>3D Converter</h3>
            </a>

            <a href="#">
            <i class='bx bx-message-square-dots'></i>
                <h3>Support</h3>
                <span class="message-count">3</span>
            </a>

            <a href="../out.php">
            <i class='bx bx-log-out-circle'></i>
                <h3>Logout</h3>
            </a>

        </div>
        </aside>
        
        <main>
            <h1><?php echo $projectData['projectname']; ?></h1>
            
            <!-- Blocos  -->
            <div class="ep-main">
             
             <div class="insights">
             <iframe width="350" height="350" src="<?php echo $projectData['projectpath']; ?>" frameborder="0" allowfullscreen></iframe>
                <div class="inputs">
                    <h3>Project Name</h3>
                    <input type="text" class="txt" placeholder="<?php echo $projectData['projectname']; ?>"></input>
                    <h3>Project Name</h3>
                    <input type="text" class="txt" placeholder="<?php echo $projectData['projectpath']; ?>"></input><br><br>
                    <h3>QRCode</h3><br>
                    <canvas id="qr"></canvas>
                    <script>
                    var qr = new QRious({
                    element: document.getElementById('qr'),
                    value: '<?php echo $extProjPath; ?>'
                    });
                    </script></div>
                  
                    <p><h3>Embed Code</h3></p><br>
                    <pre class="iframecode">&lt;iframe width="250px" height="250px" src="<?php echo $extProjPaths  ?>"
title="<?php echo $projname ?>"&gt;&lt;/iframe&gt;</pre>
                    
                </div>
                </div>
        </main>
    <!-- end of main -->

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                <i class='bx bx-menu-alt-left' ></i>
                </button>
                <div class="theme-toggler">
                <i class='bx bxs-sun' ></i>
                <i class='bx bxs-moon'  ></i>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo $fn ?></b></p>
                        <small class="text-muted">Actual Plan: <?php echo $plan ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="<?php if(!empty($user_data['profilepic'])){ echo $user_data['profilepic']; }else{ echo " "; } ?>" alt="">
                    </div>
                </div>
            </div>
        <!-- end of top -->
           

        </div>
    </div>
    


    <script src="content.js"></script>
    
                       
</body>

</html>