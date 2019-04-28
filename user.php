<?php 
   ob_start();
   require 'header.php';
   if(!isset($_SESSION['login'])){
   
   header('Location:login.php?msg="Please Login First"');
   ob_enf_fluch();
   }
   require 'db.php';
   if(isset($_SESSION['user_ID'])){
   $id = $_SESSION['user_ID'];
   $sql = "SELECT * FROM fooditem WHERE  userID ='$id'";
   $statement = $connection -> prepare($sql);
   $statement->execute();
   $re = $statement->fetchAll(PDO::FETCH_OBJ);
   $idd = 1;
   }
   ?>
<div class="container">
   <div class="card mt-5">
      <br><br>
      <div class="card-header">
         <h2>All Items</h2>
      </div>
      <hr>
      <table id="customers">
         <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Action</th>
         </tr>
         <?php if ($re): ?>
         <?php foreach($re as $r): ?>
         <tr>
            <td><?= $idd++?></td>
            <td>
               <a href="recipe.php?foodID=<?= $r->foodID?>" style="text-decoration: none; color: black; cursor: pointer;"><?= $r->Name; ?>
               <a>
            </td>
            <td><a href="edit.php?foodID=<?= $r->foodID?>" style="position: center; color: white;"  class = "button12">Edit</a>
            <a onclick="return confirm('Are you sure to delete this recipe?')"  href="delete.php?foodID=<?= $r->foodID?>" style="position: center; background-color: #CB4335;color: white;" class = "button12">Delete</a>
            </td></td>
         </tr>
         <?php endforeach; ?>
      <?php endif; ?>
      </table>
      <br>
   </div>
</div>
<?php require 'footer.php'; ?>