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
   if( isset($_POST['cart'])){
      $userID = $_SESSION['user_ID'];
      if( isset($_GET['foodID'])){
      $foodID = $_GET['foodID'];
      $quantity = $_POST['quantity'];
      $datet = date("H:i:s");
      $sqld = "INSERT INTO order(OrderDate,Quantity,PickupDate, UserID, foodID) VALUES($datet, $quantity,$datet, $userID, $foodID) ";
      $statementd = $connection -> prepare($sqld);
      if ($statementd -> execute([':OrderDate'=> $datet ,':quantity' => $quantity, ':OrderDate'=> $datet ,':userID' => $userID , ':userID' => $userID])); 
      {
         $message = 'data inserted successfully';
      }
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
               <li>Price:<strong itemprop="Price"><?= $re[0]->UnitPrice ?></strong></li>
               <li><input style="height: 30px;width: 30px;" type="number" name="quantity" value="1"></li>
            </ul>
            <?php if (isset($_SESSION['login']) && isset($_SESSION['user_ID']) && ($re[0]->userID == $_SESSION['user_ID'])): ?>
            <a style="margin-left: 5px;" class="print" href="edit.php?foodID=<?= $re[0]->foodID?>">Edit recipe</a>
            <?php endif; ?>
            <a href="#" class="print"><i class="fa fa-print"></i> Print</a>
            <button type="submit" name="cart" id="cart"><a onclick="return confirm('Added to the cart');" method= "POST" name="cart" id="cart" style="margin: 0.1%" href="recipe.php?foodID=<?= $re[0]->foodID?>" class="print" ><i class="fa fa-print"  ></i> Add to Cart</a></button>
            <div class="clearfix"></div>
         </section>
       </form>
         <div class="recipe-container">
            <div class="directions-container">
               <!-- Directions -->
               <h3>Directions</h3>
               <ol style="text-align: justify;text-justify: inter-word;" class="directions" itemprop="recipeInstructions">
                  <li ><?= $re[0]->Quantity ?></li>
               </ol>
            </div>
         </div>
         <div class="clearfix"></div>
         <!-- Share Post -->
         <ul class="share-post">
            <li><a href="#" class="facebook-share">Facebook</a></li>
            <li><a href="#" class="twitter-share">Twitter</a></li>
            <li><a href="#" class="google-plus-share">Google Plus</a></li>
            <li><a href="#" class="pinterest-share">Pinterest</a></li>
            <!-- <li><a href="#add-review" class="rate-recipe">Add Review</a></li> -->
         </ul>
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