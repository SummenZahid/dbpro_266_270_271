
<?php
	session_start();
	if(!isset($_SESSION['login'])){

		header('Location:login.php?msg="Please Login First"');
	}
	require 'db.php';
	$sql = 'SELECT * FROM user WHERE RoleID = 1';
	$statement = $connection -> prepare($sql);
	$statement->execute();
	$re = $statement->fetchAll(PDO::FETCH_OBJ);
	$idd = 1;
?>

<?php require 'header.php'; ?>
<div class="container">
<hr>
	<div class="card mt-5">
		<div class="card-header">
			<h2>All Food Item</h2>
		</div>
		<hr>
		<div class="card-body">
			<table class="table table-bordered">
				<tr>
					<th>ID</th>
					<th colspan="3">Title</th>
					<th>Action</th>
				</tr>
				<?php foreach($re as $r): ?>
				<tr>
					<td><?= $idd++?></td>
					<td colspan="3"><?= $r->Fname; ?></td>
					<td>
					<a onclick="return confirm('Are you sure to delete this user?')"  href="delete.php?userID=<?= $r->userID?>" style="position: center;" class = "btn btn-danger">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
			<button name="logout" class="btn btn-lg btn-success btn-block" ><a style="text-decoration: none; color: white" href="logout.php" >Logout</a>
			<br></button>	

		</div>
		<br>
			
	</div>
</div>
    
<?php require 'footer.php'; ?>
