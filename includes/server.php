<?php
require("../includes/connect.php");
require_once "../vendor/autoload.php";
include("../includes/fetch_css.php");
include("../includes/aws_ses_config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_REQUEST['reg_user'])) 
{
    $name = mysqli_real_escape_string($con, $_REQUEST['name']);
    $email = mysqli_real_escape_string($con, $_REQUEST['email']);
    $password_1 = mysqli_real_escape_string($con, $_REQUEST['password_1']);
    $password_2 = mysqli_real_escape_string($con, $_REQUEST['password_2']);
    if($password_1 == $password_2)
    {
        $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
        $result = mysqli_query($con, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if (!$user) 
        {
            $otp = rand(100000, 999999);
            
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
            $mail->Subject = "OTP For E-Mail Verification";
            $mail->Body = "<div>"
                            . "<br>"
                            . "<center>"
                                . "<h1 style='letter-spacing:10px;color:black;'>".$otp."<h1>"
                                . "<h4 style='letter-spacing:2px;color:black;'>is the OTP for your e-mail verification.</h4>"
                                . "<br>"
                                . "<h4 style='letter-spacing:2px;color:black;'>DO NOT SHARE YOUR OTP WITH ANYONE ELSE</h4>"
                                . "<h4 style='letter-spacing:2px;color:black;'>If this isn't you, kindly ignore this e-mail.</h4>"
                            . "</center>"
                            . "<br>"
                        . "</div>";
            $mail->AltBody = $otp." is the OTP for your e-mail verification.";
            try 
            {
                $mail->send();
            }
            catch (Exception $e) 
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }

            $_SESSION["prov_email"] = $email;

            $_SESSION["prov_name"] = $name;

            $password = md5($password_1);

            $_SESSION["prov_password"] = $password;

            $_SESSION["otp"] = $otp;
?>
            <script>
                if(confirm("An OTP has been sent to your e-mail successfully!"))
                {
                    location.href = "../home/verify-email.php";
                }
                else
                {
                    location.href = "../home/verify-email.php";
                }
            </script>
            <?php   
             
            
        }
        else
        {
        ?>
            <script>
                if(confirm("This E-mail Already Exists!\nTry Logging-in."))
                {
                    location.href = "../home/login.php";
                }
                else
                {
                    location.href = "../home/login.php";
                }
            </script>
        <?php    
        }   
    }
    else
    {
    ?>
        <script>
            if(confirm("PASSWORDS DO NOT MATCH!"))
            {
                location.href = "../home/login.php";
            }
            else
            {
                location.href = "../home/login.php";
            }
        </script>
    <?php
    }
}
?>
        
        
<?php
if (isset($_REQUEST['login_user'])) 
{
    $email = mysqli_real_escape_string($con, $_REQUEST["email"]);
    $password1 = mysqli_real_escape_string($con, $_REQUEST["password"]);

    
    $password = md5($password1);
    $query = "SELECT * FROM user WHERE Email='$email' AND Password='$password'";
    $results = mysqli_query($con, $query);
    $row = mysqli_fetch_array($results);
    if(mysqli_num_rows($results) == 1) 
    {
        $_SESSION['email'] = $email;
        header('location: ../home/upload.php');
    }
    else
    {
    ?>
        <script>
            if(confirm("Incorrect Email or Password!"))
            {
                location.href = "../home/login.php";
            }
            else
            {
                location.href = "../home/login.php";
            }
        </script>
    <?php
    }
}
?>