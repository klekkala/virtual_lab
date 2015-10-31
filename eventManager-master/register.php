<?php

include('includes/head.php');


if (isset($_POST['submit']))
{
	$username=strip_tags($_POST['username']);
	$fullName=strip_tags($_POST['fullName']);
	$password=strip_tags($_POST['password']);
	$repeatPassword=strip_tags($_POST['repeatPassword']);
	$email=strip_tags($_POST['email']);
	
	if($fullName&&$username&&$password&&$repeatPassword&&$email){
		

		if ($password==$repeatPassword) {
			if(strlen($username)>25||strlen($fullName)>100){
				echo "Max limit for username is 25 characters n that for full name is 100 characters";
			}
			else{
				if (strlen($password)>25||strlen($password)<3) {
					echo "Password must be between 3 and 25 characters.";
				}
				else{
					$password=md5($password);
					$repeatPassword=md5($repeatPassword);
					
					$connect=mysql_connect("localhost","root","");
					mysql_select_db("cs251");

					$queryRegister=mysql_query("
					INSERT INTO users VALUES ('','$username','$password','$fullName','$email')
					");

					die("<center>You have been registered! <a href='index.php'>Return to login page</a></center>");
				}
			}
			
		}
		else{
			//echo "<center><h1> Register </h1></center><br>";
			echo "Your passwords don't match!";

		}
		




	}
	else{
		//echo "<center><h1> Register </h1></center><br>";
		echo "Please fill in <b>all</b> values!";
	}
}

?>

<center><h1> Register </h1></center><br>

<center><form action="register.php" method='POST' id="form1">
	<table>
		<tr>
			<td>Choose a username:  </td>
			<td><input type ='text' name='username' ></td>
		</tr>
		<tr>
			<td>Your full name:  </td>
			<td><input type ='text' name='fullName' ></td>
		</tr>
		<tr>
			<td>Choose a password:  </td>
			<td><input type ='password' name='password'></td>
		</tr>
		<tr>
			<td>Repeat password:  </td>
			<td><input type ='password' name='repeatPassword'></td>
		</tr>
		<tr>
			<td>Email id:  </td>
			<td><input type ='text' name='email'></td>
		</tr>
	</table>
	<p>
		<button type="submit" class="btn" name="submit">Register</button>
		<!--<input type='submit' value='Register' name='submit'>-->
	</p>
</form>
		<!--<div class="btn-group">
            <button class="btn" type="submit" name="submit"> Register </button>
        </div>-->
</center>

</body>
</html>
