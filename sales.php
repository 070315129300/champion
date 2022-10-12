<?php include_once("portalheader.php");?>
<!-- Page Content -->
<div class="container">

<!-- Page Heading/Breadcrumbs -->
<h1 class="mt-4 mb-3">
  <small>Sales Product</small>
</h1>

<div class="row">
    <div class="col-lg-8 mb-4">
        <?php 
            include_once "shared/paymentclass.php";

            // create object
            $obj = new Payment();

            // make reference to getProducts method
            $products = $obj->getProducts();

            // echo "<pre>";
            // print_r($products);
            // echo "</pre>";

            // check if there are products
            if(count($products) > 0){
                # loop thru the array using foreach
                foreach ($products as $key => $value) {
            ?>
                <div style="width: 200px; float:left; margin: 10px; height: 100px">
                    <img src="images/<?php echo $value['imageurl']; ?>" class="img-fluid" />
                    <p><?php echo $value['name']; ?></p>
                    <p>&#8358
                        <?php echo number_format($value['price'],2); ?>
                        
                        <form method="post" action="insertproductdetails.php">
                            <input type="hidden" name="myprice" value="<?php echo $value['price']; ?>" />
                            <input type="hidden" name="myproductid" value="<?php echo $value['product_id']; ?>" />
                            <input type="hidden" name="myname" value="<?php echo $value['name']; ?>" />
                            <input type="hidden" name="myimage" value="<?php echo $value['imageurl']; ?>"/>
                            <input type="submit" name="btnbuy" value="Buy" class="btn btn-primary"/> 
                        </form>
                    </p>
                </div>
            <?php
                }
            }
        ?>
    </div>

</div>
<!-- /.row -->

</div>
<?php 
    echo "<br>"
?>
<!-- /.container -->

<?php include_once("portalfooter.php");?>