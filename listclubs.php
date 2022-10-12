<?php include_once("portalheader.php");?>
<!-- Page Content -->
<div class="container">

<!-- Page Heading/Breadcrumbs -->
<h1 class="mt-4 mb-3">
  <small>List of Clubs</small>
</h1>

<div class="row">
  <div class="col-lg-8 mb-4">
    <a href="addclub.php" class="btn btn-primary mb-3">Add Club</a>
    <?php 
        if (isset($_REQUEST['m'])) {
    ?>
        <div class="alert alert-success">
            <?php echo $_REQUEST['m']; ?>
        </div>
    <?php        
        }
    ?>

    <?php 
        if (isset($_REQUEST['info'])) {
    ?>
        <div class="alert alert-info">
            <?php echo $_REQUEST['info']; ?>
        </div>
    <?php        
        }
    ?>

    <?php 
        if (isset($_REQUEST['err'])) {
    ?>
        <div class="alert alert-danger">
            <?php echo $_REQUEST['err']; ?>
        </div>
    <?php        
        }
    ?>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Club Name</th>
                <th>Year Establish</th>
                <th>Description</th>
                <th>Country</th>
                <th>Slogan</th>
                <th>Emblem</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // include the class Club
                include_once "shared/club.php";

                //create club object
                $clubobj = new Club();

                $clubs = $clubobj->listClubs();

                // echo "<pre>";
                // print_r($clubs);
                // echo "</pre>";

                if (count($clubs) > 0) {
                    
                    foreach ($clubs as $key => $value) {
                        $clubid = $value['club_id'];
            ?>
                <tr>
                    <td>#</td>
                    <td><?php echo $value['club_name']; ?></td>
                    <td><?php echo $value['year_established']; ?></td>
                    <td><?php echo $value['club_desc']; ?></td>
                    <td><?php echo $value['slogan']; ?></td>
                    <td><?php echo $value['country_name']; ?></td>
                    <td>
                        <?php 
                            if (!empty($value['emblem'])) {
                        ?>
                            <img src="clubphotos/<?php echo $value['emblem']; ?>" alt="<?php echo $value['club_name']; ?> emblem" class="img-fluid">
                        <?php
                            }
                        ?>
                    </td>
                    <td><a href ="editclub.php?clubid=<?php echo $clubid?>">Edit</a> | <a href="deleteclub.php?clubid=<?php echo $clubid?>&clubname=<?php echo $value['club_name'];?>">Delete</a></td>
                </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
  </div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->

<?php include_once("portalfooter.php");?>