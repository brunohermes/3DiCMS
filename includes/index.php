<?php
/** include('../Dashboard/master.php');
**/
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body{
            background-image: linear-gradient(to bottom right, #2d3854, #181e2e);
            padding:0px;
            margin: 0px;
            overflow: hidden;
        }
        .viewerr{
           
            width: 100vw;
            height: 90vh;  
        }
        .nav-container{
            
            position: absolute;

        }
    </style>
</head>
<body>
    <!-- <div class="nav-container">
        <nav class="navigation">
            Menu
        </nav>
    </div> -->
    <script type="module" src="model-viewer.js"></script>
    <model-viewer class="viewerr" alt="TESTE" src="model.glb" ar ar-modes="webxr scene-viewer quick-look" environment-image="sky.hdr"  shadow-intensity="1" camera-controls enable-pan></model-viewer>
    
</body>
</html>