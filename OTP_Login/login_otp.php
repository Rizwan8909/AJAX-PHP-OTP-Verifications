<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <title>OTP Login</title>
</head>

<body>

    <div class="container" style="width: 28rem;">
        <div class="card border-0 shadow my-5" id="box">
            <div class="card-header">
                <h5>Login With OTP</h5>
            </div>
            <div class="card-body mt-4 my-4">


                <form method="POST">
                    <div class="form-group first-box">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Please Enter your email" required>
                        <div id="email_error"></div>
                    </div>

                    <div class="form-group first-box">
                        <button type="button" id="send_otp_btn" class="btn btn-primary btn-block">Send OTP</button>
                    </div>

                    <div class="form-group second-box">
                        <small class="text-muted">*Check your email for your OTP code!</small>
                        <input type="text" class="form-control" id="OTP" name="OTP" placeholder="Please Enter your OTP" required>
                        <div id="otp_error"></div>
                    </div>

                    <div class="form-group second-box">
                        <button type="button" id="submit_otp_btn" class="btn btn-primary btn-block">Submit OTP</button>
                    </div>

                </form>


            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>

<script>
    $(document).ready(function() {

        // Code for sending OTP
        $('#send_otp_btn').click(function() {
            var email = $('#email').val();

            if ($.trim(email).length > 0) {

                $.ajax({
                    url: 'send_otp.php',
                    type: 'POST',
                    data: 'userEmail=' + email,
                    // data: {userEmail: email} They both are same
                    beforeSend: function() {
                        $('#send_otp_btn').val('Sending.....');
                    },
                    success: function(data) {
                        if (data == "email_exist") {
                            $('.second-box').show();
                            $('.first-box').hide();
                            $('#send_otp_btn').val('Send OTP');
                        }

                        if (data == "email_not_exist") {
                            $('#email_error').html('<small class="text-danger">*Please enter a valid email!</small>')
                        }
                    }
                });
            } else {

                $('#email_error').html('<small class="text-danger">*Please fill the email field!</small>');

                // After 3 seconds it will remove the error
                setTimeout(() => {
                    $('#email_error').html('');
                }, 3000);
            }
        });


        // Code for Submiting OTP
        $('#submit_otp_btn').click(function() {
            var otp = $('#OTP').val();

            if ($.trim(otp).length > 0) {

                $.ajax({
                    url: 'check_otp.php',
                    type: 'POST',
                    data: 'userOTP=' + otp,
                    // data: {userEmail: email} They both are same
                    beforeSend: function() {
                        $('#submit_otp_btn').val('Submitting.....');
                    },
                    success: function(data) {
                        if (data == "correct_otp") {
                            window.location = "dashboard.php";
                        }

                        if (data == "incorrect_otp") {
                            $('#otp_error').html('<small class="text-danger">*Please enter a valid OTP!</small>');
                            $('#submit_otp_btn').val('Submit OTP');
                        }
                    }
                });
            } else {

                $('#otp_error').html('<small class="text-danger">*Please Fill the otp field!</small>');

                // After 3 seconds it will remove the error
                setTimeout(() => {
                    $('#email_error').html('');
                }, 3000);
            }
        });
    });
</script>

<style>
    .second-box{
        display: none;
    }
</style>