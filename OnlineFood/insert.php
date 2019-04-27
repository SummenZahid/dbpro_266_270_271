<?php 
   
   $con = mysqli_connect('localhost' , 'root' , '');
   if (!con)
   {
   	echo 'Not connected';
   }
   if(!mysqli_select_db($con, 'db23'))
   {
   	echo 'Database not selected';
   }
   $Name = $_POST['name'];
   $Email = $_POST['email'];
   $Comments = $_POST['comments'];
    $sql = "INSERT INTO reviews (Name , Email , Comments) Values('$Name' , '$Email', '$Comments');
    
    if(!mysqli_query($con , $sql))
    {
    echo 'not inserted';
    }
    else
    {
    echo 'inserted';
    }
   header('Location:index.php');
     
?>