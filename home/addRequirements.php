<?php
include("../includes/fetch_css.php");
include("../includes/connect.php");
  
if(isset($_SESSION['email']))
{
    $emailid = $_SESSION['email'];

    $query1 = "SELECT * FROM requirements WHERE Email='$emailid'";
    $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));

    if(mysqli_num_rows($result1) == 0) 
    {
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
                <title>AutoARTS | ADD REQUIREMENTS</title>
            </head>
            <body>
                <?php
                    include("../includes/header.php");
                ?>
                <div class="addReqBody">
                    <h1>Before proceeding, let us know your requirements to help us make accurate recommendations.</h1>
                    <br>
                    <hr style="background-color:black;">
                </div>
                <div class="container">
                    <br>
                    <br>
                    <form autocomplete="off" method="POST" action="../includes/addRequirements.php">
                        <h4>1. How much experience are you looking for?</h4>
                        <br>
                        <div style="display:flex;">
                            <h6 class="addReqRes">>>&emsp;Duration: </h6>
                            &emsp;
                            <input type="number" min="0" minlength="1" maxlength="2" class="form-control" id="duration" name="duration" style="width:70px;" required>
                            &emsp;
                            <h6 class="addReqRes">months</h6>
                        </div>
                        <br>
                        <br>
                        <hr>
                        <br>
                        <h4>2. What skills must the candidates have?</h4>
                        <br>
                        <div style="display:flex;justify-content:space-between;">
                            <div>
                                <h6 class="addReqRes">>>&emsp;Language:</h6>
                                <br>
                                <div id="addNewLanguage">
                                    
                                </div>
                                <h6 class="addNewLink" onclick="addNewLanguage()">+ Add New</h6>
                            </div>

                            <div>
                                <h6 class="addReqRes">>>&emsp;Application Technology:</h6>
                                <br>
                                <div id="addNewApplicationTechnology">
                                    
                                </div>
                                <h6 class="addNewLink" onclick="addNewApplicationTechnology()">+ Add New</h6>
                            </div>
                            
                            <div>
                                <h6 class="addReqRes">>>&emsp;Miscellaneous:</h6>
                                <br>
                                <div id="addNewMiscellaneous">
                                    
                                </div>
                                <h6 class="addNewLink" onclick="addNewMiscellaneous()">+ Add New</h6>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <h4>3. Tell us about the education requirements?</h4>
                        <br>
                        <div style="display:flex;">
                            <h6 class="addReqRes">>>&emsp;10th Standard Percentage: </h6>
                            &emsp;
                            <input type="number" min="0" max="100" class="form-control" id="percentage10" name="percentage10" style="width:70px;" required>
                            &emsp;
                            <h6 class="addReqRes">%</h6>
                        </div>
                        <br>
                        <div style="display:flex;">
                            <h6 class="addReqRes">>>&emsp;12th Standard Percentage: </h6>
                            &emsp;
                            <input type="number" min="0" max="100" class="form-control" id="percentage12" name="percentage12" style="width:70px;" required>
                            &emsp;
                            <h6 class="addReqRes">%</h6>
                        </div>
                        <br>
                        <div style="display:flex;">
                            <h6 class="addReqRes">>>&emsp;Current College CGPA: </h6>
                            &emsp;
                            <input type="number" min="0" max="10" step="any" class="form-control" id="cgpa" name="cgpa" style="width:70px;" required>
                            &emsp;
                            <h6 class="addReqRes">CGPA</h6>
                        </div>
                        <br>
                        <br>
                        <hr>
                        <br>
                        <br>
                        <div class="form-group">
                            <center>
                                <button type="submit" class="button-login2" style="vertical-align:middle;width:30%;" id="addReq" name="addReq"><span>PROCEED </span></button>
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

                <script>

                    var languageNumber = 0;
                    var appNumber = 0;
                    var miscNumber = 0;

                    function addNewLanguage()
                    {

                        var values = ["Assembly Language", "C/C++", "C#", "Dart", "Fortran", "Go", "Haskell", "HTML/CSS", "Java", "Javascript", "Kotlin", "MATLAB", "Objective-C", "Perl", "PHP", "Python", "R", "Ruby", "Rust", "Scala", "Swift", "SQL", "Typescript"];

                        languageNumber++;

                        var datalist = document.createElement("datalist");
                        datalist.id = "skillsLanguage" + languageNumber;

                        for (const val of values) 
                        {
                            var option = document.createElement("option");
                            option.text = val;
                            datalist.appendChild(option);
                        }

                        var h6 = document.createElement("h6");
                        h6.innerHTML = ">>&emsp;";
                        h6.classList.add("addReqRes");

                        var div = document.createElement("div");
                        div.style.display = "flex";

                        var br = document.createElement("br");

                        var langListID = "skillsLanguage" + languageNumber;
                        var input = document.createElement("input");
                        input.type = "text";
                        input.setAttribute('list', langListID);
                        input.classList.add("form-control");
                        input.style.width = "200px";
                        input.placeholder = "Enter any Language";
                        input.name = langListID;

                        div.appendChild(h6);
                        div.appendChild(input);
                        div.appendChild(datalist);

                        document.getElementById("addNewLanguage").appendChild(div);
                        document.getElementById("addNewLanguage").appendChild(br);

                        var action1 = 'action1';
                        $.ajax({
                            url: '../includes/updateNum.php',
                            method: 'POST',
                            data:{action1:action1, languageNumber:languageNumber},
                            success:function(data){
                                console.log(data);
                            }
                        });
                    }

                    function addNewApplicationTechnology()
                    {

                        var values = ["AWS", "ASP.NET", "Android", "Django", "ExpressJS", "Flutter", "Flask", "GCP", "IBM Cloud", "iOS Native", "LAMP", "Laravel", "Azure", "NodeJS", "Oracle", "React", "React Native", "Spring", "VMWare", "WAMP", "Xamarin", "XAMPP"];

                        appNumber++;

                        var datalist = document.createElement("datalist");
                        datalist.id = "skillsApp" + appNumber;

                        for (const val of values) 
                        {
                            var option = document.createElement("option");
                            option.text = val;
                            datalist.appendChild(option);
                        }

                        var h6 = document.createElement("h6");
                        h6.innerHTML = ">>&emsp;";
                        h6.classList.add("addReqRes");

                        var div = document.createElement("div");
                        div.style.display = "flex";

                        var br = document.createElement("br");

                        var appListID = "skillsApp" + appNumber;
                        var input = document.createElement("input");
                        input.type = "text";
                        input.setAttribute('list', appListID);
                        input.classList.add("form-control");
                        input.style.width = "200px";
                        input.placeholder = "Enter any Technology";
                        input.name = appListID;

                        div.appendChild(h6);
                        div.appendChild(input);
                        div.appendChild(datalist);

                        document.getElementById("addNewApplicationTechnology").appendChild(div);
                        document.getElementById("addNewApplicationTechnology").appendChild(br);

                        var action2 = 'action2';
                        $.ajax({
                            url: '../includes/updateNum.php',
                            method: 'POST',
                            data:{action2:action2, appNumber:appNumber},
                            success:function(data){
                                console.log(data);
                            }
                        });
                    }

                    function addNewMiscellaneous()
                    {

                        var values = ["Linux", "MS Office", "SDLC", "SEO", "Shell Script", "Systems Design", "UI/UX Design"];

                        miscNumber++;

                        var datalist = document.createElement("datalist");
                        datalist.id = "skillsMisc" + miscNumber;

                        for (const val of values) 
                        {
                            var option = document.createElement("option");
                            option.text = val;
                            datalist.appendChild(option);
                        }

                        var h6 = document.createElement("h6");
                        h6.innerHTML = ">>&emsp;";
                        h6.classList.add("addReqRes");

                        var div = document.createElement("div");
                        div.style.display = "flex";

                        var br = document.createElement("br");

                        var miscListID = "skillsMisc" + miscNumber;
                        var input = document.createElement("input");
                        input.type = "text";
                        input.setAttribute('list', miscListID);
                        input.classList.add("form-control");
                        input.style.width = "200px";
                        input.placeholder = "Enter any Skill";
                        input.name = miscListID;

                        div.appendChild(h6);
                        div.appendChild(input);
                        div.appendChild(datalist);

                        document.getElementById("addNewMiscellaneous").appendChild(div);
                        document.getElementById("addNewMiscellaneous").appendChild(br);

                        var action3 = 'action3';
                        $.ajax({
                            url: '../includes/updateNum.php',
                            method: 'POST',
                            data:{action3:action3, miscNumber:miscNumber},
                            success:function(data){
                                console.log(data);
                            }
                        });
                    }

                </script> 

            </body>
        </html>
<?php
    }
    else
    {
        header('location: ../home/upload.php');
    }
}
else
{
    header('location: ../home/login.php');
}
?>
