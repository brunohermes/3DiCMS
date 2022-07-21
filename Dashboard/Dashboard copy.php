<?php

    include_once('../includes/config.php');
    include_once('master.php');
    $logado = $_SESSION['email'];
    
    
    $sql2 = "SELECT * FROM users WHERE email = '$logado'";
    $resulto = $conexao->query($sql2);
    $user_data = mysqli_fetch_assoc($resulto);

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
    $page_title = "Dashboard";
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
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

    

</div>
   <div class="sidebarhandler"><?php include 'sidebar.php' ?></div>
    <!-- <div class="sidebardash">
        <ul>
                <li><a href="#"><div class="l1-icon"></div><span class="menu-text">Dashboard</span></a></li>
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
        </div> -->

</head>
 <body>
    <div class="page-content">
 
        <div class="page-handler">
            <div class="dashboard-ui">

            <div class="datausage">
            <span class="datausagetxt">Data Usage</span><br>
            <span class="totalProjectstxt">Total Projects: <?php echo $nop['projects']; ?></span>
                <canvas id="projectsChart"></canvas>
            <script>
            const ctx = document.getElementById('projectsChart').getContext('2d');
            const totalPlan = 20;
            const usedTotal = <?php echo $nop['projects']; ?>;
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        fill: true,
                        backgroundColor: 'rgba(91, 154, 255, 0.2',
                        data: [usedTotal, (totalPlan-usedTotal)  ],
                        backgroundColor: [
                            'rgba(245, 245, 245, 1)',
                            'rgba(25, 25, 25, 1)'
                        ],
                        borderColor: [
                            'rgba(245, 245, 245, 1)',
                            'rgba(245, 245, 245, 0)'
                        ],
                        borderWidth: 1,
                        cutout: '93%', 
                        circumference: 180,
                        rotation: 270,
                        borderRadius: 5,

                    }],
                        
                    },
                    options: {
        plugins: {
            title: {
                display: true,
                text: 'Used Total: ' + (usedTotal/totalPlan)*100 + '%',
                align: 'center',
                position: 'bottom',
                fullsize: 'true',
                font: {
                        size: 15,
                        family: 'Helvetica',
                    },
                padding: {
                    bottom: 50
                }
            }
        }
    }
            });
            </script>
        </div>
            
<!-- 
                <h4>Number of projects:</h4>
                <span class="dNumber"><?php echo $nop['projects']; ?></span> -->
            </div>

        </div>
</div>
</body>
</html>