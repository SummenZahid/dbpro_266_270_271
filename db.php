<?php

$dsn = 'mysql:host=localhost;dbname=db23';
$username = 'root';
$password = '';
$options = [];


try{
	 $connection = new PDO($dsn , $username, $password, $options);
}
catch(PDOException $e){

}
?>