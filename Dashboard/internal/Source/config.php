<?php
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbNAme = 'Workspace';
    //Database connection
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbNAme);

    
    
    
    
/**
    if($conexao->connect_errno){
        echo "Erro";
    }else{
        echo "Conectado";
    }
*/
?>