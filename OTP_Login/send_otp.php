<?php
    $conn = new mysqli("localhost", "root", "", "otp_auth");
    if($conn){
        echo $email=$_POST['userEmail'];
    }
    else{
        die("Can't connect to database");
    }
   
?>