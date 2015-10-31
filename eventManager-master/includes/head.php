<html>
<head>
    <title>BookMyEvent</title>
    <link href="bootstrapAssets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <script type="text/javascript" src="bootstrapAssets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="includes/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="formretain.js"></script>
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
        <li class=""><a href="http://www.cse.iitk.ac.in">IITK CSE</a></li>
        </ul>
        
        <?php
        if(!empty($_SESSION['username']) && !empty($_COOKIE['username']))
            echo '
                <div id="logout">
                <a href="logout.php"><span id="logoutButton" class="label label-important">Logout</span></a>
                </div>
            ';
        ?>
        <!--<li class="active"><a href="#">Link</a></li>-->
               
        </div>
    </div>


