<?php
    require("../includes/connect.php");
    include("../includes/fetch_css.php");
    require_once "../vendor/autoload.php";
    include("../includes/aws_ses_config.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
?>    
<?php
    $confirm = "";
    $type = "";
    if(isset($_REQUEST['confirmOTP'])) 
    {
        $name = $_SESSION['prov_name'];
        $email = $_SESSION['prov_email'];
        $password = $_SESSION['prov_password'];
        $otp = $_SESSION['otp'];
        if($otp == $_POST['OTP'])
        {
            $query = "INSERT INTO user (Name, Email, Password) VALUES('$name', '$email', '$password')";
            mysqli_query($con, $query);
            $_SESSION['email'] = $email;
            $confirm = "OTP Matched!";

            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;       
            $mail->isSMTP();
                        
            $mail->setFrom($sender, $senderName);
            $mail->Username   = $usernameSmtp;
            $mail->Password   = $passwordSmtp;
            $mail->Host       = $host;
            $mail->Port       = $port; 
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'tls';

            $mail->addAddress("$email", "$name");
            $mail->isHTML(true);
            $mail->Subject = "Welcome to AutoARTS";
            $mail->Body = "<body>"
                            . "<br>"
                            . "<center>"
                                . "<h2 style='letter-spacing:3px;color:#212a2f;'>Hey, ".$name."!<h2>"
                                . "<h1 style='letter-spacing:3px;color:#212a2f;'>WELCOME TO AUTOARTS<h1>"
                                . "<br>"
                            . "</center>"
                            . "<br>"
                        . "</body>";
            $mail->AltBody = "WELCOME TO AUTOARTS";
            $mail->send();
        }
        else
        {
            $confirm = "Incorrect OTP!";
        }
    }
?>
<html>
    <head>
        <title>AutoARTS | VERIFY EMAIL</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link href="<?php echo $cssfilename; ?>" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        include("../includes/header.php");
        ?>
        
        <div class="container-fluid text-center" id="banner-signup" style="margin-top:60px;padding-top:60px;">
            <h2 style="margin-top:50px;text-decoration:underline;margin-bottom:75px;color:black;">Enter OTP</h2>
            <form method="POST" action="">
                <div class="form-group" style="display:flex; justify-content:center;">
                    <input class="otpInput" style="font-weight:700;letter-spacing:20px;width:185px;" type="tel" minlength="6" maxlength="6" name="OTP" id="OTP" required>
                </div>
                <div class="form-group">    
                    <button type="submit" class="button10 button105" style="vertical-align:middle" id="confirmOTP" name="confirmOTP"><span>CONFIRM</span></button>
                </div>
            </form>
            <?php
            if($confirm == "Incorrect OTP!")
            {
                echo "<p style='font-size:14px;color:red;'><b>$confirm</b></p>"; 
            }
            else
            {
                if($confirm == "OTP Matched!")
                {
                ?>
                    <script>
                        location.href = "../home/manage.php";
                    </script>
                <?php
                }
            }
            ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>  
        
        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>     
    </body>
</html>