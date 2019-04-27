<?php
require 'db.php';
$foodID = $_GET['foodID'];
$sql = 'DELETE FROM fooditem WHERE foodID=:foodID';
$statement = $connection->prepare($sql);
if ($statement->execute([':foodID'=> $foodID])){
	header("Location: index.php");
}
?>