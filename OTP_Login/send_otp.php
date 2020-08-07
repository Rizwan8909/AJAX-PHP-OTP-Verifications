<?php
    $conn = new mysqli("localhost", "root", "", "otp_auth");
    if($conn){
        $email=$_POST['userEmail'];
        $sql = "SELECT * FROM `otp_login` WHERE `user_email` = '$email'";
        $result = $conn->query($sql);
        $count = $result->num_rows;
        if($count>0){
            echo "email_exist";
        }
        else{
            echo "email_not_exist";
        }
    }
    else{
        die("Can't connect to database");
    }
   
?>