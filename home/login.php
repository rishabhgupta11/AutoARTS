<?php
    require("../includes/connect.php");
    include("../includes/google_signin.php");
    include("../includes/facebook_signin.php");
    include("../includes/fetch_css.php");
?>    
<html>
    <head>
        <title>AutoARTS | LOGIN</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?php echo $cssfilename; ?>" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
    </head>
    <body>
        <div id="banner-signup-1"></div>
            <div class="container">
                <div id="Signup">
                    <div class="row">
                        <?php
                        if(!isset($_SESSION['email']))
                        {
                        ?>
                        <div class="col-md offset-md-1 login-card">
                            <p class="create-acc" style="margin-bottom:20px;">LOGIN</p>
                            <br>
                            <form autocomplete="off" method="post" action="../includes/server.php">
                                <div class="form-group">
                                    <input type="email"  class="form-control login-field" name="email" id="email" placeholder="Email" required>
                                </div>
                                <div class="form-group form-password">
                                    <input type="password"  class="form-control login-field" name="password" id="password" placeholder="Password" required>
                                </div>
                                <div style="margin-bottom:20px;">
                                    <a class="forgot-password" data-toggle="modal" data-target="#exampleModal">Forgot Password</a>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <button type="submit" class="button-login2" style="vertical-align:middle" id="login_user" name="login_user"><span>SIGN IN </span></button>
                                    </center>
                                </div>
                            </form>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border:0px;">
                                            <h6 class="modal-title" id="exampleModalLabel"><b>ENTER E-MAIL</b></h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form autocomplete="off" method="POST" action="../home/forgot_password.php">
                                                <div class="form-group">
                                                    <input type="email"  class="form-control login-field" name="forgot_email" id="forgot_email" required>
                                                </div>
                                                <div class="form-group">
                                                    <center>
                                                        <button type="submit" class="button-login2" style="vertical-align:middle" id="search_email" name="search_email"><span> SEND OTP </span></button>
                                                    </center>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="container or-login-with">
                            <?php
                                echo '<i>'.$login_button.'</i>';
                                if(isset($facebook_login_url))
                                {
                                    echo '<i style="padding-top:5px;">'.$facebook_login_but.'</i>';
                                }
                            ?>    
                            </div>
                            <br>
                        </div>

                        <div class="col-md offset-md-3 login-card">
                            <p class="create-acc" style="margin-bottom:20px;">CREATE AN ACCOUNT</p>
                            <br>
                            <form autocomplete="off" method="post" action="../includes/server.php">
                                <div class="form-group">
                                    <input type="text"  class="form-control login-field" id="name" name="name" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email"  class="form-control login-field" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password"  minlength="6" maxlength="30" class="form-control login-field" id="password_1" name="password_1" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password"  minlength="6" maxlength="30" class="form-control login-field" id="password_2" name="password_2" placeholder="Confirm Password" required>
                                </div>
                                <br>
                                <br>
                                <div class="form-group">
                                    <center>
                                        <button type="submit" class="button-login2" style="vertical-align:middle" id="reg_user" name="reg_user"><span>REGISTER </span></button>
                                    </center>
                                </div>
                            </form>
                        </div>
                        <?php
                        }
                        else
                        {
                        ?>
                            <div class="offset-md-4 col-md-4 col-xs-12">
                                <center>
                                    <h3 style="margin:200px 0px 200px 0px;">You are already signed in!</h3>
                                </center>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
             
    </body>
</html>

