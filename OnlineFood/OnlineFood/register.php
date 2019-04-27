<?php 
   ob_start();
    require 'header.php'; 
    require 'db.php';
    $message = '';
    if (isset($_POST['register'])) {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $Lusername = $_POST['Lusername'];
      $contact = $_POST['contact'];
      $role = $_POST['role'];
      if ($role == "Chef") {
        $roleID = 1;    
      }
      else{
        $roleID = 2;    
      }
   
   
       $sqli = "SELECT * FROM user WHERE email ='$email' or username = '$username'";
       $stm = $connection ->prepare($sqli);
       $stm->execute([':username'=> $username ,':email'=> $email]);
       if($stm->rowCount() > 0 ){    
          header('Location:register.php?msg="This user Already Exist! Enter a Unique Email or Name"');
          ob_enf_fluch();
       }
       else{
          $sql = 'INSERT INTO user(Email, PhoneNo , Fname , Lname, Password, RoleID) VALUES(:email,:contact,:Lusername, :username, :password, :role)';
          $statement = $connection->prepare($sql);
          if ($statement -> execute([':email'=> $email ,':contact'=> $contact ,':username'=> $username ,':Lusername'=> $Lusername ,':password'=> $password , ':role' => $roleID])); 
          {
             $message = 'User Successfully Register';
          }
          if($roleID == 1){
            header('Location:submit.php');
          }
          elseif ($roleID == 2) {
            header('Location:index.php');
          }
       }
   }
    if (isset($_POST['login'])) {
      header('Location:login.php');
     ob_enf_fluch();
    }
    ?>
<div class="container">
   <div class="row" style="margin-top:20px">
      <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
         <?php if (!empty($message)): ?>
         <div class="alert alert-success">
            <?php echo "$message"; ?>
         </div>
         <?php endif; ?>
         <form role="form" method="POST" action="" class="custom">
            <fieldset>
               <hr>
               <h2 style="margin: 0px auto; margin-top: 2%; font-weight: 700; margin-bottom: 1%; font-size: 36px; margin-left: 42%;">Register Now!</h2>
               <br>
               <hr class="colorgraph">
               <br>
               <?php if (isset($_GET['msg'])) : ?>
               <div class="alert alert-warning" style="margin-left: 382px; margin-bottom: 24px; width: 500px; margin-top: -28px; background-color: #ffcad3; text-align: center; color: black;">
                  <strong>Warning!</strong> <?php echo (isset($_GET['msg'])) ? $_GET['msg'] : null; ?>
               </div>
               <?php endif; ?>
               <div  class="form-group">
                  <input  type="text" name="username" id="username" class="form-control input-lg" placeholder="FirstName" required="">
               </div>
               <div  class="form-group">
                  <input  type="text" name="Lusername" id="Lusername" class="form-control input-lg" placeholder="Lastname" required="">
               </div>
               <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" required="">
               </div>
               <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required="">
               </div>
               <div class="form-group">
                  <input type="text" name="contact" id="contact" class="form-control input-lg" placeholder="Contact" required="">
               </div>
               <div class="form-group">
                  <select name="role" id="role" style="margin: auto; margin-left: 32%; margin-right: 39%; width: 42%; height: 49px; font-size: 15px;">
                    <option >Chef</option>
                    <option >User</option>
                  </select>
               </div>
               <br>
               <hr class="colorgraph">
               <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                     <button style="color: white; width: 515px; font-size: 16px; height: 42px; margin-left: 374px; margin-bottom: -9px; background-color: #E74C3C; border: none; font-weight: 700;cursor:pointer;"  type="submit" name="register" id="register" class="btn btn-lg btn-success btn-block">Register</button>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                     <p style="margin: 0px auto; margin-top: 2%;margin-left: 42%;">Already have an account? <a href="login.php">Sign In</a></p>
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