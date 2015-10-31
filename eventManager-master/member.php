<?php

session_start();
if (empty($_SESSION['username'])||empty($_COOKIE['username'])) 
{    
  include('includes/head.php');
  echo '
      <div id="nav">
        <ul class="nav nav-pills nav-stacked" id="list">
          <li class="active"><a href="member.php">Next 7 days</a></li> 
          <li><a href="index.php">Go to start page and login</a></li>
          <li><a href="manage.php">Book new event</a></li>
          <li><a href="myBookings.php">My Bookings</a></li>
        </ul>
      </div>
    ';  

}

else
{

echo '
  <html>
  <head>
    <title>BookMyEvent</title>
    <link href="bootstrapAssets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <script type="text/javascript" src="bootstrapAssets/js/bootstrap.js"></script>
    <script type="text/javascript" src="includes/jquery.min.js"></script>
    <style type="text/css">
      #tableHeading{
        padding: 100px;
      }
    </style>
  </head>
  <body>
    
    <div class="hero-unit" id="header">
      <center>
          <h1>BookMyEvent</h1>
          <p>Event Manager</p>
        </center>
    </div>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
        <a class="brand" href="/cs251Assign4/index.php">Home</a>
        <ul class="nav">
        <li><a href="http://www.iitk.ac.in">IITK</a></li>
        <li><a href="http://www.cse.iitk.ac.in">IITK CSE</a></li>
        </ul>
        <div id="logout">
        <a href="logout.php"><span id="logoutButton" class="label label-important">Logout</span></a>
        </div>
        </div>
    </div>
    
    <div id="nav">
            <ul class="nav nav-pills nav-stacked" id="list">
              <li class="active"><a href="member.php">Next 7 days</a></li> 
              <li><a href="manage.php">Book new event</a></li>
              <li><a href="myBookings.php">My Bookings</a></li>
            </ul>
            <div id="nav">
    </div>
    </div>
    ';
} 
      
$currentDate = date("d/m/Y", time()); 
$date=$currentDate;
      //echo $currentDate; 
    

echo '
  <div id="table">
  <!--<center>-->
  <table border="1" width="90%">
  <COLGROUP span="3">
  <tr id="tableHeading">
    <th>Date</th>
    <th>Room No.</th>
    <th id="eventColumn">Event</th>
    <th>Time</th>
    <th>Created by</th>
    </tr>
    </COLGROUP>
';
      
  $connect1=mysql_connect("localhost","root","") or die("Couldn't connect!");
  mysql_select_db("cs251") or die("Couldn't find db!");
      
  for($i=0;$i<=7;$i++)
  {
      $date=date('d-m-Y', strtotime('+'.$i.' days'));
      $result=mysql_query("SELECT * FROM events where date='$date'");

      $numrows=mysql_num_rows($result);
      if(1)
      {
        if($numrows)
        $row = mysql_fetch_array($result);
        echo '
          <tr width="30%">
          <td rowspan="'.($numrows).'"><center>'.$date.'</center></td>
          <td><center>
        ';
        if($numrows){ echo $row['room']; }
          echo '
            </center></td>
            <td><center>
          ';
        if($numrows){ echo $row['event']; }
          echo '
            </center></td>
            <td><center>
          ';
        if($numrows){
          echo date("h:i A",strtotime($row["time"])).'</td>';
        }
        else echo '</center></td>';
        echo '<td><center>';
        if($numrows){ echo $row['user']; }
        echo '</center></td></tr>';
      
        while($row = mysql_fetch_array($result))
        {
          echo '
            <tr>
              <td><center>'.$row['room'].'</center></td>
              <td><center>'.$row['event'].'</center></td>
              <td><center>';
          if($row['time'])
          {
            echo date("h:i A",strtotime($row["time"])).
            '
            </center></td>
          ';
            }
            else echo '</center></td>';
          echo '
              <td><center>'.$row['user'].'</center></td>
            </tr>
          ';
        }
      }
  }
  echo '
    </table>
  </div>
  </body>
</html>
';

?>