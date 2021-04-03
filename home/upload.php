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
        <title>AutoARTS | UPLOAD</title>
    </head>
    <body>
        <?php
            include("../includes/header.php");
        ?>

        <div class="manageBody">
            <div class="container-fluid icons-div">
                <div class="icon">
                    <a href="../home/upload.php" title="Upload Resumes">
                        <img src="../images/Uploading.png" width="80px">
                    </a>
                </div>

                <div class="icon">
                    <a href="../home/rank.php" title="View Ranked Applicants">
                        <img src="../images/Success.png" width="80px">
                    </a>
                </div>

                <div class="icon">
                    <a href="../home/bestFit.php" title="View Best Suited Applicants">
                        <img src="../images/Welcome.png" width="80px">
                    </a>
                </div>
            </div>
            <br>
            <br>
            <hr style="background-color:black;">
            <br>
            <br>
            <h3 style="text-decoration: underline;">Upload Resumes</h3>
            <br>
            <br>
            <form action="../includes/uploadFiles.php" method="POST" enctype="multipart/form-data">         
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="file[]" multiple>
                        <label class="custom-file-label" for="inputGroupFile01">
                            Drag and Drop Files Here or Click to Browse
                            <br>
                            <span class="material-icons" style="font-size:50px;color:#495057;">
                                upload_file
                            </span>
                        </label>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="form-group">
                    <center>
                        <button type="submit" class="button-login2" style="vertical-align:middle;width:30%;" id="uploadFiles" name="uploadFiles"><span>UPLOAD </span></button>
                    </center>
                </div>
            </form>
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

