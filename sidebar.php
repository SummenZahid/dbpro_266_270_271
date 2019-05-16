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
               <?php $total = 0;?>
               <?php if(empty($_SESSION['shopping_cart'])):?>
                  <li>
                     <p><strong>No Items In The Cart</strong></p>
                  </li>
               <?php else: ?>
               <?php 
                  foreach ($_SESSION['shopping_cart'] as $key => $value) 
                  { 
               ?>
                     <li>
                        <a href="#" class="image"><img src="<?php echo $value['item_image']; ?>" alt=""></a>
                        <div class="product_title">
                           <a href="#"><?php echo $value['item_name']; ?></a>
                           <span class="quantity"><?php echo $value['item_quantity']; ?> × <span class="amount">$<?php echo $value['item_price']; ?> </span></span>  
                        </div>
                     </li>

                  <?php
                  $total = $total + $value['item_quantity'] * $value['item_price'];
                  }
               ?>
               <?php endif;?>
            </ul>

            <p class="total"><strong>Subtotal:</strong>
            <span class="amount">$<?php echo number_format($total, 2);?></span></p>

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
         <img style="height: 100px; width: 100%;" src="<?= $r-> picsource ?>" alt="">
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
      <div style="height: 300px;">
         
      </div>
   </div>
</div>