 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
 <?php 

 require_once('connect.php');
            
          
            $invited_user_bonus=$_POST['invited_user_bonus'];
            $id=$_POST['1'];
            $referral_bonus=$_POST['referral_bonus'];
            $os_app_id=$_POST['os_app_id'];
            $os_rest_api=$_POST['os_rest_api'];


 
 $UpdateData="UPDATE `settings` SET `invited_user_bonus`='$invited_user_bonus', `referral_bonus`='$referral_bonus',  `os_app_id`='$os_app_id', `os_rest_api`='$os_rest_api' WHERE id=1";

 $resultData=mysqli_query($conn,$UpdateData);
 if($resultData)
 {
                                       
    
    	
				
	
       echo '<script>
   
       setTimeout(function () { 
                                swal({
                                  title: "Done!",
                                  text: " Updated Successfully!",
                                  type: "success",
                                  confirmButtonText: "OK"
                                },
                                function(isConfirm){
                                  if (isConfirm) {
                                    window.location.href = "configuration.php";
                                  }
                                }); }, 1000);
   
            </script>';
            
       
            
            
    } else {
      echo '<script>
   
       setTimeout(function () { 
                    swal({
                      title: "Oops!",
                      text: "Something went wrong!",
                      type: "error",
                      confirmButtonText: "OK"
                    },
                    function(isConfirm){
                      if (isConfirm) {
                        window.location.href = "configuration.php";
                      }
                    }); }, 1000);
   
            </script>';
    }
    			
  
    						
?>

 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script> 