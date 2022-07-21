<?php

    include_once('../includes/config.php');
    include_once('master.php');
    $logado = $_SESSION['email'];
    
    $darkmode = " dark-theme-variables"; 
    $themetoggler = "theme-toggler";

    $sql2 = "SELECT * FROM users WHERE email = '$logado'";
    $resulto = $conexao->query($sql2);
    $user_data = mysqli_fetch_assoc($resulto);

    // $consultaWaiting = "SELECT * FROM projects WHERE status = 'Waiting for 3D Model'";
    // $sqwait = mysqli_query($conexao, $consultaWaiting)  or die(mysqli_error($db));

    // $waitresults = mysqli_query("SELECT * FROM projects WHERE status = 'Waiting for 3D Model'");
    // $num_rowswait = mysqli_num_rows($waitresults);

    
    $rstwait = "SELECT * FROM projects WHERE status = 'Waiting for 3D Model'";
    $reswait = $conexao->query($rstwait);
    $finalwait = mysqli_num_rows($reswait);

    $rstcanc = "SELECT * FROM projects WHERE status = 'Cancelled'";
    $rescanc = $conexao->query($rstcanc);
    $finalcancelled = mysqli_num_rows($rescanc);

    $rstdone = "SELECT * FROM projects WHERE status = 'Done'";
    $resdone = $conexao->query($rstdone);
    $finaldone = mysqli_num_rows($resdone);
   



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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
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
            <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
                <h3>Dashboard</h3>
            </a>

            <a href="New-Project.php" class="">
            <i class='bx bx-copy-alt' ></i>
                <h3>New Project</h3>
            </a>

            <a href="Manage-Projects.php">
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
            <h1>Dashboard</h1>
            
            <!-- Blocos  -->
            <div class="insights">
                <!-- block start -->
                    <div class="sales">
                      <i class='bx bx-hdd'></i> 
                        <div class="middle">
                            <div class="left">
                                <h3>Storage</h3>
                            </div>
                            <div class="progress">
                                    <div class="datausage">
                                            <span class="totalProjectstxt"></span>
                                            <canvas id="projectsChart"></canvas>                     
                                            </div>
                                <div class="number">
                                    <p>Total Projects: <?php echo $nop['projects']; ?></p>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">The amount of projects is limited according to your plan.</small>
                    </div>  
                    <!-- End of block -->  

                    <!-- block start -->
                    <div class="income">
                    <i class='bx bx-bar-chart-square'></i>
                        <div class="middle">
                            <div class="left">
                                <h3>Status</h3>
                                <canvas id="pstats"></canvas>
                            </div>
                            <div class="progress">
                                
                                <div class="number">
                                    <p>Keep track of your projects.</p>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted"></small>
                    </div>  
                    <!-- End of block -->  
                    <!-- block start -->
                    <div class="expenses">
                    <i class='bx bx-dollar-circle'></i>
                            <div class="middle">
                            <div class="left">
                                <h3>Spent Credits</h3>
                            </div>
                            <div class="progress">
                            <canvas id="scredits"></canvas>    
                                <div class="number">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">Keep track of your credits usage.</small>
                    </div>  
                    <!-- End of block -->  
                </div>

            <!-- <iframe width="890" height="700" src="http://localhost/Dashboard/internal/userfiles/91420a7c/projects/123123/" frameborder="0" allowfullscreen></iframe> -->
                <div class="recent-projects">
                    <h2>Recent Projects</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Date Added</th>
                                    <th>Status</th>       
                                    <th></th>                             
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php 
                        $sql3 = "SELECT * FROM projects WHERE uid = '$uid'";
                        $resulta = $conexao->query($sql3);
                        $count = 0;
                        $max = 4;

                        if ($resulta->num_rows != 0) {
                            echo "<tr>";
                            // output data of each row
                            while($row = mysqli_fetch_array($resulta, MYSQLI_ASSOC) and ($count < $max)) {
                                $projpath = $row['projectpath'];
                                $projname = $row['projectname'];
                                $projdate = $row['date'];
                                $projst = $row['status'];
                                $cstt = $row['cst'];
                                $idf = $row['id'];
                                $eFunc = "Edit.php?id=".$idf;

                                $html = <<< EOD
                                <td>{$projname}</td>
                                <td>{$projdate}</td>
                                <td class="{$cstt}">{$projst}</td>
                                <td class="primary"><a href="{$eFunc}">Details</td>
                                </tr>
                                EOD;
                              echo $html;
                              $count++;
                             }
                            echo "</tr>";
                        } 
                        ?>
                            </tbody>
                        </table>
                        <a href="Manage-Projects.php">Show All</a>
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
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                    <a id="upd"class="twitter-timeline" data-width="400" data-height="755" href="https://twitter.com/BrunoHermes7?ref_src=twsrc%5Etfw">Recent Updates</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                     </div>
                </div>
            </div>

        </div>
    </div>
    
    <script>
        const sideMenu = document.querySelector("aside");
        const menuBtn = document.querySelector("#menu-btn");
        const closeBtn = document.querySelector("#closebtn");
        const themeToggler = document.querySelector(".theme-toggler");
        const news = document.getElementById("upd");
      
        var darkMode;
        var lightMode;
        var dTime = (new Date()).getHours(); //Get time of day 24h format
        var dcheck;
        
        if(dTime > 7 && dTime < 18){
            console.log("day");
            console.log(dTime);
            dcheck = "day";
        }else{
            console.log("night");
            console.log(dTime);
            dcheck = "night";
        }

        if(dcheck == "night"){
            document.body.classList.add('dark-theme-variables');
            themeToggler.querySelector('i:nth-child(2)').classList.toggle('active');
        }else if(dcheck == "day"){
            document.body.classList.remove('dark-theme-variables');
            themeToggler.querySelector('i:nth-child(1)').classList.toggle('active');
        }



        menuBtn.addEventListener('click', () => {
            sideMenu.style.display = 'block';
        });

        closeBtn.addEventListener('click', () =>{
            sideMenu.style.display = 'none';
        });
        



        themeToggler.addEventListener('click', () => {
            document.body.classList.toggle('dark-theme-variables');
            themeToggler.querySelector('i:nth-child(1)').classList.toggle('active');
            themeToggler.querySelector('i:nth-child(2)').classList.toggle('active');

            
        });
    </script>
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
                                                                                            'rgba(33, 150, 243, 1)',
                                                                                            'rgba(103, 116, 131, 1)'
                                                                                        ],
                                                                                        borderColor: [
                                                                                            'rgba(33, 150, 243, 1)',
                                                                                            'rgba(103, 116, 131, 1)'
                                                                                        ],
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
                                                                                        size: 10,
                                                                                        family: 'Helvetica',
                                                                                    },
                                                                                padding: {
                                                                                    bottom: 100,
                                                                                    top: 10 
                                                                                },
                                                                            }
                                                                        }
                                                                    }
                                                                            });
                                                                            
const ctxx = document.getElementById('pstats');
const pstat = new Chart(ctxx, {
    type: 'bar',
    data: {
        labels: ['Cancelled', 'Waiting 3D model', 'Done'],
        datasets: [{
            label: 'Status',
            data: [<?php echo $finalcancelled; ?> , <?php echo $finalwait; ?> , <?php echo $finaldone; ?> ],
            backgroundColor: [
                'rgba(255, 97, 111, 1)',
                'rgba(255, 187, 85, 1)',
                'rgba(65, 241, 182, 1)',
            ],
            borderColor: [
                'rgba(255, 97, 111, 1)',
                'rgba(255, 187, 85, 1)',
                'rgba(65, 241, 182, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
new Chart(document.getElementById("scredits"), {
  type: 'line',
  data: {
    labels: [8, 16, 32, 64, 128, 256, 512, 1024, 2048, 3096],
    datasets: [{ 
        data: [86,114,106,106,107,111,133,221,783,2478],
        label: "Credits",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: [282,350,411,502,635,809,947,1402,3700,5267],
        label: "Amount",
        borderColor: "#8e5ea2",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'World population per region (in millions)'
    }
  }
});
    </script>
</body>

</html>