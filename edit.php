<?php 
   ob_start();
   require 'header.php';
   require 'db.php';
   $id = $_GET['id'] ;
   $sql = "SELECT * FROM recipe WHERE id = '$id'";
   $statement = $connection -> prepare($sql);
   $statement->execute([':id'=> $id]);
   $re = $statement->fetch(PDO::FETCH_OBJ);
   $message = '';
   if (isset($_POST['submit'])) {
   	$title = $_POST['title'];
   	$catagory = $_POST['catagory'];
   	$summary = $_POST['summary'];
   	$filename = $_FILES['uploadfile']['name'];
   	$tempname = $_FILES['uploadfile']['tmp_name'];
   	$folder = "uploads/".$filename;
   	move_uploaded_file($tempname, $folder);
   	//ingrediants
   
   	//end ingrediants
   	$directions = $_POST['directions'];
   	$yield = $_POST['yield'];
   	$ptime = $_POST['ptime'];
   	$ctime = $_POST['ctime'];
   	$level = $_POST['level'];
   	$calories = $_POST['calories'];
   	$added_by = $_SESSION['user_ID'];
   	$sql = "UPDATE recipe SET title='$title' , catagory='$catagory' , summary='$summary',picsouce='$folder', directions='$directions',yield='$yield',ptime='$ptime',ctime='$ctime',level='$level',calories='$calories',added_by='$added_by'  WHERE id= '$id' ";
   	$statement = $connection -> prepare($sql);
   	if ($statement -> execute([':title'=> $title ,':catagory'=> $catagory , ':summary' => $summary ,':uploadfile' => $folder, ':directions' => $directions ,':yield' => $yield, ':ptime' => $ptime , ':ctime' => $ctime ,':level' => $level , ':calories' => $calories, ':added_by' => $added_by , ':id' => $id]))
   	{
   		header('Location:user.php');
   		ob_enf_fluch();
   	}
   }
   
   
   ?>
<section id="titlebar">
   <!-- Container -->
   <div class="container">
      <div class="eight columns">
         <h2>Submit Recipe</h2>
      </div>
      <div class="eight columns">
         <nav id="breadcrumbs">
            <ul>
               <li>You are here:</li>
               <li><a href="#">Home</a></li>
               <li>Submit Recipe</li>
            </ul>
         </nav>
      </div>
   </div>
   <!-- Container / End -->
</section>
<!-- Content
   ================================================== -->
