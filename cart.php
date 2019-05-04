
<?php require 'header.php';
   require 'db.php'; 
   if( isset($_GET['foodID'])){
    $id = $_GET['foodID'];
    $sql = "SELECT * FROM fooditem where foodID = '$id'";
    $statement = $connection -> prepare($sql);
    $statement->execute();
    $re = $statement->fetchAll(PDO::FETCH_OBJ);} ?>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<?php foreach ($re as $r): ?>
   <div class="card shopping-cart">
            <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Shipping cart
                <a href="index.php" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                    <!-- PRODUCT -->
                    <div class="row">
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h4 class="product-name"><strong><?= $re[0]->Name ?></strong></h4>
                            <h4>
                                <small> Price: <?= $re[0]->UnitPrice ?></small>
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                <h6><strong><?= $re[0]->UnitPrice ?><span class="text-muted">x</span></strong></h6>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <div class="quantity">
                                    <input type="button" value="+" class="plus">
                                    <input type="number" step="1" max="99" min="1" value="1" title="Qty" class="qty"
                                           size="4">
                                    <input type="button" value="-" class="minus">
                                </div>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                                <button type="button" class="btn btn-outline-danger btn-xs">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- END PRODUCT -->
                    <!-- PRODUCT -->
                    <hr>
                    <!-- END PRODUCT -->
                <div class="pull-right">
                    <a href="" class="btn btn-outline-secondary pull-right">
                        Update shopping cart
                    </a>
                </div>
            </div>
            <div class="card-footer">
                <div class="coupon col-md-5 col-sm-5 no-padding-left pull-left">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="cupone code">
                        </div>
                        <div class="col-6">
                            <input type="submit" class="btn btn-default" value="Use cupone">
                        </div>
                    </div>
                </div>
                <div class="pull-right" style="margin: 10px">
                    <a href="" class="btn btn-success pull-right">Checkout</a>
                    <div class="pull-right" style="margin: 5px">
                        Total price: <b>50.00€</b>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
  
</div>
