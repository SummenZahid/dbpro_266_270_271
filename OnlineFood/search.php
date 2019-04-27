<?php
   require 'header.php';
   require 'db.php';
   // $sql = 'SELECT * FROM recipe';
   // $statement = $connection -> prepare($sql);
   // $statement->execute();
   // $re = $statement->fetchAll(PDO::FETCH_OBJ);
   
   if (isset($_GET['search'])) {
   	$value = $_GET['search'];
   	$sql = "SELECT * FROM fooditem WHERE Name Like '$value%'";
   	$statement = $connection -> prepare($sql);
   	$statement->execute();
   	$re = $statement->fetchAll(PDO::FETCH_OBJ);
   }
   ?>
<div style="height: 2px; margin: 5px 0 25px 0; background-color: #F2F3F4;"></div>
<!-- Content
   ================================================== -->
<div class="container">
   <!-- Masonry -->
   <div class="twelve columns">
      <?php if ($re): ?>
      <!-- Headline -->
      <h3 class="headline">Search Results For "<?= $_GET['search']  ?>"</h3>
      <span class="line rb margin-bottom-35"></span>
      <div class="clearfix"></div>
      <!-- Isotope -->
      <div class="isotope">
         <?php foreach($re as $r): ?>
         <!-- Recipe #7 -->
         <div class="four recipe-box columns">
            <!-- Thumbnail -->
            <div class="thumbnail-holder">
               <a href="recipe.php?foodID=<?= $r->foodID?>">
                  <img src="<?= $r -> picsource;?>" alt=""/>
                  <div class="hover-cover"></div>
                  <div class="hover-icon"> View Recipe</div>
               </a>
            </div>
            <!-- Content -->
            <div class="recipe-box-content">
               <h3><a href="recipe.php?foodID=<?= $r->foodID?>"><?= $r -> Name;?></a></h3>
               <div class="rating five-stars">
                  <div class="star-rating"></div>
                  <div class="star-bg"></div>
               </div>
               <div class="recipe-meta"><i class="fa fa-clock-o"></i> 1 hr 20 min</div>
               <div class="clearfix"></div>
            </div>
         </div>
         <?php endforeach; ?>
         <!-- Recipe #2 -->
      </div>
      <div class="clearfix"></div>
      <!-- Pagination -->
      <div class="pagination-container masonry">
         <nav class="pagination">
            <ul>
               <li><a href="#" class="current-page">1</a></li>
               <li><a href="#">2</a></li>
               <li><a href="#">3</a></li>
            </ul>
         </nav>
         <nav class="pagination-next-prev">
            <ul>
               <li><a href="#" class="prev"></a></li>
               <li><a href="#" class="next"></a></li>
            </ul>
         </nav>
      </div>
      <?php else: ?>
      <div class="notification error closeable">
         <p><span>Sorry!</span> No Such Recipe Found!</p>
         <a class="close" href="#"></a>
      </div>
      <?php endif;?>
   </div>
   <?php require 'sidebar.php'; ?>
</div>
</div>
<!-- Container / End -->
</div>
<!-- Wrapper / End -->
<?php require 'footer.php'; ?>