<?php
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
?> 
<nav class="navbar navbar-expand-lg container-fluid" id="header">
    <div id="mySidebar" class="sidebar">
        <div id="changingMenu">
            <hr>
            <div class="nav-item" style="margin-top:8px;">
                <a class="nav-link headerOption" href="../home/index.php">HOME</a>
            </div>
            <hr>
            <?php 
            if(!isset($_SESSION['email'])) 
            { 
            ?> 
                <div class="nav-item" style="margin-top:8px;">
                    <a class="nav-link headerOption" href="../home/login.php">LOGIN</a>
                </div>
            <?php
            }
            else
            {
            ?>
                <div class="nav-item" style="margin-top:8px;">
                    <a class="nav-link headerOption" href="../home/upload.php">MY ACCOUNT</a>
                </div>
            <?php
            }
            ?>
            <hr>
            <div class="nav-item" style="margin-top:8px;">
                <a class="nav-link headerOption" href="../home/about.php">ABOUT</a>
            </div>
            <hr>
        </div>
        <?php 
        if(isset($_SESSION['email'])) 
        { 
        ?> 
            <div class="sidebarBottomMenu">
                <a href="../includes/logout.php" title="Logout">
                    <div style="display:flex;">
                        <p style="margin-top:1px;margin-bottom:1px;font-size:14px;font-weight:600">LOGOUT</p>&nbsp;
                        <span class="material-icons">keyboard_arrow_right</span>
                    </div>
                </a>
            </div>
        <?php 
        } 
        ?>
    </div>
    
    <div class="container-fluid w-100" style="padding:0px;">
        <div class="row w-100" style="margin:0px;">
            <div class="col-6">
                <a class="navbar-brand" href="../home/index.php">
                    <img src="../images/logo01.png" alt="AutoARTS" style="margin-left:8px;width:50px;height:50px;">
                    &nbsp;
                    <span style="display:inline-block;font-size:25px;vertical-align:-5px;">AutoARTS</span>
                </a>
            </div>

            <div class="col-6" style="display:flex; justify-content:flex-end; padding-left:10px; padding-top:6px;">
                <div class="navbar-burger-menu-div">
                    <button class="openbtn" onclick="toggleNav()" style="padding-bottom:0px;padding-top:8px;">
                        <span id="navbar-burger-menu-option" class="material-icons" style="color:#212a2f;font-size:37px;">menu</span>
                    </button>
                </div>

                <div class="navbar-collapse collapse order-lg-0" style="margin-top:7px;">
                    <ul class="navbar-nav" style="padding-left:60vw;">
                        <li class="nav-item">
                            <a class="nav-link headerOption" href="../home/index.php">HOME</a>
                        </li>
                        <?php
                        if(!isset($_SESSION['email']))
                        {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link headerOption" href="../home/login.php">LOGIN</a>
                        </li>
                        <?php
                        }
                        else
                        {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link headerOption" href="../home/upload.php">MY ACCOUNT</a>
                        </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link headerOption" href="../home/about.php">ABOUT</a>
                        </li>
                        <?php 
                        if(isset($_SESSION['email'])) 
                        { 
                        ?>
                            <li class="nav-item">
                                <a class="nav-link headerOption" href="../includes/logout.php">LOGOUT</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleNav() 
    {
        var x = document.getElementById("navbar-burger-menu-option").innerHTML;
        if(x == "menu")
        {
            document.getElementById("mySidebar").style.width = "100%";
            document.getElementById("navbar-burger-menu-option").innerHTML="close";
        }
        else
        {
            if(x == "close")
            {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("navbar-burger-menu-option").innerHTML="menu";
            }
        }
    }
</script>