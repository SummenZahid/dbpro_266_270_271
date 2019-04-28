<?php 
   ob_start();
   require 'header.php';
   require 'db.php';
   if(isset($_POST['login'])){
          $email = $_POST['email']; 
          $password = $_POST['password'];
      $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
      $statement = $connection -> prepare($sql);
      $statement->execute();
      $user = $statement->fetchAll(PDO::FETCH_OBJ);
      if($user != null){
         $_SESSION['login'] = true;
         $_SESSION['user_ID'] = $user[0]->userID;
         $_SESSION['user_RoleID'] = $user[0] ->RoleID;
         if($user[0] ->roleID == 1){
            header('Location:user.php');
         }
         else{
            header('Location:index.php');
         }
         ob_enf_fluch();
      }else{
         
      }
   }
   
   ?>
<div class="container">
   <div class="row" style="margin-top:20px">
      <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
         <form role="form" method="POST" action="" class="custom">
            <fieldset>
               <hr>
               <h2 style="margin: 0px auto; margin-top: 2%; font-weight: 700; margin-bottom: 1%; font-size: 36px; margin-left: 47%;">Sign In!</h2>
               <br>
               <hr class="colorgraph">
               <br>
               <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" required="">
               </div>
               <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required="">
               </div>
               <br>
               <hr class="colorgraph">
               <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                     <button style="color: white; width: 515px; font-size: 16px; height: 42px; margin-left: 374px; margin-bottom: -9px; background-color: #E74C3C; border: none; font-weight: 700;cursor:pointer;" name="login" id="login" class="btn btn-lg btn-danger btn-block">Sign In</button>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                     <p style="margin: 0px auto; margin-top: 2%;margin-left: 42%;">Dont have an account? <a href="register.php">Register here</a></p>
                  </div>
               </div>
               <br>
               <hr>
            </fieldset>
         </form>
      </div>
   </div>
</div>
<?php require 'footer.php'; ?>