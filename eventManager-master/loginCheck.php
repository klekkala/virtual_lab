<?php
include 'includes/head.php';
session_start();

$username=$_POST['username'];
$password=$_POST['password'];

if ($username&&$password) {
    
    $connect=mysql_connect("localhost","root","") or die("Couldn't connect!");
    
    mysql_select_db("cs251") or die("Couldn't find db!");

    
    $query=mysql_query("SELECT * FROM users WHERE username='$username'");
    

    $numrows=mysql_num_rows($query);
    if($numrows!=0){
        while($row=mysql_fetch_assoc($query))
        {
            $dbusername=$row["username"];
            $dbpassword=$row['password'];
        }

        //check to see if they match
        if($username==$dbusername && md5($password)==$dbpassword)
        {
            

            include "success.php";
            
            $_SESSION['username']=$dbusername;
            $_SESSION['password']=$dbpassword;
            setcookie("username",$_SESSION['username'],time()+2*60*60,"/");
            //setcookie("password", $_SESSION['password'], time()+60*60*5, "/");
        }
        else{
            echo "<center><div class='alert' style='width:250'><!--<button type='button' class='close' data-dismiss='alert'>x</button>-->
            <strong>Incorrect password!</strong></div>
            </center>";
        }
    }
    else
        die("<center><div class='alert' style='width:250'><!--<button type='button' class='close' data-dismiss='alert'>x</button>-->
            <strong> User doesn't exist!</strong></div>
            </center>");

}

else
    die("<center><div class='alert' style='width:450'><!--<button type='button' class='close' data-dismiss='alert'>x</button>-->
            <strong>Please enter a username and password!</strong></div>
            </center>");

?>



