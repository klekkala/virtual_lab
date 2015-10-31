<?php
	session_start();
	include "includes/head.php";
    echo '
        <script language="javascript" type="text/javascript" src="dateTimePick/datetimepicker.js">
        </script>
    ';
    if (empty($_SESSION['username'])||empty($_COOKIE['username'])) {         
        die('
        <div id="nav">
        <ul class="nav nav-pills nav-stacked" id="list">
            <li><a href="member.php">Next 7 days</a></li>
            <li class="active"><a href="manage.php">Book new event</a></li>
            <li><a href="myBookings.php">My Bookings</a></li>
        </ul>
        </div>
        <center><div class="alert" style="width:500px;">
        <strong>Warning!</strong> You must be logged in to see this page. <a href="index.php">Go to start page and login</a>
        </div></center>
        ');
    }
	echo '
        <div id="nav">
        <ul class="nav nav-pills nav-stacked" id="list">
            <li><a href="member.php">Next 7 days</a></li>
            <li class="active"><a href="manage.php">Book new event</a></li>
            <li><a href="myBookings.php">My Bookings</a></li>
        </ul>
        </div>
    ';
    $connect=mysql_connect("localhost","root","");
	mysql_select_db("cs251");
	$username=$_SESSION['username'];
    
	if (isset($_POST['submit']))
    {
    
        if($_POST['event']&&$_POST['dateTime']&&$_POST['room'])
        {  
            $event=strip_tags($_POST['event']);
            $dateTime=strip_tags($_POST['dateTime']);
            $room=strip_tags($_POST['room']);
            if(strlen($event)>100)
            {
                echo "Max limit for event description is 100";
            }
            else
            {
                $array=explode(' ',$dateTime);
                $date=$array[0];
                $time=$array[1];

                $dateArray=explode('-',$date);

                switch ($dateArray[1]) 
                {
                    case 'Jan':
                        $date=$dateArray[0]."-01-".$dateArray[2];
                        break;
                    
                    case 'Feb':
                        $date=$dateArray[0]."-02-".$dateArray[2];
                        break;

                    case 'Mar':
                        $date=$dateArray[0]."-03-".$dateArray[2];
                        break;

                    case 'Apr':
                        $date=$dateArray[0]."-04-".$dateArray[2];
                        break;
                    
                    case 'May':
                        $date=$dateArray[0]."-05-".$dateArray[2];
                        break;

                    case 'Jun':
                        $date=$dateArray[0]."-06-".$dateArray[2];
                        break;

                    case 'Jul':
                        $date=$dateArray[0]."-07-".$dateArray[2];
                        break;

                    case 'Aug':
                        $date=$dateArray[0]."-08-".$dateArray[2];
                        break;

                    case 'Sep':
                        $date=$dateArray[0]."-09-".$dateArray[2];
                        break;

                    case 'Oct':
                        $date=$dateArray[0]."-10-".$dateArray[2];
                        break;

                    case 'Nov':
                        $date=$dateArray[0]."-11-".$dateArray[2];
                        break;

                    case 'Dec':
                        $date=$dateArray[0]."-12-".$dateArray[2];
                        break;
                }

                $date=date("d-m-Y",strtotime($date));
                $connect=mysql_connect("localhost","root","");
                mysql_select_db("cs251");

                $queryCheck=mysql_query("
                    SELECT * FROM events WHERE date='$date'
                ");
                $num=mysql_num_rows($queryCheck);
                if($queryCheck)
                {
                    while($row = mysql_fetch_array($queryCheck))
                    {
                        $time0=$row['time'];
                        //$time0=date("h:i:s A",strtotime($time0));
                        $time1=strtotime('+1 hour',strtotime($time0));
                        if(strtotime($time)>=strtotime($time0) && strtotime($time)<=$time1 && $row['room']==$room)
                        {
                            //echo "3";
                            die("
                            <center>
                                <div class='alert' style='width:450px;'>
                                    An event already exists from ".date('h:i A',strtotime($time0))." to ".date('h:i A',$time1)."!<a href='manage.php'> Book again</a>
                                </div>
                            </center>
                            ");
                        }
                
                    }
                }
                
                $queryBook=mysql_query("
                INSERT INTO events VALUES ('$username','$event','$date','$time','$room')
                ");
                die('<center><div class="alert alert-success" style="width:250px;">
                    <strong>Booking successful!</strong>
                    </div></center>');
            }      
        }
        else
        {
        //echo "<center><h1> Register </h1></center><br>";
        echo "Please fill in <b>all</b> values!";
        }
    }

?>

<div id="bookForm">
<center>
    <h3>Form for adding new bookings</h3> <br>
    <form action="manage.php" method='POST' id="addBooking">
    <table>
        <tr>
            <td>Event Description:  </td>
            <td><input type ='text' name='event' placeholder="Event Details"></td>
        </tr>
        <tr>
            <td>Pick date and time: </td>
            <td>
                <input type="text" name="dateTime" id="dateTime" maxlength="25" size="25" placeholder="Date and time of your event">
                    <a href="javascript:NewCal('dateTime','ddmmmyyyy',true,24)">
                    <img src="dateTimePick/cal.gif" width="16" height="16" border="0" alt="Pick a date">
                    </a>
            </td>
        </tr>
        <tr>
            <td>
                Select Room: 
            </td>
            <td>
                <select name="room">
                    <option>Select Room</option>
                    <option value="CS101">CS101</option>
                    <option value="CS102">CS102</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <center><button type="submit" class="btn" name="submit">Book</button></center>
        </td>
            <!--<input type='submit' value='Register' name='submit'>-->
        </tr>
    </table>
    </form>
</center>
</div>
</body>
</html>