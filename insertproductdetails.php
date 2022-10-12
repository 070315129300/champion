<?php include_once("portalheader.php");?>
<!-- Page Content -->
<div class="container">

<!-- Page Heading/Breadcrumbs -->
<h1 class="mt-4 mb-3">
  <small>Product Confirmation</small>
</h1>

<div class="row">
    <div class="col-lg-8 mb-4">
        <?php 
           if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnbuy'])) {
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";

            include_once "shared/paymentclass.php";

            // create object
            $obj = new Payment();
            $myreference = "CH".rand().time();
            // generate a unique reference number


            // make reference to insertdetails method
            $output = $obj->insertDetails($_SESSION['myuserid'], $_POST['myproductid'], $_POST['myprice'], $myreference);
        ?>
            <div style="width: 20em;">
                <img src="images/<?php echo $_POST['myimage']; ?>" alt="<?php echo $_POST['myname']; ?>" class="img-fluid" />
                <p>
                    <?php echo $_POST['myname']; ?>
                    &#8358<?php echo number_format($_POST['myprice'],2); ?>
                </p>
                <p>
                    <form method="post" action="paystack_init.php">
                        <input type="hidden" name="email" value="<?php echo $_SESSION['myemail']; ?>" />
                        <input type="hidden" name="amount" value="<?php echo $_POST['myprice']; ?>" />
                        <input type="hidden" name="myreference" value="<?php echo $myreference; ?>" />
                        <input type="submit" name="btnpay" value="Pay With Paystack" class="btn btn-success" />
                    </form>
                </p>
            </div>
        <?php
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