<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="Sidemenu/design.css" rel="stylesheet"> 
</head>
<body>
<div class="sidebar">
<div class="logo_content">
    <div class="logo">
        <div class="logo_name">Nexar</div>
    </div>
    <i class='bx bx-menu-alt-left' id="btn"></i>
</div>
<ul class="nav_list">
<li>
    <a href="#">
        <i class='bx bx-grid-alt' ></i>
        <span class="link_name">Dashboard</span>
    </a>
    <span class="tooltip">Dashboard</span>
</li>

<li>
    <a href="#">
        <i class='bx bx-user-circle' ></i>
        <span class="link_name">User Preferences</span>
    </a>
    <span class="tooltip">User Preferences</span>
</li>

<li>
    <a href="#">
        <i class='bx bx-folder-open' ></i>
        <span class="link_name">Create new Project</span>
    </a>
    <span class="tooltip">Create new Project</span>
</li>

<li>
    <a href="#">
        <i class='bx bx-copy-alt' ></i>
        <span class="link_name">Manage Projects</span>
    </a>
    <span class="tooltip">Manage Projects</span>
</li>

<li>
    <a href="#">
        <i class='bx bx-crown' ></i>
        <span class="link_name">Upgrade Plan</span>
    </a>
    <span class="tooltip">Upgrade Plan</span>
</li>

<li>
    <a href="#">
        <i class='bx bx-message-square-dots' ></i>
        <span class="link_name">Support</span>
    </a>
    <span class="tooltip">Support</span>
</li>

</ul>
<div class="profile_content">
    <div class="profile">
        <div class="profile_details">
            <img src="<?php if(!empty($user_data['profilepic'])){ echo $user_data['profilepic']; }else{ echo " "; } ?>" alt="">
            <div class="name_job">
                <div class="name"><?php echo $usrname; ?></div>
                <div class="job"><?php echo $plan; ?></div>
            </div>
        </div>
        <a href="../out.php"> <i class='bx bx-log-out' id="log_out"></i></a>
    </div>
</div>
</div>


</body>
<script>
    let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");

    btn.onclick = function(){
        sidebar.classList.toggle("active");
    }
</script>
</html>