<div class="container">
   <div class="sixteen columns">
      <div class="submit-recipe-form">
         <?php if (!empty($message)): ?>
         <div class="alert alert-success">
            <?php echo "$message"; ?>
         </div>
         <?php endif; ?>
         <form method="POST" action="" enctype="multipart/form-data">
            <!-- Recipe Title -->
            <h4>Recipe Title</h4>
            <nav class="title" >
               <input class="search-field" name="title" type="text" placeholder="" value="<?= $re->title; ?>"/>
            </nav>
            <div class="clearfix"></div>
            <div class="margin-top-25"></div>
            <!-- Choose Category -->
            <div class="select">
               <h4>Choose Category</h4>
               <select data-placeholder="<?= $re->catagory; ?>" class="chosen-select-no-single" name="catagory" id="catagory">
                  <option value="1">All</option>
                  <option value="2">Breakfast</option>
                  <option value="3">Lunch</option>
                  <option value="4">Beverages</option>
                  <option value="5">Appetizers</option>
                  <option value="6">Soups</option>
                  <option value="7">Salads</option>
                  <option value="8">Beef</option>
                  <option value="9">Poultry</option>
                  <option value="10">Pork</option>
                  <option value="11">Seafood</option>
                  <option value="12">Vegetarian</option>
                  <option value="13">Vegetables</option>
                  <option value="14">Desserts</option>
                  <option value="15">Canning / Freezing</option>
                  <option value="16">Breads</option>
                  <option value="17">Holidays</option>
               </select>
            </div>
            <div class="margin-top-25"></div>
            <!-- Short Summary -->
            <h4>Short summary</h4>
            <textarea class="WYSIWYG" name="summary" placeholder="<?= $re->summary; ?>" cols="40" rows="3" id="summary" spellcheck="true"></textarea>
            <div class="margin-top-25"></div>
            <!-- Upload Photos -->
            <h4>Upload your photos</h4>
            <img src="" height="100" width="100">
            <input class="fa fa Upload" type="file" name="uploadfile" value="<?= $re->picsouce; ?>">
            <div class="clearfxix"></div>
            <div class="margin-top-15"></div>
            <!-- Ingredients -->
            <fieldset class="addrecipe-cont" name="ingredients">
               <h4>Ingredients:</h4>
               <table id="ingredients-sort">
                  <tr class="ingredients-cont ing">
                     <td class="icon"><i class="fa fa-arrows"></i></td>
                     <td><input name="ingredient_name" tabindex="5" type="text" placeholder="Name of ingredient" /> </td>
                     <td><input name="ingredient_note" tabindex="6" type="text" placeholder="Notes (quantity, additional info)" /></td>
                     <td class="action"><a title="Delete" class="delete" href="#"><i class="fa fa-remove"></i></a> </td>
                  </tr>
               </table>
               <button  type="button" name="add" id="add" class="button color add_ingredient">Add new ingredient</button>
               <!-- <a href="#" class="button add_separator">Add separator</a> -->
            </fieldset>
            <div class="margin-top-25"></div>
            <!-- Directions -->
            <h4>Directions</h4>
            <textarea class="WYSIWYG" placeholder="<?= $re->directions; ?>" name="directions" cols="40" rows="3" id="directions" spellcheck="true"></textarea>
            <div class="margin-top-25 clearfix"></div>
            Additional Informations
            <h4>Additional Informations</h4>
            <fieldset class="additional-info">
               <table>
                  <tr class="ingredients-cont">
                     <td class="label"><label for="1">Yield</label></td>
                     <td><input id="yield" name="yield" type="text" value="<?= $re->yield; ?>" /></td>
                  </tr>
                  <tr class="ingredients-cont">
                     <td class="label"><label for="2">Preparation Time</label></td>
                     <td><input id="ptime" name="ptime" type="text" value="<?= $re->ptime; ?>" /></td>
                  </tr>
                  <tr class="ingredients-cont">
                     <td class="label"><label for="3">Cooking Time</label></td>
                     <td><input id="ctime" name="ctime" type="text" value="<?= $re->ctime; ?>" /></td>
                  </tr>
                  <tr class="ingredients-cont">
                     <td class="label"><label for="4">Level</label></td>
                     <td>
                        <select data-placeholder="<?= $re->level; ?>" class="chosen-select-no-single" name="level" id="level">
                           <option value="1">&nbsp;</option>
                           <option value="2">Easy</option>
                           <option value="3">Medium</option>
                           <option value="4">Hard</option>
                           <option value="5">Master</option>
                        </select>
                     </td>
                  </tr>
               </table>
            </fieldset>
            <div class="margin-top-25"></div>
            <!-- Nutrition Facts -->
            <h4>Nutrition Facts</h4>
            <fieldset class="additional-info">
               <table>
                  <tr class="ingredients-cont">
                     <td class="label"><label for="5">Calories</label></td>
                     <td><input name="calories" id="Calories" type="text" value="<?= $re->calories; ?>" /></td>
                  </tr>
               </table>
            </fieldset>
            <div class="margin-top-30"></div>
            <button type="submit" name="submit" href="index.php" class="button color-big">Update        Recipe</button>
         </form>
      </div>
   </div>
</div>
<!-- Container / End -->
<div class="margin-top-50"></div>
</div>
<!-- Wrapper / End -->
<?php
   require 'footer.php'; ?>