<?php 
   ob_start();
   require 'header.php';
   require 'db.php'; 
   $sql_i = "SELECT count(*) as totalusers from user ";
   $statement_i = $connection -> prepare($sql_i);
   $statement_i->execute();
   $users = $statement_i->fetchAll(PDO::FETCH_OBJ);
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

    <div class="container">
        <div class="col-md-3">
            <?php foreach ($rara as $susu): ?>
                <div class="card-counter danger">
                    <i class="fa fa-ticket"></i>
                    <span class="count-numbers"><?php echo $susu->totalchef."<br />";?></span>
                    <span class="count-name">Chef</span>
                </div>
                <?php endforeach; ?>
        </div>
        <?php foreach ($users as $allusers): ?>
            <div class="col-md-3">
                <div class="card-counter primary">
                    <i class="fa fa-code-fork"></i>
                    <span class="count-numbers"><?php echo $allusers->totalusers."<br />";?></span>
                    <span class="count-name">All User</span>
                </div>
                <?php endforeach; ?>
            </div>

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