<?php 
   require 'header.php'; 
   require 'db.php'; 
   if( isset($_GET['foodID'])){
   	$id = $_GET['foodID'];
    $sqll = "SELECT count(*) as total from reviews WHERE foodID='$id'";
    $statementl = $connection -> prepare($sqll);
    $statementl->execute();
    $repl = $statementl->fetchAll(PDO::FETCH_OBJ);
   	$sql = "SELECT * FROM fooditem WHERE foodID='$id'";
   	$statement = $connection -> prepare($sql);
   	$statement->execute();
   	$re = $statement->fetchAll(PDO::FETCH_OBJ);
      $catagory = $re[0]->CatagoryID;
      $sqli = "SELECT * FROM fooditem ORDER BY CatagoryID ='$catagory' DESC LIMIT 0,3";
      $statementi = $connection -> prepare($sqli);
      $statementi->execute();
      $repe = $statementi->fetchAll(PDO::FETCH_OBJ);
   }
   if(isset($_GET['checkout'])){
    if(isset($_SESSION['user_ID'])){
      $userID = $_SESSION['user_ID'];
      if(!empty($_SESSION['shopping_cart'])){
        $sql = "INSERT INTO `order`(`Quantity`, `UserID`, `foodID`) VALUES ('2', '$userID', '2')";
        mysqli_query($conn, $sql);
        $order_id =  mysqli_insert_id($conn);
        $sql2 = "";
        foreach ($_SESSION['shopping_cart'] as $key => $value){
          $item_id =$value['item_id'];
          $item_quantity = $value['item_quantity'];
          $item_price = $value['item_price'];
          $sql2.= "INSERT INTO `orderitem`(`OrderID`, `FoodID`, `Quantity`, `UnitPrice`) VALUES ('$order_id', '$item_id', '$item_quantity', '$item_price');";
        }
        $conn->multi_query($sql2);

        unset($_SESSION['shopping_cart']);
      }
    }
      }

   if(isset($_POST['add_to_cart'])){
    if(isset($_SESSION['shopping_cart'])){
      $item_array_id = array_column($_SESSION['shopping_cart'], "item_id");
      if(!in_array($_POST['item_id'], $item_array_id)){
        $count = count($_SESSION['shopping_cart']);
        $item_array = array(
        'item_id' => $_POST['item_id'],
        'item_name' => $_POST['item_name'],
        'item_price' => $_POST['item_price'],
        'item_quantity' => $_POST['item_quantity'],
        'item_image' => $_POST['item_image']
      );
      $_SESSION['shopping_cart'][$count] = $item_array;
      }else{

      }
    }else{
      $item_array = array(
        'item_id' => $_POST['item_id'],
        'item_name' => $_POST['item_name'],
        'item_price' => $_POST['item_price'],
        'item_quantity' => $_POST['item_quantity'],
        'item_image' => $_POST['item_image']
      );
      $_SESSION['shopping_cart'][0] = $item_array;
   }
 }
   $message = '';
      if (isset($_POST['submit']))
{
    $userid = $_SESSION['user_ID'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $comments = $_POST['comments'];
    $rating = $_POST["rating"];
    $foodid = $id;


     $sql = 'INSERT INTO reviews(userID, Name , Email , Comments, FoodID, Rating) VALUES(:userid,:name,:email, :comments, :foodid, :rating)';

          $statement = $connection->prepare($sql);
          if ($statement -> execute([':userid'=> $userid ,':name'=> $name ,':email'=> $email ,':comments'=> $comments ,':foodid'=> $foodid , ':rating' => $rating])); 
          {
             $message = 'Reviews has been added.';
          }
          
       }
  if( isset($_GET['foodID'])){
    $id = $_GET['foodID'];
    $sqli = "SELECT * FROM reviews where foodID = '$id' ORDER BY foodID DESC LIMIT 0,4";
    $statementi = $connection -> prepare($sqli);
    $statementi->execute();
    $reli = $statementi->fetchAll(PDO::FETCH_OBJ);
 }
   ?>
<!-- Recipe Background -->
 <form method="POST">
<div class="recipeBackground">
   <img src="<?= $re[0]->picsource ?>" alt="" />
</div>

<!-- Content
   ================================================== -->
<div class="container" itemscope itemtype="http://schema.org/Recipe">
   <!-- Recipe -->
   <?php if($repl) : ?>
  <?php foreach ($repl as $alu): ?>
   <div class="twelve columns">
      <div class="alignment">
         <!-- Header -->
         <section class="recipe-header">
            <div class="title-alignment">
               <h2><?= $re[0]->Name ?></h2>
               <div class="rating four-stars">
                  <div class="star-rating"></div>
                  <div class="star-bg"></div>
               </div>
               <span><a href="#reviews"><?php echo  $alu->total. " Reviews <br />";?></a></span>
            </div>
         </section>
         <!-- Slider -->
         <div class="recipeSlider rsDefault">
            <img style="width: 100%; height: 380px;" itemprop="image" class="rsImg" height='100' width='100' src="<?= $re[0]->picsource ?>" alt="" />
         </div>
         <!-- Details -->
         <section class="recipe-details" itemprop="nutrition">
            <ul>
               <li>Quantity: <strong itemprop="Quantity"><?= $re[0]->Quantity ?></strong></li>
               <li>Price:<strong itemprop="Price">$<?= $re[0]->UnitPrice ?></strong></li>
               <li><?php if (isset($_SESSION['login']) && isset($_SESSION['user_ID']) && ($re[0]->userID == $_SESSION['user_ID'])): ?>
            <a style="margin-left: 5px; background: #a0a0a0;border: 0px; padding: 8px 20px 8px 20px; color: white; font-weight: 700; cursor: pointer;" class="print" href="edit.php?foodID=<?= $re[0]->foodID?>">Edit recipe</a>
            <?php endif; ?></li>
               <form action="" method="POST" id="myForm">
                <input type="hidden" name="item_price" value="<?= $re[0]->UnitPrice ?>">
                <input type="hidden" name="item_name" value="<?= $re[0]->Name ?>">
                <input type="hidden" name="item_image" value="<?= $re[0]->picsource ?>">
                <input type="hidden" name="item_id" value="<?= $re[0]->foodID ?>">
               <li><input style="height: 14px; width: 60px; padding: 10px; border-radius: 3px; border: 1px;" type="number" name="item_quantity" value="1"></li>
               <section class="linking"style="padding-top: 0px;">
                <input type="hidden" name="add_to_cart" value="true">
          <button class="button adc color" style="background-color: #8dc63f; border: 0px; padding: 8px 20px 8px 20px; color: white; font-weight: 700; cursor: pointer;" type="submit"><i class="fa fa-print"  ></i>  Add to Cart</button>
          </form>

          <div class="clearfix"></div>

      </section>
      
            </ul>
            
            <div class="clearfix"></div>
         </section>
       </form>
         <div class="recipe-container">
         </div>
         <div class="clearfix"></div>
         <!-- Meta -->
         <!--  		<div class="post-meta">
            By <a href="#" itemprop="author">Sandra Fortin</a>, on
            <meta itemprop="datePublished" content="2014-30-10">30th November, 2014</meta>
            </div>  -->
         <div class="margin-bottom-40"></div>
         <!-- Headline -->
         <h3 class="headline">You may also like</h3>
         <span class="line margin-bottom-35"></span>
         <div class="clearfix"></div>
         <div class="related-posts">
         <?php foreach($repe as $rep): ?>
            <!-- Recipe #1 -->
            <div class="four recipe-box columns">
               <!-- Thumbnail -->
               <div class="thumbnail-holder">
                  <a href="recipe.php?foodID=<?= $rep->foodID?>">
                     <img style="height: 200px;" src="<?=$rep->picsource?>" alt=""/>
                     <div class="hover-cover"></div>
                     <div class="hover-icon">View Recipe</div>
                  </a>
               </div>
               <!-- Content -->
               <div class="recipe-box-content">
                  <h3><a href="recipe.php?id=<?= $rep->userID?>"><?=$rep->Name?></a></h3>
                  <div class="rating five-stars">
                     <div class="star-rating"></div>
                     <div class="star-bg"></div>
                  </div>
                  <div class="recipe-meta">Price <?=$rep->UnitPrice?></div>
                  <div class="clearfix"></div>
               </div>
            </div>
         <?php endforeach; ?>
            <!-- Recipe #2 -->
            <!-- Recipe #3 -->
         </div>
         <div class="clearfix"></div>
         <div class="margin-top-15"></div>
         <!-- Comments
            ================================================== -->
         <h3 class="headline">Reviews <span class="comments-amount"><?php echo  $alu->total. " <br />";?></span></h3>
         <span class="line"></span>
         <div class="clearfix"></div>
         <!-- Reviews -->
                        <?php endforeach; ?>
             <?php endif; ?>
         <section class="comments" id="reviews">
<?php foreach($reli as $res): ?>
            <ul>
               <li>
                  <div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
                  <div class="comment-content">
                     <div class="arrow-comment"></div>
                     <div class="comment-by"><strong><?= $res->Name ?></strong><span class="email"><?= $res->Email ?></span>
                        <a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
                     </div>
                     <div>
                         <p><div class="Comment"><strong><?= $res->Comments ?></strong></div></p>
                         <div class="Star"><strong>I would like to give you   <?= $res->Rating ?>    Stars</strong>

                     </div>
                  </div>
               </li>
            </ul>
            <?php endforeach; ?>
          </section>      
         <div class="clearfix"></div>
         <br>
         <!-- Add Comment
            ================================================== -->
         <h3 class="headline">Add Review</h3>
         <span class="line margin-bottom-35"></span>
         <div class="clearfix"></div>
         <!-- Add Comment Form -->
<form action="" method = "POST">
 <fieldset>
 <label> Name :</label>    
  <input required="" name="name" size="15" style="height: 19px;width: 300px;"  type="text" required>
   <label> Email:</label>
  <input required="" name="email"  type="text"  style="height: 19px;width: 300px; " size="30">

 <label>  Comments:</label>
 <textarea required="" cols="40" rows="3" name="comments" id="comments" ></textarea>
 <label>  How many stars would you give us? </label>
 <select style="height: 30px; width: 300px;"  required="" name = "rating"> 
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
<option value="5">5</option>
</select> <br>
</fieldset>
<button type ="submit" name="submit" value=""> Submit </button>
</form>
      </div>
   </div>
   
   <!-- Sidebar
      ================================================== -->
   <?php require 'sidebar.php'; ?>
</div>
<!-- Container / End -->
</div>
<!-- Wrapper / End -->
<?php require 'footer.php'; ?>