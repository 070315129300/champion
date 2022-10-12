<!-- Footer -->
<footer class="py-5 header-footer-bg" >
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Champions Professionals 2021</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Member's Login Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action='login.php'>
  <div class="form-group">
    <label for="exampleInputEmail1">User ID</label>
    <input type="text" name='userid' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
     
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name='pwd' class="form-control" id="exampleInputPassword1">
  </div>
   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  <button type="submit" class="btn btn-info">Login</button>
</form>
      </div>
      
    </div>
  </div>
</div>
</body>

</html>