<?php
    session_start();
	if (isset($_SESSION['login'])) {
		header('Location:index.php');
	}
?>
<?php require 'header.php'; ?>
<div class="container">

<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

    <?php
    	if(isset($_GET['msg'])){
    		 echo "<div class='alert alert-danger'>"+$_GET['msg']+"</div>";
    	}
      if(isset($_POST['submit'])){
        $username = $_POST['email']; $password = $_POST['password'];
        if($username === 'admin@gmail.com' && $password === 'admin123'){
          $_SESSION['login'] = true;
        } {
          echo "<div class='alert alert-danger'>Username and Password do not match.</div>";
        }

      }
    ?>
		<form role="form" method="POST">
			<fieldset>
				<h2>Please Sign In</h2>
				<br>
				<hr class="colorgraph">
				<br>
				<div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address">
				</div>
				<div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
				</div>
				<br>
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <button type="submit" name="submit" id="submit" class="btn btn-lg btn-success btn-block">Sign In</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

</div>
<?php require 'footer.php'; ?>
