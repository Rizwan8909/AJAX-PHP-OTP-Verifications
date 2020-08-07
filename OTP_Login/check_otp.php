<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "otp_auth");
    if($conn){
        $email = $_SESSION['session_email'];
        $otp= $_POST['userOTP'];
        $sql = "SELECT * FROM `otp_login` WHERE `user_email` = '$email' AND `otp` = '$otp'";
        $result = $conn->query($sql);
        $count = $result->num_rows;
        if($count>0){
            
            // Reseting the otp
            $sql = "UPDATE `otp_login` SET `otp` = '' WHERE `user_email` = '$email'";
            $result = $conn->query($sql);
            echo "correct_otp";
        }
        else{
            echo "incorrect_otp";
        }
    }
    else{
        die("Can't connect to database");
    }
