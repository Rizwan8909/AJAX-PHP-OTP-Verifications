<?php
    session_start();
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
            $_SESSION['session_email'] = $email;
            // Now mailing the OTP code to user via mail function
            // $to="";
            // $from="";
            // $message="";
            // $headers = "";

            echo "email_exist";
        }
        else{
            echo "email_not_exist";
        }

        // Function to send a mail to user
        function smtp_mailer($to, $subject, $message){
            
        }
    }
    else{
        die("Can't connect to database");
    }
   
?>