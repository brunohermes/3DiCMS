<?php
    include_once('../includes/config.php');
    include_once('master.php');  
    //error_reporting(0);
    //ini_set('display_errors', 0);
   
    //print_R($_SESSION);
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        header(('Location: ../home.php'));
    }
    
    $logado = $_SESSION['email'];
    $usrname = $user_data['firstname'];
    $statusupdate = "Done";
    $cstt = "success";

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


//UPLOAD DE MODELO
    if(isset($_FILES['modelUpload'])){
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $projectname = $_POST['projectselection'];  
        $arquivo = $_FILES['modelUpload'];
        $filenam = 'model.glb';
        $ext = strtolower(pathinfo($filenam, PATHINFO_EXTENSION));
        $folder = $destination_path.'internal/userfiles/'.$uid."/projects/".$projectname."/";
        $upr = move_uploaded_file($arquivo["tmp_name"], $folder.$filenam);

        if($upr){
            echo ("Model uploaded to project: ". $projectname);
            $result = mysqli_query($conexao, "UPDATE projects SET status = '$statusupdate', cst = '$cstt' WHERE projectname = '$projectname'"); //atualizar status e cor dos modelos
            header(('Location: Manage-Projects.php'));
            
        }else{
            die("Project not found! Make sure you created the project on projects page.");
        }
        
        /**if(!file_exists('/internal/userfiles/'.$uid.'/projects/'.$projectname)){
            die("This project doesnt exist!");
        } **/
    }
    $page_title = "Files";

?>
 <!-- <script>
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

 


    </script> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title." | ".$fn; ?></title>
    <link href="Files.css" rel="stylesheet">
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
         <div class="dashboard-ui">
       
       
         <div class="createproject">
                <form action="newProject.php" method="Post">
                    <h1>New Project</h1>
                    <input name="newprojectname"  type="text" id="newpname" class="textinput" placeholder="Insert Project Name"></input><br>
                    <button name="createproject" class="createprojectbtn" type="submit">Create project</button>  
                </form>
            </div>
            <hr class="vertical" />

            <div class="filePage">
              <form action="" enctype="multipart/form-data" method="POST">
                    <!-- <input type="text" name="projectn" class="ProjectNameInput" placeholder="Project Name"></input> -->                    
                    <div class="drop-zone">
                        <span class="drop-zone__prompt"><img src="../img/folder_upload.png" width="128" height="128"><br>Drop your GLTF file here.</span><span class="or">Or</span><br>
                        <span class="browsebtn">Browse Files</span> 
                        <input accept="gltf/glb" type="file" name="modelUpload" class="drop-zone__input" id="">
                        
                    </div>
                    <!-- <select name="projectselection" id="dropdown-projects"> -->
                        <?php 
                        $sql3 = "SELECT * FROM projects WHERE uid = '$uid'";
                        $resulta = $conexao->query($sql3);
                        
                        
                        if ($resulta->num_rows != 0) {
                            echo "<select id='dropdown-projects' name='projectselection'>";
                            // output data of each row
                            while($row = mysqli_fetch_array($resulta, MYSQLI_ASSOC)) {
                              echo "<option value='" . $row['projectname'] . "'>" . $row['projectname'] . "</option>";
                            }
                            echo "</select>";
                        } 
                        ?>
                    <button name="upload" class="uploadbtn" type="submit">Upload Model</button>  
    


                </form>
                </div>
                
                <script>
                            document.querySelectorAll(".drop-zone__input").forEach(inputElement =>{
                                const dropZoneElement = inputElement.closest(".drop-zone");

                                dropZoneElement.addEventListener("click", e =>{
                                    inputElement.click();
                                });

                                inputElement.addEventListener("change", e =>{
                                    if(inputElement.files.length){
                                        updateThumbnail(dropZoneElement, inputElement.files[0]);
                                    }
                                });

                                dropZoneElement.addEventListener("dragover", e =>{
                                    e.preventDefault();
                                    dropZoneElement.classList.add("drop-zone--over");
                                });

                                ["dragleave", "dragend"].forEach(type => {
                                    dropZoneElement.addEventListener(type, e=>{
                                        dropZoneElement.classList.remove("drop-zone--over");
                                        });
                                    });
                                    dropZoneElement.addEventListener("drop", e => {
                                        e.preventDefault();
                                        
                                        if(e.dataTransfer.files.length){
                                            inputElement.files = e.dataTransfer.files;
                                            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
                                        }

                                        dropZoneElement.classList.remove("drop-zone--over");
                                    });
                                });

                                function updateThumbnail(dropZoneElement, file){
                                    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
                                   
                                    if(dropZoneElement.querySelector(".drop-zone__prompt")){
                                        dropZoneElement.querySelector(".drop-zone__prompt").remove();
                                        dropZoneElement.querySelector(".browsebtn").remove();
                                        dropZoneElement.querySelector(".or").remove();
                                        
                                    }
                                   
                                    if(!thumbnailElement){
                                        thumbnailElement = document.createElement("div");
                                        thumbnailElement.classList.add("drop-zone__thumb");
                                        dropZoneElement.appendChild(thumbnailElement);
                                    }

                                    thumbnailElement.dataset.label = file.name;
                                }
                        </script>

         </div>
        </div>
</div>
</body>
</html>