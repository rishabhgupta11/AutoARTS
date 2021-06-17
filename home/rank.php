<?php declare(strict_types=1) ?>
<?php
require("../includes/connect.php");
include("../includes/fetch_css.php");
if(isset($_SESSION["email"]))
{
    $email = $_SESSION["email"];
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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Stint+Ultra+Condensed&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>AutoARTS | RANK</title>
    </head>
    <body>
        <?php
            include("../includes/header.php");
        ?>

        <div class="manageBody">
            <h3 style="text-decoration: underline;">Navigate</h3>
            <br>
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
            <?php
            $query = "SELECT * FROM applicants WHERE Email='$email' ORDER BY Star, Score DESC";
            $result = mysqli_query($con, $query);
            $total = mysqli_num_rows($result);
            $number = 0;
            ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h3 style="text-decoration:underline;">All Applicants </h3>
                    &nbsp;&nbsp;
                    <h5 style="margin-top:7px;">(<?php echo $total; ?>)</h5>
                </div>  
                <div>
                    <div class="d-flex">
                        <button onclick="reset_func()" class="btn btn-danger" style="display:inline;">
                            <span class="material-icons" style="vertical-align:middle;">restart_alt</span>
                            <span style="vertical-align:middle;">Reset</span>
                        </button>
                        &emsp;&emsp;&emsp;
                        <button onclick="downloadExcel_func()" class="btn btn-success" style="display:inline;">
                            <span class="material-icons" style="vertical-align:middle;">download</span>
                            <span style="vertical-align:middle;">Download Excel</span>
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <?php
            if($total == 0){
                echo "<center><h4 style='margin:100px;'>No Resumes Uploaded!</h4></center>";
            }
            else{
                while($row = mysqli_fetch_array($result)){
                    $number++;
                    $applicantEmail = $row['ApplicantEmail'];
                    $applicantResume = $row['FileName'];
            ?>
                    <div class="container-fluid applicant-card">
                    <br>
                        <div class="d-flex justify-content-between align-items-center" style="padding-left:20px;padding-right:20px;">
                            <div class="d-flex flex-column" style="width:275px;">
                                <div class="d-flex justify-content-between">
                                    <h5 style="color:black;"><?php echo strtoupper($row['ApplicantName']); ?></h5>
                                    <?php
                                    if($row['Star'] == 1){
                                    ?> 
                                        <span title="Remove Star" style="color:gold;cursor:pointer;" onclick="star_func<?php echo $number; ?>('<?php echo $applicantEmail; ?>')" id="star<?php echo $number; ?>" class="material-icons">star</span>
                                    <?php
                                    }
                                    else{
                                    ?>
                                        <span title="Star Applicant" style="cursor:pointer;" onclick="star_func<?php echo $number; ?>('<?php echo $applicantEmail; ?>')" id="star<?php echo $number; ?>" class="material-icons">star_border</span>
                                    <?php
                                    }
                                    ?>
                                    <span class="material-icons" title="Delete Applicant Permanently" onclick="delete_func<?php echo $number; ?>('<?php echo $applicantEmail; ?>')" style="cursor:pointer;">delete</span>
                                </div>
                                <h5 style="color:#17a2b8;margin-bottom:40px;"><?php echo $applicantEmail; ?></h5>
                                &emsp;&emsp;
                                <button onclick="viewResume_func<?php echo $number; ?>('<?php echo $applicantResume; ?>')" class="btn btn-info" style="display:inline;">
                                    <span class="material-icons" style="vertical-align:middle;">description</span>&nbsp;
                                    <span style="vertical-align:middle;">View Resume</span>
                                </button>
                            </div>

                            <div id="donut<?php echo $number; ?>">

                            </div>

                            <div>
                                <h4>Score</h4>
                                <h1 style="font-family: 'Stint Ultra Condensed', cursive; color:#17a2b8; font-size: 60px;"><?php echo $row['Score']; ?></h1>
                            </div>
                        </div>
                    <br>
                    </div>
                    <br>
                    <br>
            <?php
                }
            }
            ?>
        </div>

        <div id="footer">
        <?php
            include("../includes/footer.php");
        ?>
        </div>   
         
        <script>
            google.charts.load('current', {'packages':['corechart']});

            function reset_func(){
                if(confirm("This will delete all your uploaded resumes. Are you sure you want to reset?"))
                {
                    var action = 'action';
                    $.ajax({
                        url: '../includes/reset.php',
                        method: 'POST',
                        data:{action:action},
                        success:function(data){
                            console.log(data);
                            location.href = "../home/upload.php";
                        }
                    });
                }
            }

            function downloadExcel_func()
            {
                location.href = "../includes/download-excel.php";
            }

            <?php
            for($i=1;$i<=$number;$i++)
            {
            ?>
                function star_func<?php echo $i; ?>(applicantEmail)
                {
                    var isStar = document.getElementById("star<?php echo $i; ?>").innerText;
                    if(isStar === 'star_border')
                    {
                        document.getElementById("star<?php echo $i; ?>").innerHTML="star";
                        document.getElementById("star<?php echo $i; ?>").style.color="gold";
                        var action = 'action';
                        $.ajax({
                            url: '../includes/star-add.php',
                            method: 'POST',
                            data:{action:action, applicantEmail:applicantEmail},
                            success:function(data){
                                console.log(data);
                            }
                        });
                    }
                    else
                    {
                        document.getElementById("star<?php echo $i; ?>").innerHTML="star_border";
                        document.getElementById("star<?php echo $i; ?>").style.color="black";
                        $.ajax({
                            url: '../includes/star-remove.php',
                            method: 'POST',
                            data:{applicantEmail:applicantEmail},
                            success:function(data){
                                console.log(data);
                            }
                        });
                    }
                }

                function delete_func<?php echo $i; ?>(applicantEmail)
                {
                    if(confirm("Are you sure you want to delete this permanently?"))
                    {
                        var action = 'action';
                        $.ajax({
                            url: '../includes/delete-applicant.php',
                            method: 'POST',
                            data:{action:action, applicantEmail:applicantEmail},
                            success:function(data){
                                console.log(data);
                                location.href = "../home/rank.php";
                            }
                        });
                    }
                }

                function viewResume_func<?php echo $i; ?>(applicantResume)
                {
                    var action = 'action';
                        $.ajax({
                            url: '../includes/view-resume.php',
                            method: 'POST',
                            data:{action:action, applicantResume:applicantResume},
                            success:function(data){
                                window.open(data);
                            }
                        });
                }

                google.charts.setOnLoadCallback(drawChart<?php echo $i; ?>);
                function drawChart<?php echo $i; ?>() {

                    var jsonData = $.ajax({
                        url: "../includes/get-projects.php",
                        method: "POST",
                        data:{number:<?php echo $i; ?>},
                        async: false,
                        dataType: "json"
                    }).responseText;

                    var data = new google.visualization.DataTable(jsonData);

                    var options = {
                        pieHole: 0.3,
                        height: 200
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('donut<?php echo $i; ?>'));

                    chart.draw(data, options);
                }
            <?php
            }
            ?>
        </script>

    </body>
</html>

<?php
}
else
{
    header('location: ../home/login.php');
}
?>