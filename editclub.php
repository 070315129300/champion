<?php 

  include_once("portalheader.php");

  include_once "shared/club.php";
  $clubobj = new Club();

  // fetch existing data
  $data = $clubobj->getClub($_REQUEST['clubid']);

  echo "<pre>";
  print_r($data);
  echo "</pre>";

  // check if the button is clicked
  if (isset($_POST['btneditclub'])) {
    // validate
    if (empty($_POST['clubname'])) {
      $errors['clubname'] = "Club name cannot be empty!";
    }

    if (empty($_POST['year'])) {
      $errors['year'] = "Year established cannot be empty!";
    }

    if (empty($_POST['description'])) {
      $errors['description'] = "Club description cannot be empty!";
    }

    if (empty($_POST['country'])) {
      $errors['country'] = "Club country cannot be empty!";
    }
    // sanitize
    $clubname = sanitizeInput($_POST['clubname']);
    $description = sanitizeInput($_POST['description']);
    $slogan = sanitizeInput($_POST['slogan']);
    $year = $_POST['year'];
    $country = $_POST['country'];
    $clubid = $_POST['clubid'];

    // Update record
   

    // reference insertclub
    $output = $clubobj->updateClub($clubname, $year, $description, $country, $slogan, $clubid);

    // check if it's successful
    if ($output == 1) {
      $msg = "Club was successfully updated";

      header("Location: listclubs.php?m=$msg");
    }elseif($output == 0) {
      $msg = "No changes was made!";
      header("Location: listclubs.php?m=$msg");
    }else{
      $errors[] = "Oops! Could not update club. ".$output;
    }
  }
?>
<!-- Page Content -->
<div class="container">

<!-- Page Heading/Breadcrumbs -->
<h1 class="mt-4 mb-3">
  <small>Edit Club</small>
</h1>

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="index.html">Home</a>
  </li>
  <li class="breadcrumb-item active">Sign up Form</li>
</ol>


<div class="row">
  <div class="col-lg-8 mb-4">
    <?php 
      if (!empty($errors)) {
        echo "<ul class='alert alert-danger'>";
        foreach ($errors as $key => $value) {
          echo "<li>$value</li>";
        }
        echo "</ul>";
      }
    ?>
    <form name="addclub" id="addclub" action="editclub.php?clubid=<?php if(isset($_REQUEST['clubid'])){ echo $_REQUEST['clubid']; } ?>" method="post" enctype="multipart/form-data">
      <div class="control-group form-group">
        <div class="controls">
          <label>Club Name:</label>
          <input type="text" class="form-control" id="clubname" name='clubname' value="<?php if(isset($data['club_name'])){ echo $data['club_name']; } ?>">
          <?php 
            if (!empty($errors['clubname'])) {
             echo "<div class='text-danger'>".$errors['clubname']."</div>";
            }
          ?>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label>Year Established:</label>
          <select name="year" class="form-control">
            <option>Choose Year</option>
            <?php 
              for ($year = 1800; $year < 1990; $year++) { 
                if ($year == $data['year_established']) {
                  echo "<option value='$year' selected>$year</option>";
                }else{
                  echo "<option value='$year'>$year</option>";
                }
              }
            ?>
          </select>
         
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label>Description (short):</label>
          <textarea rows="5" cols="50" name='description' class="form-control" id="description"  maxlength="300" style="resize:none"></textarea>
        </div>
      </div>

      <div class="control-group form-group">
        <div class="controls">
          <label>slogan:</label>
          <input type="text" class="form-control" id="slogan" name='slogan'>
          
        </div>
      </div>

      <div class="control-group form-group">
        <div class="controls">
          <label>Emblem:</label>
          <input type="file" class="form-control" id="emblem" name='emblem'>
          
        </div>
      </div>

      <div class="control-group form-group">
        <div class="controls">
          <label>Country:</label>
          <select name="country" class="form-control">
            <option value="">Choose Country</option>
            <?php 
              // include class club
              include_once "shared/club.php";

              // create object
              $clubobj = new Club();

              // making reference to getCountry method
              $countries = $clubobj->getCountry();

              echo "<pre>";
              print_r($countries);
              echo "</pre>";
              
              foreach ($countries as $key => $country) {
                $countryid = $country['country_id'];
                $countryname = $country['country_name'];

                if ($countryid == $data['country_id']) {
                  echo "<option value='$countryid' selected>$countryname</option>";
                }else{
                  echo "<option value='$countryid'>$countryname</option>";
                }
              }
            ?>
          </select>
          
        </div>
      </div>
      <input type="hidden" name="clubid" value="<?php if(isset($data['club_id'])){ echo $data['club_id']; } ?>">
      <input type="submit" class="btn btn-primary" id="btneditclub" name="btneditclub" value="Update Club">
    </form>
  </div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->

<?php include_once("portalfooter.php");?>