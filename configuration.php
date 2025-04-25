<?php include 'header.php';
include 'connect.php';

?>
         <div class="container-fluid">
             <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Configuration</h6>
                 

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                     <?php 
                                
                                         
                                          $SelectCarData="Select * from `settings` WHERE `id`=1";
                                          $result = mysqli_query($conn,$SelectCarData);
                                                    while($row = mysqli_fetch_assoc($result)) 
                                                    
                                                    { 
                                                    
                                                             
                                                             
                                                             $invited_user_bonus=$row["invited_user_bonus"];
                                                             $referral_bonus=$row["referral_bonus"];
                                                             $os_app_id=$row["os_app_id"];
                                                          $os_rest_api=$row["os_rest_api"];

                        

                                                    }
                                                    
                                                    
                                                    
                                                    $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);




                                                     ?>
<!-- ============================================================================================================================== -->
                <form class="user" method="post" action="update_setting_code.php">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
       
                                      <label class="form-control-label" for="input-first-name">User Invited User Point</label>
                    <input type="text" class="form-control form-control-user" value="<?php echo($invited_user_bonus) ?>" name="invited_user_bonus" id="invited_user_bonus" placeholder="<?php echo($invited_user_bonus) ?>">
                  </div>
                </div>
                     <hr>
                
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                                      <label class="form-control-label" for="input-first-name">User Referral Point</label>
                    <input type="text" class="form-control form-control-user" value="<?php echo($referral_bonus) ?>" name="referral_bonus" id="referral_bonus" placeholder="<?php echo($referral_bonus) ?>">
                  </div>
                </div>
                     <hr>
                
               
                               
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                        <label class="form-control-label" for="input-first-name">OneSignal App ID</label>
                    <input type="text" class="form-control form-control-user" value="<?php echo($os_app_id) ?>" name="os_app_id" id="os_app_id" placeholder="<?php echo($os_app_id) ?>">
                  </div>
                </div>
                     <hr>
                
               
                               
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                        <label class="form-control-label" for="input-first-name">OneSignal Rest API</label>
                    <input type="text" class="form-control form-control-user" value="<?php echo($os_rest_api) ?>" name="os_rest_api" id="os_rest_api" placeholder="<?php echo($os_rest_api) ?>">
                  </div>
                </div>
                     <hr>
                
      
                
                
                  <hr>
                                <button style="width: 300px;" type="submit" class="btn btn-primary form-control-user btn-user btn-block ">Submit</button> 

                <hr>
               
              </form>          
              
                
    <div class="row">
      <div class="col-lg-12">
        <div class="common_input mb_15">
          <label class="form-control-label" for="input-first-name">Ayet Studio Postback url</label>
          <input style="background: #f5f6ff;" type="text" name="adg" class="form-control" placeholder="AdGetMedia Wall Code" value="<?php echo $base_url; ?>postbackworkss/ayet.php?network=ayetstudios&amount={currency_amount}&uid={uid}&device={advertising_id}&payout_usd={payout_usd}" disabled>
            <input type="hidden" name="settings_wall">
        </div>
      </div>
    </div>

      <div class="row">
      <div class="col-lg-12">
        <div class="common_input mb_15">
          <label class="form-control-label" for="input-first-name">AdGetMedia Postback url</label>
          <input style="background: #f5f6ff;" type="text" name="ot_k" class="form-control" placeholder="OfferToro Key" value="<?php echo $base_url; ?>postbackworkss/adg.php?conversion_id={conversion_id}&user_id={s1}&point_value={points}&usd_value={payout}&offer_title={vc_title}" disabled>
        </div>
      </div>
    </div>


              
     
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

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</php>
