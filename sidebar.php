<?php $sql = "SELECT * FROM fooditem ORDER BY foodID DESC LIMIT 0,3";
   $statement = $connection -> prepare($sql);
   $statement->execute();
   $re = $statement->fetchAll(PDO::FETCH_OBJ);    ?>
<div class="four columns">
   <!-- Search Form -->
   <div class="widget search-form">
      <nav class="search">
         <form action="search.php" method="get">
            <button><i class="fa fa-search"></i></button>
            <input class="search-field" type="text" placeholder=" <?php if(isset($_GET['search'])){echo $_GET['search'];} else {echo "Search for Recipes";} ?>" value="" name="search" />
         </form>
      </nav>
      <div class="clearfix"></div>
   </div>
   <div class="widget">
         <h4 class="headline">Cart</h4>
         <span class="line margin-bottom-30"></span>
         <div class="clearfix"></div>
         
         <div class="widget_shopping_cart_content">
            <ul class="product_list_widget">
               
               <li>
                  <a href="#" class="image"><img src="images/shop_item_02a.jpg" alt=""></a>
                  <div class="product_title">
                     <a href="#">Mixed Herbs</a>
                     <span class="quantity">1 × <span class="amount">$2.99</span></span>  
                  </div>
               </li>

            </ul>

            <p class="total"><strong>Subtotal:</strong>
            <span class="amount">$2.99</span></p>

            <span class="buttons">
               <a href="#" class="button">View Cart</a>
               <a href="#" class="button color">Checkout</a>
            </span>
         </div>
      </div>
   <!-- Author Box -->
   <div class="widget">
      <div class="author-box">
         <span class="title">About Us:</span>
         <span class="name">Summen Zahid</span>
                  <span class="contact"><span class="__cf_email__" data-cfemail="2457454a40564564474c4b530a474b49">summenzahid@gmail.com</span></span><br>
         <span class="name">Alia Liaqat</span>
                  <span class="contact"><span class="__cf_email__" data-cfemail="2457454a40564564474c4b530a474b49">alialiaqat250@gmail.com</span></span><br>
         <span class="name">Hafsa Qayyum</span>
         <span class="contact"><span class="__cf_email__" data-cfemail="2457454a40564564474c4b530a474b49">komalHafsa786@gmail.com</span></span><br>
         <p>we are making this for you this is where we share our stuff. we are madly in love with food. You will find a balance of healthy food items, comfort food and indulgent desserts.</p>
      </div>
   </div>
   <!-- Popular Recipes -->
   <div class="widget">
      <h4 class="headline">Latest Food Items</h4>
      <span class="line margin-bottom-30"></span>
      <div class="clearfix"></div>
      <?php foreach ($re as $r): ?> 		
      <!-- Recipe #1 -->
      <a href="recipe.php?foodID=<?= $r->foodID?>" class="featured-recipe">
         <img style="height: 100px;" src="<?= $r-> picsource ?>" alt="">
         <div class="featured-recipe-content">
            <h4><?= $r->Name ?></h4>
            <div class="rating five-stars">
               <div class="star-rating"></div>
               <div class="star-bg"></div>
            </div>
         </div>
         <div class="post-icon"></div>
      </a>
      <?php endforeach; ?>
      <!-- Popular Recipes -->
      <div class="widget">
         <h4 class="headline">Share</h4>
         <span class="line margin-bottom-30"></span>
         <div class="clearfix"></div>
         <ul class="share-buttons">
            <li class="facebook-share">
               <a href="#">
               <span class="counter">1,234</span>
               <span class="counted">Fans</span>
               <span class="action-button">Like</span>
               </a>
            </li>
            <li class="twitter-share">
               <a href="#">
               <span class="counter">863</span>
               <span class="counted">Followers</span>
               <span class="action-button">Follow</span>
               </a>
            </li>
            <li class="google-plus-share">
               <a href="#">
               <span class="counter">902</span>
               <span class="counted">Followers</span>
               <span class="action-button">Follow</span>
               </a>
            </li>
         </ul>
         <div class="clearfix"></div>
      </div>
   </div>
</div>