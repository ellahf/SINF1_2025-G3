<?php
    if(isset($_SESSION["id"])) {
        
        $bd_host="localhost";
        $bd_user="root";
        $bd_password="";
        $bd_database="coalcollections";

        $mysqli = new mysqli($bd_host,$bd_user,$bd_password,$bd_database);
    
    } else {
        session_start();
        $bd_host="localhost";
        $bd_user="root";
        $bd_password="";
        $bd_database="coalcollections";
        $mysqli = new mysqli($bd_host,$bd_user,$bd_password,$bd_database);
    }
?>