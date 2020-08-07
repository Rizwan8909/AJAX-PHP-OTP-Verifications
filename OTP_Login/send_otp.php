<?php
    $conn = new mysqli("localhost", "root", "", "otp_auth");
    if($conn){
        $email=$_POST['userEmail'];
        $sql = "SELECT * FROM `otp_login` WHERE `user_email` = '$email'";
        $result = $conn->query($sql);
        $count = $result->num_rows;
        if($count>0){
            // Generating a random OTP
            $otp = rand(11111, 99999);

            // Updating the database with new OTP
            $sql = "UPDATE `otp_login` SET `otp` = '$otp' WHERE `user_email` = '$email'";
            $result = $conn->query($sql);
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