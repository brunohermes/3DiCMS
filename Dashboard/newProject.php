<?php
 if(isset($_POST['createproject'])){
    include_once('../includes/config.php');
    include_once('master.php');

    $sql2 = "SELECT * FROM users WHERE email = '$logado'";
    $resulto = $conexao->query($sql2);
    $user_data = mysqli_fetch_assoc($resulto);
    $email = $logado;
    $date = date('Y-m-d');
    $status = "Waiting for 3D Model";
    $sttcolor = "warning";
    $uid = hash('adler32', $email);
    $dPath = 'internal/userfiles/';
    $pname = $_POST['newprojectname'];
    $consult = mysqli_query($conexao, "SELECT * FROM projects WHERE uid='$uid' AND projectname='$pname'");
        if(mysqli_num_rows($consult)){
            exit('You already have a project called '.$pname);
            header(('Location: Files.php'));
        }else if (!file_exists($dPath.$uid.'/'.$pname)) {
                mkdir($dPath.$uid.'/projects/'.$pname, 0777, true);
                $projectpath = $dPath.$uid.'/projects/'.$pname;
                header(('Location: Manage-Projects.php'));
                $src = 'internal/Source';
                $dst = $projectpath;
                $files = glob("internal/Source/*.*");
                      foreach($files as $file){
                      $file_to_go = str_replace($src,$dst,$file);
                      copy($file, $file_to_go);
                      }


                $result = mysqli_query($conexao, "INSERT INTO projects(projectname, uid, projectpath, date, status, cst) 
            VALUES('$pname','$uid','$projectpath','$date', '$status', '$sttcolor')");
            $result = mysqli_query($conexao, "UPDATE resources SET projects = projects + 1 WHERE uid = '$uid'");
                
        }
 }

?>