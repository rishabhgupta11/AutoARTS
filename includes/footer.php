<footer>
    <div class="container-fluid">
        <div class="row footer-text text-center">
            <div class="col-md">
                <a href="../home/index.php">    
                    <img src="../images/logo01.png" style="width:75px;height:75px;">
                    <h3>AutoARTS</h3>
                </a>
            </div>
            <div class="col-md offset-md-2">
                <p class="footer-heading">GET TO KNOW US</p>
                <a href="../home/about.php">About</a><br>
                <a href="https://ngenza.com/home/terms-of-service.php">Terms of Use</a><br>
                <a href="https://ngenza.com/home/privacy-policy.php">Privacy Policy</a><br>
            </div>
            <?php
            if(!isset($_SESSION['email']))
            {
            ?>
            <div class="col-md">
                <p class="footer-heading">LET US HELP YOU</p>
                <a href="../home/login.php">Login</a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <center>
            <p style="font-size:13px;">Contact Us: contact@autoarts.com | &copy; 2021 AutoARTS. All Rights Reserved.</p>
        </center>
    </div>
</footer>
