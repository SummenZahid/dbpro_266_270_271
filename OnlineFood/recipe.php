<?php 
   ob_start();
   require 'header.php'; 
   require 'db.php'; 
   if( isset($_GET['foodID'])){
   	$id = $_GET['foodID'];
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
$sqli = "SELECT Name , Email , Rating , Comments FROM reviews";
   $statementi = $connection -> prepare($sqli);
   $statementi->execute();
   $reli = $statementi->fetchAll(PDO::FETCH_OBJ);
 
   
  
   ?>
<!-- Recipe Background -->
<div class="recipeBackground">
   <img src="<?= $re[0]->picsource ?>" alt="" />
</div>
<!-- Content
   ================================================== -->
<div class="container" itemscope itemtype="http://schema.org/Recipe">
   <!-- Recipe -->
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
               <span><a href="#reviews">(2 reviews)</a></span>
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
            </ul>
            <?php if (isset($_SESSION['login']) && isset($_SESSION['user_ID']) && ($re[0]->userID == $_SESSION['user_ID'])): ?>
            <a style="margin-left: 5px;" class="print" href="edit.php?foodID=<?= $re[0]->foodID?>">Edit recipe</a>
            <?php endif; ?>
            <a href="#" class="print"><i class="fa fa-print"></i> Print</a>
            <a style="margin: 0.1%" href="shop.php" class="print"><i class="fa fa-print"></i> Shop </a>
            <div class="clearfix"></div>
         </section>
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
         <h3 class="headline">Reviews <span class="comments-amount">(4)</span></h3>
         <span class="line"></span>
         <div class="clearfix"></div>
         <!-- Reviews -->
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
                         <div class="Star"><strong>I would love to give you   <?= $res->Rating ?>    Stars</strong>

                     </div>
                  </div>
               </li>
            </ul>
            <?php endforeach; ?>
          </section>
          
         <!--   /*$servername = "localhost";
           $username = "root";
           $password = "";
           $dbname = "db23";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
           $sql = "SELECT Name, Email, Rating, Comments FROM reviews";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> Name: ". $row["Name"]." <br> Email: ". $row["Email"]. " <br> Rating: ". $row["Rating"]. " 
        <br> Comment: ". $row["Comments"]. " <br>";
    }
} else {
    echo "0 results";
}

$conn->close();*/ -->
           

         
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
 
  <input name="name" size="15" style="height: 19px;"  type="text" required>

  <br><br>

   <label> Email:</label> <br>
  <input name="email"  type="text"  style="height: 19px;" size="30"><br><br>

 <label>  Comments:</label> <br>
 <textarea cols="40" rows="3" name="comments" id="comments" ></textarea><br><br>
 <label>  How many stars would you give us? </label> <br>
 <select name = "rating"> 
   <option value=" ">Star</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
<option value="5">5</option>
</select> <br><br>
</fieldset>


  

<button type ="submit" name="submit" value=""> Submit </button>
</form>

        <!-- <form action="" id="add-review" class="add-comment"  method="POST">
            <fieldset>
               <input type="hidden" name="userID" value=""/>
               <div>
                  <label>Name:</label>
                  <input type="text" name="name" id="name" value=""/>
               </div>
               <div>
                  <label>Email: <span>*</span></label>
                  <input type="text" name="email" id="email" value=""/>
               </div>
               <div>
                  <label>Rating:</label>
                  <span class="rate" name="rating">
                  <span class="star"></span>
                  <span class="star"></span>
                  <span class="star"></span>
                  <span class="star"></span>
                  <span class="star"></span>
                  </span>
               </div>
               <div class="clearfix"></div>
               <div>
                  <label>Comment: <span>*</span></label>
                  <textarea cols="40" rows="3" name="comments" id="comments" ></textarea>
               </div>
            </fieldset>
            <button type="submit" name="submit"  class="button medium color">Add Review</button>
            <div class="clearfix"></div>
         </form> -->
      </div>
   </div> -->
   ?>
   
   <!-- Sidebar
      ================================================== -->
   <?php require 'sidebar.php'; ?>
</div>
<!-- Container / End -->
</div>
<!-- Wrapper / End -->
<?php require 'footer.php'; ?>