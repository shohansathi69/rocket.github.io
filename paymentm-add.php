<?php include 'header.php' ; ?>
<?php include 'connect.php' ; ?>



<!-- main content  -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
             <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> Add New Payment Method </h6>
                 

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">

                <form class="user" action="paymentm_add_code.php" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" autocomplete="off" class="form-control form-control-user" name="name" placeholder="Payment Method Name">
                  </div>

                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" autocomplete="off" class="form-control form-control-user" name="symbol" placeholder="Payment Method Symbol">
                  </div>

            
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" autocomplete="off" class="form-control form-control-user" name="hint" placeholder="Payment Method Hint">
                  </div>

            
                  <div class="col-sm-6 mb-3 mb-sm-0">
                 
                    <select class="form-control" name="input_type">
            <option value="text">Text</option>
            <option value="email">Email</option>
            <option value="phone">Phone Number</option>
            <option value="number">Number</option>
           </select>
                  </div>

       
       
       
                <div class="form-group row">
                 
                  <div class="col-sm-6">
                    <input type="file"  class="form-control " name="image" placeholder="">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button> 
                  
                <hr>
               
              </form>                    
                  </div>
                </div>
              </div>
            </div>  
        <!-- /.container-fluid -->
</div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
         <?php include 'footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->



  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
    <script src="post_script.js"></script>


</body>

</php>


