<!-- Page Content -->
<div class="container">

<!-- Page Heading/Breadcrumbs -->
<h1 class="mt-4 mb-3">IT Professionals App
  <small>Signup</small>
</h1>

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="index.html">Home</a>
  </li>
  <li class="breadcrumb-item active">Sign up Form</li>
</ol>


<div class="row">
  <div class="col-lg-8 mb-4">

    <form name="registerform" id="registerform" action='' method="post">
      <div class="control-group form-group">
        <div class="controls">
          <label>First Name:</label>
          <input type="text" class="form-control" id="name" name='fname'>
          
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label>Last Name:</label>
          <input type="text" class="form-control" id="name" name='lname'>
         
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label>Phone Number:</label>
          <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label>Email Address:</label>
          <input type="email" class="form-control" name='email' id="email" required>
           <p class="help-block text-muted">We promise never to spam you!</p>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label>Date of Birth:</label>
          <input type="date" class="form-control" id="dob" name='dob'>
         
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label>Profile (short):</label>
          <textarea rows="5" cols="50" name='profile' class="form-control" id="profile"  maxlength="300" style="resize:none"></textarea>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label>Password:</label>
          <input type="password" class="form-control" id="password" name='password'>
         
        </div>
      </div>
       
      
      <input type="submit" class="btn btn-primary" id="sendMessageButton" value="Sign Up">
    </form>
  </div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->