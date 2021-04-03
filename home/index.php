<?php
    include("../includes/fetch_css.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?php echo $cssfilename; ?>" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>AutoARTS | HOME</title>
    </head>
    <body>
        <?php
            include("../includes/header.php");
        ?>
        
        <div class="container-fluid hero">
            <div class="container hero-content">
                <div class="row">
                    <div class="col-xs-12 col-md-8 hero-content-text">
                        <h4><b>Automated Applicant Ranking and Tracking System</b></h4>
                        <br>
                        <h5>A web application designed for companies to simplify the recruitment process</h5>
                        <br>
                        <h6 class="getStartedButton" onclick="location.href='../home/upload.php'">GET STARTED</h6>
                    </div>
                    <div class="col-xs-12 col-md-4 hero-content-image">
                        <img src="../images/hero-image.jpg" width="300px">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container home-description">
            
        </div>
        
        <div id="footer">
        <?php
            include("../includes/footer.php");
        ?>
        </div>    
    </body>
</html>

