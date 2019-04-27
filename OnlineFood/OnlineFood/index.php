<?php
   ob_start();
   require 'header.php';
   require 'db.php';
   if (isset($_GET['page'])) {
    $page = $_GET['page'];
   } else {
       $page = 1;
   }
   $no_of_records_per_page = 9;
   $offset = ($page-1) * $no_of_records_per_page;
   $total_pages_sql = "SELECT * FROM fooditem ";
   $result = $connection ->prepare($total_pages_sql);
   $result->execute();
   // $total_rows = $result->fetchAll(PDO::FETCH_OBJ);

   $num_rows = $result->rowCount();

   $total_pages = ceil($num_rows / $no_of_records_per_page);
   $sql = "SELECT * FROM fooditem LIMIT $offset, $no_of_records_per_page";
   $statement = $connection -> prepare($sql);
   $statement->execute();
   $re = $statement->fetchAll(PDO::FETCH_OBJ);

    // while($row = $re){
    //         //here goes the data
    //     }
   $sqli = "SELECT * FROM fooditem ORDER BY foodID DESC LIMIT 0,6";
   $statementi = $connection -> prepare($sqli);
   $statementi->execute();
   $repe = $statementi->fetchAll(PDO::FETCH_OBJ);
   ?>
<!-- Slider
   ================================================== -->
<div id="homeSlider" class="royalSlider rsDefaultInv">
<?php foreach($repe as $rep): ?>
   <!-- Slide #1 -->
   <div class="rsContent">
      <a class="rsImg" href="<?= $rep->picsource ?>"></a>
      <i class="rsTmb"><?=$rep->Name?></i>
      <!-- Slide Caption -->
      <div class="SlideTitleContainer rsABlock">
         <div class="CaptionAlignment">
            <h2 class="rsSlideTitle title"><a href="recipe.php?foodID=<?= $rep->foodID?>"><?= $rep->Name ?></a></h2>
            <div class="rsSlideTitle details">
               <ul>
                  <li><i class="fa fa-cutlery"></i> <?= $rep->Quantity ?></li>
                  <li><i class="fa fa-money"></i><?= $rep->UnitPrice ?></li>
      
               </ul>
            </div>
            <a href="recipe.php?foodID=<?= $rep->foodID?>" class="rsSlideTitle button">View Recipe</a>
         </div>
      </div>
   </div>
<?php endforeach; ?>
</div>
<!-- Content
   ================================================== -->
<div class="container">
   <!-- Masonry -->
   <div class="twelve columns">
      <!-- Headline -->
      <h3 class="headline">Latest Recipes</h3>
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
                  <img style="height: 200px;" src="<?= $r ->picsource;?>" alt=""/>
                  <div class="hover-cover"></div>
                  <div class="hover-icon"> View Recipe</div>
               </a>
            </div>
            <!-- Content -->
            <div class="recipe-box-content">
               <h3><a href="recipe.php?foodID=<?= $r->foodID?>"><?= $r ->Name;?></a></h3>
               <div class="rating five-stars">
                  <div class="star-rating"></div>
                  <div class="star-bg"></div>
               </div>
               <div class="recipe-meta">Price <?= $r ->UnitPrice;?></div>
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
            <?php $i=1; $pages=5; if($page>=5){ $i= ($page-$pages)+2; $pages=$page+1;} while ($i<=$total_pages && $i <= $pages ) :?>
               <li><a href="?page=<?php echo $i; ?>" <?php if ($page == $i):?> onclick="return false" class="current-page"<?php endif; ?>><?php echo $i++ ;?></a></li>
            <?php endwhile; ?>
            </ul>
         </nav>
         <nav class="pagination-next-prev">
            <ul>
               <li class="<?php if($page <= 1){ echo 'disabled'; } ?>"><a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>" class="prev"></a></li>
               <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>" > <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>" class="next"></a></li>
            </ul>
         </nav>
      </div>
   </div>
   <?php require 'sidebar.php'; ?>
</div>
<!-- Container / End -->
</div>
<!-- Wrapper / End -->
<?php
   require 'footer.php';
   ?>