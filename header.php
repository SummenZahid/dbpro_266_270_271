<?php
	session_start();
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<!-- Mirrored from www.vasterad.com/themes/chow/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 09 Jan 2019 07:49:48 GMT -->
<head>

<!-- Basic Page Needs
================================================== -->


<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/colors/green.css" id="colors">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style type="text/css">.colorgraph {
	  height: 5px;
	     margin-bottom: 20px;
    margin-top: -14px;
    margin-left: 373px;
	  width: 515px;
	  border-top: 0;
	  background: #c4e17f;
	  border-radius: 5px;
	  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	}
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #6a3131;
    padding: 8px;
    font-size: 14px;
    color: black;
    font-family: open sans,helveticaneue,helvetica neue,Helvetica,Arial,sans-serif;
    text-align: left;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  font-size: 17px;
    font-family: open sans,helveticaneue,helvetica neue,Helvetica,Arial,sans-serif;
    text-align: left;
  padding-bottom: 12px;
  text-align: left;
  background-color: #333;
  color: white;
}
	.button12 {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 7px 22px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
      margin: 3px 10px;
  cursor: pointer;
}
.buttona {
  background-color: #8dc63f; /* Green */
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  font-weight: 700;
  margin: 4px 2px;
  cursor: pointer;
}
.buttona:hover{
	background-color: gray;
}

.buttonb {padding: 10px 24px;}
.lead{
    background:#fff;
    padding:4%;
}
.button12 a{
	color: white;
	}

	.custom input[type=text], input[type=email], input[type=password]{
		width: 500px; height: 30px; font-size: 16px; padding: 10px; margin-bottom: 25px; margin-top: -14px; margin-left: 373px; font-family: open sans,helveticaneue,helvetica neue,Helvetica,Arial,sans-serif; border: 2px solid #E5E7E9; border-radius: 3px;
	}
	</style>
</head>

<body>

<!-- Wrapper -->
<div id="wrapper">


<!-- Header
================================================== -->
<header id="header">

<!-- Container -->
<div class="container">

	<!-- Logo / Mobile Menu -->
	<div class="three columns">
		<div id="logo">
			<h1><a href="index.php"><img style="    float: left;
    width: 166px;
    padding: 9px;
    margin: -69px;
    height: 147px;" src="images/logo1.png" alt="Chow" /></a></h1>
		</div>
	</div>


<!-- Navigation
================================================== -->
<div class="thirteen columns navigation">

	<nav id="navigation" class="menu nav-collapse">
		<ul>
			<li><a href="index.php" id="current">Home</a></li>
			<?php if (isset($_SESSION['login'] ) && $_SESSION['user_RoleID'] == 1 ): ?> 
				<li><a href="submit.php">Submit Recipe</a></li>
                <li><a href="user.php">My Account</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php elseif (isset($_SESSION['login']) && $_SESSION['user_RoleID'] != 1 ): ?>
				<li><a href="user.php">My Account</a></li>
				<li><a href="logout.php">Logout</a></li>
			<?php else: ?>
				<li onclick="return confirm('Please Login to submit recipe!');"><a href="#">Submit Recipe</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php" >Register</a></li>
			<?php endif; ?>
		</ul>
	</nav>

</div>

</div>
<!-- Container / End -->
</header>
