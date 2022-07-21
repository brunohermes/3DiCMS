<?php

    include_once('../includes/config.php');
    include_once('master.php');
    $logado = $_SESSION['email'];
    
    $darkmode = " dark-theme-variables"; 
    $themetoggler = "theme-toggler";

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
    $page_title = "Project Manager";
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
            <h1><?php echo $page_title ?></h1>
            
            <!-- Blocos  -->
            <div class="insights">
            
                </div>

            <!-- <iframe width="890" height="700" src="http://localhost/Dashboard/internal/userfiles/91420a7c/projects/123123/" frameborder="0" allowfullscreen></iframe> -->
                <div class="projman">
                    <h2>Projects List</h2>
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
                        
                        if ($resulta->num_rows != 0) {
                            echo "<tr>";
                            // output data of each row
                            while($row = mysqli_fetch_array($resulta, MYSQLI_ASSOC)) {
                                $projpath = $row['projectpath'];
                                $projname = $row['projectname'];
                                $projdate = $row['date'];
                                $projst = $row['status'];
                                $cstt = $row['cst'];
                                $idf = $row['id'];
                                $dFunc = "Delete.php?id=".$idf;
                                $eFunc = "Edit.php?id=".$idf;

                                
                                $html = <<< EOD
                                
                                <td><a href="#{$projname}" onmouseover="document.getElementById('emb').src='{$projpath}'"  onclick="
                                
                                swal({ html:true, title:'{$projname}', text:''});
                                
                                ">{$projname}</a></td> 
                                
                                <td>{$projdate}</td>
                                
                                <td class="{$cstt}">{$projst}</td>
                                
                                <td class="primary"><a href="{$eFunc}">Edit</a></td>

                                <td class="primary"><a href="#" style="color: #ff616f;" onclick="
                                swal({
                                    title: 'Are you sure?',
                                    text: 'Once deleted, the project cannot be accessed anymore!',
                                    icon: 'warning',
                                    buttons: true,
                                    dangerMode: true,
                                  })
                                  .then((willDelete) => {
                                    if (willDelete) 
                                    {
                                      swal('Project Deleted, if you think you made a mistake by deleting this project, please contact the administrator.',
                                    
                                      {
                                        icon: 'success',
                                      }).then(
                                        function () {
                                        window.location.href = '{$dFunc}';
                                        }
                                );
                                    }else {
                                      swal('Your imaginary file is safe!');
                                    }
                                  }
                                );
                                ">Delete</a></td>
                            
                                </tr>
                                EOD;
                              echo $html;
                              
                             }
                            echo "</tr>";
                        } 
                        ?>
                            </tbody> 
                        </table>
                        
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
            <div class="dpreviewer">
                <h2>3D Preview</h2>
                <div class="muted"></div>
                <div class="dpreview">
                    <div class="updatepreview">
                             <div class="modelviewer">
                              <embed id="emb" class="viewmodule" src="" width="98%"></embed>
                              </div> 
                     </div>
                </div>
            </div>
            <!-- <div class="dpreviewer">
                <h2>Quick iFrame</h2>
                <div class="muted"></div>
                <div class="dpreview">
                    <div class="updatepreview">
                    <textarea id="quickiframe">
                    <iframe width="890" height="700" id="embed" src="" frameborder="0" allowfullscreen></iframe>
                    </textarea>
                     </div>
                </div>
            </div> -->

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
                       
</body>

</html>