<?php 
   ob_start();
   require 'header.php';
   require 'db.php';
   $foodID = $_GET['foodID'] ;
   $sql = "SELECT * FROM fooditem WHERE foodID = '$foodID'";
   $statement = $connection -> prepare($sql);
   $statement->execute([':foodID'=> $foodID]);
   $re = $statement->fetch(PDO::FETCH_OBJ);
   $message = '';
   if (isset($_POST['submit'])) {
      $title = $_POST['title'];
      $catagory = $_POST['catagory'];
      $filename = $_FILES['uploadfile']['name'];
      $tempname = $_FILES['uploadfile']['tmp_name'];
      $folder = "uploads/".$filename;
      move_uploaded_file($tempname, $folder);
      $quantity = $_POST['quantity'];
      $price = $_POST['price'];
      $added_by = $_SESSION['user_ID'];
   	$sqli = "UPDATE fooditem SET Name='$title' , picsource='$folder' , Quantity='$quantity',UnitPrice='$price', CatagoryID ='$catagory',added_by='$added_by'  WHERE foodID= '$foodID' ";
   	$statementi = $connection -> prepare($sqli);
   	if ($statementi -> execute([':title'=> $title ,':uploadfile' => $folder, ':quantity' => $quantity ,':price' => $price, ':catagory' => $catagory , ':added_by' => $added_by , ':foodID' => $foodID]))
   	{
   		header('Location:index.php');
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
            <h4>Food Title</h4>
            <nav class="title" >
               <input required="" class="search-field" name="title" type="text" placeholder="" value="<?= $re->Name ?>"/>
            </nav>
            <div class="clearfix"></div>
            <div class="margin-top-25"></div>
            <!-- Choose Category -->
            <div class="select">
               <h4>Choose Category</h4>
               <select required="" data-placeholder="<?= $re->CatagoryID ?>" class="chosen-select-no-single" name="catagory" id="catagory">
                  <option value="1">All</option>
                  <option value="2">Breakfast</option>
                  <option value="3">Lunch</option>
                  <option value="4">Beverages</option>
                  <option value="5">Appetizers</option>
                  <option value="6">Soups</option>
                  <option value="7">Salads</option>
               </select>
            </div>
            <div class="margin-top-25"></div>
            <!-- Short Summary -->
            <h4>Upload your photos</h4>
            <img src=""  value="<?= $re->picsource ?>" height="100" width="100">
            <input required="" class="buttona buttonb" type="file" name="uploadfile">
            <div class="clearfxix"></div>
            <div class="margin-top-15"></div>

         <div class="margin-top-25"></div>
            <!-- Directions -->
         
            Additional Informations
            <h4>Additional Informations</h4>
            <fieldset class="additional-info">
               <table>
                  <tr class="ingredients-cont">
                     <td class="label"><label for="1">Quantity</label></td>
                     <td><input required="" id="quantity" name="quantity" type="text" value="<?= $re->Quantity ?>" /> </td>
                  </tr>
                  <tr class="ingredients-cont">
                     <td class="label"><label for="2">Unit Price</label></td>
                     <td><input required="" id="price" name="price" type="text" value="<?= $re->UnitPrice ?>" /></td>
                  </tr>
               </table>
            </fieldset>
            <div class="margin-top-25"></div>
            <!-- Nutrition Facts -->
            <div class="margin-top-30"></div>
            <button type="submit" name="submit" href="index.php" class="buttona buttonb">Update Item</button>
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