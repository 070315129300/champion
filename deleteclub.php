<?php 
    include_once("portalheader.php");
?>

    <!-- Page Content -->
<div class="container">

    <h1 class="mt-4 mb-3">
    <small>Delete Club</small>
    </h1>

    <?php 
        if (isset($_REQUEST['btndelete'])) {
            # delete club
            include_once("shared/club.php");

            // create object
            $obj = new Club();

            // make use of delete method
            $obj->deleteClub($_REQUEST['clubid']);
        }

        if (isset($_REQUEST['btncancel'])) {
            # redirect to list clubs
            $msg = "No action performed";
            header("Location: listclubs.php?info=$msg");
            exit();
        }
    ?>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <?php 
                if (isset($_REQUEST['clubid'])) {
            ?>
                <div class="alert alert-danger">
                    <h3>Are you sure you want to delete <?php echo $_REQUEST['clubname']; ?></h3>
                </div>
                <form method="post" action="deleteclub.php?clubid=<?php echo $_REQUEST['clubid']; ?>&clubname=<?php echo $_REQUEST['clubid']; ?>">
                    <button type="submit" name="btndelete" class="btn btn-danger">Yes</button>
                    <button type="submit" name="btncancel" class="btn btn-secondary">No</button>
                </form>
            <?php
                }
            ?>
        </div>
    </div>      
</div>  
<?php 
    include_once("portalfooter.php");
?>