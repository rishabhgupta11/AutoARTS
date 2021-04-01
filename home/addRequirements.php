<?php
    include("../includes/fetch_css.php");
    include("../includes/connect.php");

    $number = 1;
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
                        <button type="submit" class="button-login2" style="vertical-align:middle;width:30%;" id="reg_user" name="reg_user"><span>PROCEED </span></button>
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

                var values = ["-- Select Language --", "Assembly Language", "C/C++", "C#", "Dart", "Fortran", "Go", "Haskell", "HTML/CSS", "Java", "Javascript", "Kotlin", "MATLAB", "Objective-C", "Perl", "PHP", "Python", "R", "Ruby", "Rust", "Scala", "Swift", "SQL", "Typescript"];

                languageNumber++;

                var select = document.createElement("select");
                select.name = "skillsLanguage" + languageNumber;
                select.id = "skillsLanguage" + languageNumber;
                select.classList.add("form-control");
                select.style.width = "200px";

                for (const val of values) 
                {
                    var option = document.createElement("option");
                    option.value = val;
                    option.text = val;
                    select.appendChild(option);
                }

                var h6 = document.createElement("h6");
                h6.innerHTML = ">>&emsp;";
                h6.classList.add("addReqRes");

                var div = document.createElement("div");
                div.style.display = "flex";

                var br = document.createElement("br");

                div.appendChild(h6);
                div.appendChild(select);

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

                var values = ["-- Select Technology --", "Amazon Web Services", "ASP.NET", "Android Native", "Django", "ExpressJS", "Flutter", "Flask", "Google Cloud Platform", "IBM Cloud", "iOS Native", "LAMP", "Laravel", "Microsoft Azure", "NodeJS", "Oracle", "React", "React Native", "Spring", "VMWare", "WAMP", "Xamarin", "XAMPP"];

                appNumber++;

                var select = document.createElement("select");
                select.name = "skillsApp" + appNumber;
                select.id = "skillsApp" + appNumber;
                select.classList.add("form-control");
                select.style.width = "200px";

                for (const val of values) 
                {
                    var option = document.createElement("option");
                    option.value = val;
                    option.text = val;
                    select.appendChild(option);
                }

                var h6 = document.createElement("h6");
                h6.innerHTML = ">>&emsp;";
                h6.classList.add("addReqRes");

                var div = document.createElement("div");
                div.style.display = "flex";

                var br = document.createElement("br");

                div.appendChild(h6);
                div.appendChild(select);

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

                var values = ["-- Select Skill --", "Linux", "MS Office Suite", "SDLC Models", "Search Engine Optimization", "Shell Script", "Systems Design", "UI/UX Design"];

                miscNumber++;

                var select = document.createElement("select");
                select.name = "skillsMisc" + miscNumber;
                select.id = "skillsMisc" + miscNumber;
                select.classList.add("form-control");
                select.style.width = "200px";

                for (const val of values) 
                {
                    var option = document.createElement("option");
                    option.value = val;
                    option.text = val;
                    select.appendChild(option);
                }

                var h6 = document.createElement("h6");
                h6.innerHTML = ">>&emsp;";
                h6.classList.add("addReqRes");

                var div = document.createElement("div");
                div.style.display = "flex";

                var br = document.createElement("br");

                div.appendChild(h6);
                div.appendChild(select);

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
