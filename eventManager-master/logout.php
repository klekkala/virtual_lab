<!--<script type="text/javascript">
	$(".alert").alert();
</script>-->
<?php
	session_start();
	include "includes/head.php";

	session_unset();
	session_destroy();
	setcookie("username","", time()-3600);
	echo '
		<div id="nav">
            <ul class="nav nav-pills nav-stacked" id="list">
              <li class="active"><a href="member.php">Next 7 days</a></li> 
              <li><a href="manage.php">Book new event</a></li>
              <li><a href="myBookings.php">My Bookings</a></li>
            </ul>
    	</div>
		<center><div class="alert" id="logoutAlert" style="width:450px;">
  		<!--<button id ="close" type="button" class="close" data-dismiss="alert">&times;</button>-->
  		<strong>You have been logged out.</strong> Click <a href="index.php">here</a> to go to start page.
	</div></center>';

?>
