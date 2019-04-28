<?php 
   ob_start();
   require 'header.php';
   require 'db.php'; 
   $sql = "SELECT count(*) as total from user WHERE RoleID = 2";
   $statement = $connection -> prepare($sql);
   $statement->execute();
   $rep = $statement->fetchAll(PDO::FETCH_OBJ);
    $sqli = "SELECT count(*) as totalchef from user WHERE RoleID = 1";
   $statementi = $connection -> prepare($sqli);
   $statementi->execute();
   $rara = $statementi->fetchAll(PDO::FETCH_OBJ);
    $sqlia = "SELECT count(*) as food from fooditem";
   $statementia = $connection -> prepare($sqlia);
   $statementia->execute();
   $ram = $statementia->fetchAll(PDO::FETCH_OBJ);
  
  

   ?>
   
<div style="height: 150px">
   
</div>
!-- <div class="container">
  <?php foreach ($rep as $alu): ?>
    <div class="row">
    <div class="col-md-3">
      <div class="card-counter primary">
        <i class="fa fa-code-fork"></i>
        <span class="count-numbers"><?php echo $alu->total."<br />";?></span>
        <span class="count-name">User</span>
      </div>
      <?php endforeach; ?>
    </div> --><
    
    <div class="col-md-3">
      <?php foreach ($rara as $susu): ?>
      <div class="card-counter danger">
        <i class="fa fa-ticket"></i>
        <span class="count-numbers"><?php echo $susu->totalchef."<br />";?></span>
        <span class="count-name">Chef</span>
      </div>
      <?php endforeach; ?>
    </div>
    

    <div class="col-md-3">
      <?php foreach ($ram as $lak): ?>
      <div class="card-counter success">
        <i class="fa fa-database"></i>
        <span class="count-numbers"><?php echo $lak->food."<br />";?></span>
        <span class="count-name">FoodItems</span>
      </div>
      <?php endforeach; ?>
    </div>

    
 
</div>
</div>



   
    
<div style="height: 150px"></div>

<?php require 'footer.php'; ?>