
<?php 
require 'header.php';
   require 'db.php'; 
   if( isset($_GET['foodID'])){
    $id = $_GET['foodID'];
    $sql = "SELECT * FROM fooditem where foodID = '$id'";
    $statement = $connection -> prepare($sql);
    $statement->execute();
    $re = $statement->fetchAll(PDO::FETCH_OBJ);}
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
//index.php

?>
<!-- Titlebar
================================================== -->
<section id="titlebar">
	<!-- Container -->
	<div class="container">

		<div class="eight columns">
			<h2>Shop</h2>
		</div>

		<div class="eight columns">
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li><a href="#">Shop</a></li>
					<li>Cardamom Pods</li>
				</ul>
			</nav>
		</div>

	</div>
	<!-- Container / End -->
</section>



<!-- Content
================================================== -->


<div class="container">
<?php foreach ($re as $r): ?>
<!-- Slider
================================================== -->
	<div class="eight columns" >
		<!-- Slider -->
		<div class="productSlider rsDefault">
		    <img class="rsImg" src="<?= $re[0]->picsource ?>" alt="" />
		</div>
		<div class="clearfix"></div>
	</div>


<!-- Content
================================================== -->
	<div class="eight columns">
		<div class="product-page">
			
			<!-- Headline -->
			<section class="title">
				<h2><?= $re[0]->Name ?></h2>
				<span class="product-price"><?= $re[0]->UnitPrice ?></span>
			</section>

			<!-- Text Parapgraph -->
			<section>
				<p class="margin-reset"><?= $re[0]->Quantity ?></p>
								
			</section>
			 <?php endforeach; ?>
<form method="post">
			<section class="linking">

					<form action='#'>
						<div class="qtyminus"></div>
						<input type='text' name="quantity" value='1' class="qty" />
						<div class="qtyplus"></div>
					</form>

					<a href="#" name="cart" id="cart" class="button adc color">Add to Cart</a>
					<div class="clearfix"></div>

			</section>
</form>
		</div>
	</div>

</div>


<div class="clearfix"></div>
<div class="margin-top-30"></div>


<div class="container">
	<div class="sixteen columns">
			<!-- Tabs Navigation -->
			<ul class="tabs-nav">
				<li class="active"><a href="#tab1">Item Description</a></li>
				<li><a href="#tab2">Additional Information</a></li>
				<li><a href="#tab3">Reviews <span class="tab-reviews">(0)</span></a></li>
			</ul>

			<!-- Tabs Content -->
			<div class="tabs-container">

				<div class="tab-content" id="tab1">
					<p>Lorem ipsum pharetra lorem felis. Aliquam egestas consectetur elementum class aptentea taciti sociosqu ad litora torquent perea conubia nostra lorem consectetur adipiscing elit. Donec vestibulum justo a diam ultricies pellentesque. Fusce vehicula libero arcu, vitae ornare turpis elementum at. Etiam posuere quam nec ligula dignissim iaculis donec eleifend laoreet ornare. Quisque mattis luctus est, a placerat elit pharetra.</p>
				</div>

				<div class="tab-content" id="tab2">

					<table class="basic-table">
						<tr>
							<th>Weight</th>
							<td>0.5 lbs</td>
						</tr>
					</table>

				</div>

				<div class="tab-content" id="tab3">

					<!-- Reviews -->
					<section class="comments reviews">
						<p class="margin-bottom-10">There are no reviews yet.</p>

						<a href="#small-dialog" class="popup-with-zoom-anim button color margin-left-0">Add Review</a>

						<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
							<h3 class="headline">Add Review</h3><span class="line margin-bottom-25"></span><div class="clearfix"></div>

							<!-- Form -->
							<form id="add-comment" class="add-comment">
								<fieldset>

									<div>
										<label>Name:</label>
										<input type="text" value=""/>
									</div>

									<div>
										<label>Rating:</label>
										<span class="rate">
											<span class="star"></span>
											<span class="star"></span>
											<span class="star"></span>
											<span class="star"></span>
											<span class="star"></span>
										</span>
										<div class="clearfix"></div>
									</div>

									<div class="margin-top-20">
										<label>Email: <span>*</span></label>
										<input type="text" value=""/>
									</div>

									<div>
										<label>Review: <span>*</span></label>
										<textarea cols="40" rows="3"></textarea>
									</div>

								</fieldset>

								<a href="#" class="button color">Add Review</a>
								<div class="clearfix"></div>

							</form>
						</div>

					</section>

				</div>

			</div>
	</div>
</div>



<!-- Related Products -->
<div class="container margin-top-5">

	<!-- Headline -->
	<div class="sixteen columns">
		<h3 class="headline">Related Products</h3>
		<span class="line margin-bottom-0"></span>
	</div>

	<!-- Products -->
	<div class="products">

		<!-- Product #3 -->
		<div class="four columns">
			<figure class="product">

				<div class="mediaholder">
					<a href="product-page.html">
						<img alt="" src="images/shop_item_03.jpg"/>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i></a>
				</div>

				<a href="product-page.html">
					<section>
						<span class="product-category">Spices</span>
						<h5>Chilli Powder</h5>
						<span class="product-price">$2.99</span>
					</section>
				</a>
			</figure>
		</div>

	<!-- Product #6 -->
	</div>
</div>

<div class="margin-top-50"></div>


</div>
<!-- Wrapper / End -->


<?php require 'footer.php'; ?>