
<?php 
    include('includes/head.php');
    session_start();
?>
<p><br><br><br></p>
    <div id="content">
        <h4>An open portal for members of the CSE department to book events for the rooms CS101 and CS102.</h4><br>
        
        <center><h5 id="assignText">[Created as an assignment for CS251]</h5></center><br>
        <center><h3 id="loginText">On your right is the login/register panel!!</h3><!--<img id="arrow" src="arrow.jpg" width="20%" height="10%">--></center>
    </div>  

    <div id="form">
    <center>
            
            <form action='loginCheck.php' method='POST'>
                Username  <input type='text' name='username' class="span3" placeholder="Username"><br>
                Password  <input type='password' name='password' class="span3" placeholder="Password"><br>
                <button type="submit" class="btn">Log in</button>
            </form>
            <br>
            <?php
            /*if(isset($_SESSION['username']))
                echo "hello"; */
            if( isset($_SESSION['username']) && isset($_COOKIE['username']) )
            {
                echo '
                    <a href="member.php">
                        <div class="btn-group">
                        <button class="btn" id="continueButton">You are already logged in! Continue</button>
                        </div>
                    </a><br>
                ';
            }
            else
            {
                echo '
                    <a href="member.php">
                        <div class="btn-group">
                        <button class="btn" id="continueButton">Continue without logging in!</button>
                        </div>
                    </a><br>  
                ';
            }
            ?>
            <a href="register.php" id="register">    
                <div class="btn-group">
                    <button class="btn" id="registerButton">Register</button>
                </div><!--<span class="label label-success">Register</span>-->
            </a><br>
            </center>
        </div>
</body>
</html>