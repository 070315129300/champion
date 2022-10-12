<?php include_once("portalheader.php");?>
<!-- Page Content -->
<div class="container">

<!-- Page Heading/Breadcrumbs -->
<h1 class="mt-4 mb-3">
  <small>Payment Status</small>
</h1>

<div class="row">
  <div class="col-lg-8 mb-4">
    <?php 
        if (isset($_REQUEST['ref'])) {
    ?>
        <div class="alert alert-success">
            <p>Your payment with reference number <b><?php echo $_REQUEST['ref']; ?></b> was successful.</p>
        </div>
    <?php
        }
    ?>
  </div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->

<?php include_once("portalfooter.php");?>