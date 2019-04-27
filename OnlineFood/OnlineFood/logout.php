<?php   
	ob_start();
   session_start(); //to ensure you are using same session
   session_unset();
   session_destroy();
   header("location:index.php"); 
   ob_enf_fluch();//to redirect back to "index.php" after logging out
   exit();
  ?>