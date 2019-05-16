<?php

$dsn = 'mysql:host=localhost;dbname=db23';
$username = 'root';
$password = '';
$options = [];

$conn=mysqli_connect("localhost","root","","db23");

try{
	 $connection = new PDO($dsn , $username, $password, $options);
}
catch(PDOException $e){

}
?>