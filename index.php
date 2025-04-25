<?php include 'header.php' ; ?>
<?php include 'connect.php' ; ?>

 
 <?php
 $sql = "SELECT * FROM users";
 $result = mysqli_query($link, $sql);
 if (mysqli_num_rows($result) > 0) {
   $total_users = mysqli_num_rows($result);

   if ($total_users>1000) {
     $total_users = $total_users/1000;
     $total_users = round($total_users,1)."K";
   }
   $total_coins = 0;
   $n = 0;
  while($row = mysqli_fetch_assoc($result)) {
  $total_coins = $row['points']+$total_coins;
  $n = $row['points']+$n;
  }

  if ($n < 10000) {
      // Anything less than a million
        $n_format = number_format($n);
  }
else  if ($n < 1000000) {
    // Anything less than a million
      $n_format = number_format($n / 1000, 0) . 'K';
} else if ($n < 1000000000) {
    // Anything less than a billion
    $n_format = number_format($n / 1000000, 1) . 'M';
} else {
    // At least a billion
    $n_format = number_format($n / 1000000000, 1) . 'B';
}


} else {
  $total_users = 0;
}


if ($total_users < 10000) {
    // Anything less than a million
      $n_u = number_format($total_users);
}
else  if ($total_users < 1000000) {
  // Anything less than a million
    $n_u = number_format($total_users / 1000, 0) . 'K';
} else if ($total_users < 1000000000) {
  // Anything less than a billion
  $n_u = number_format($total_users / 1000000, 1) . 'M';
} else {
  // At least a billion
  $n_u = number_format($total_users / 1000000000, 1) . 'B';
}

$reward_sql = "SELECT * FROM reward_list WHERE status='0'";
$re_result = mysqli_query($link, $reward_sql);

if (mysqli_num_rows($re_result) > 0) {
  $total_payments = mysqli_num_rows($re_result);
}
?>


    <!-- Main content -->
   
   
   <?php
$d = date('Y-m-d');
$sql = "SELECT DISTINCT `username` FROM tracker WHERE `date` = '$d'";
$result = mysqli_query($link, $sql);
$user_today = mysqli_num_rows($result);
 ?>

 <?php
 $d = date('Y-m-d');
 $sql = "SELECT * FROM tracker WHERE `date` = '$d'";
 $result = mysqli_query($link, $sql);
 $activity_today = mysqli_num_rows($result);
$today_e = 0;
 while($r=mysqli_fetch_assoc($result)){
     $today_e=$r['points']+$today_e;
}

if ($today_e < 10000) {
    // Anything less than a million
      $t_er = number_format($today_e);
}
else  if ($today_e < 1000000) {
  // Anything less than a million
    $t_er = number_format($today_e / 1000, 0) . 'K';
} else if ($today_e < 1000000000) {
  // Anything less than a billion
  $t_er = number_format($today_e / 1000000, 1) . 'M';
} else {
  // At least a billion
  $t_er = number_format($today_e / 1000000000, 1) . 'B';
}
    /*$check_device = "SELECT * FROM license";
	$send_dev = mysqli_query($link,$check_device);
	$get = mysqli_fetch_assoc($send_dev);
	if($send_dev && !$get['package_name']==0 &&!$get['license']==0)
	{
	   $data =$a->v(false,$get['c'],$get['u']);  
	   if(!$data['status'])
	   {$refer_point = "UPDATE `license` SET `i`= '0'";header('Location: key.php');}else{$refer_point = "UPDATE `license` SET `i`= '1'";}
	    $db = mysqli_query($link,$refer_point);
	}else{//header('Location: key.php');
	}*/




       if ($activity_today < 10000) {
           // Anything less than a million
             $a_t = number_format($activity_today);
       }
       else  if ($activity_today < 1000000) {
         // Anything less than a million
           $a_t = number_format($activity_today / 1000, 0) . 'K';
       } else if ($activity_today < 1000000000) {
         // Anything less than a billion
         $a_t = number_format($activity_today / 1000000, 1) . 'M';
       } else {
         // At least a billion
         $a_t = number_format($activity_today / 1000000000, 1) . 'B';
       }
       
       $reward_sql = "SELECT * FROM reward_list WHERE status='0'";
       $re_result = mysqli_query($link, $reward_sql);
       
       if (mysqli_num_rows($re_result) > 0) {
         $total_payments = mysqli_num_rows($re_result);
       }

       $reward_sql = "SELECT * FROM `reward_list` WHERE `date`='$d'";
       $re_result = mysqli_query($link, $reward_sql);
       $coins = 0;
       while($r=mysqli_fetch_assoc($re_result)){
     	    $coins = $pre=$r['coins_used']+$coins;
}

if ($coins < 10000) {
    // Anything less than a million
      $c_f = number_format($coins);
}
else  if ($coins < 1000000) {
  // Anything less than a million
    $c_f = number_format($coins / 1000, 0) . 'K';
} else if ($coins < 1000000000) {
  // Anything less than a billion
  $c_f = number_format($coins / 1000000, 1) . 'M';
} else {
  // At least a billion
  $c_f = number_format($coins / 1000000000, 1) . 'B';
}




  ?>
   
   
    <div class="container-fluid py-4">
      <div class="row">
          
          
        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">payments</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Notification</p>
                
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='user_notification.php'">View All</button>
           </div>
          </div>
        </div>
          
          
        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">payments</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Users</p>
                <h4 class="mb-0"><?php echo $n_u; ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='userlist.php'">View All</button>
           </div>
          </div>
        </div>


        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Available Point</p>
                <h4 class="mb-0"><?php echo $n_format; ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='userlist.php'">View All</button>
           </div>
          </div>
        </div>
        
        
        
        
         <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Pending Payment</p>
                <h4 class="mb-0"><?php echo $total_payments; ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='redeems.php'">View All</button>
           </div>
          </div>
        </div>
        
        
        
        
 

        
         <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today Users</p>
                <h4 class="mb-0"> <?php echo $user_today; ?> </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='userlist.php'">View All</button>
           </div>
          </div>
        </div>
        
        
        
         <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today User App Opend</p>
                <h4 class="mb-0"> <?php echo $a_t; ?> </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='userlist.php'">View All</button>
           </div>
          </div>
        </div>

        
        
        
         <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today User Earn</p>
                <h4 class="mb-0"> <?php echo $t_er; ?>  </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='userlist.php'">View All</button>
           </div>
          </div>
        </div>

                
         <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today Redeem</p>
                <h4 class="mb-0"> <?php echo $c_f; ?>   </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='redeems.php'">View All</button>
           </div>
          </div>
        </div>

        

        
        


        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
   <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">App Setting</p>
        
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='someconfig/admin/app-settings.php'">View All</button>
            </div>
          </div>
        </div>

        
        


        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
   <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Configuration</p>
        
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='configuration.php'">View All</button>
            </div>
          </div>
        </div>

      

        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
   <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Change Password</p>
        
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='change_password.php'">View All</button>
            </div>
          </div>
        </div>
      
        


        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
   <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Payment Method</p>
        
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='paymentm.php'">View All</button>
            </div>
          </div>
        </div>




        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize"> Home Slider Settings </p>
 
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                      <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='someconfig/admin/home-slider.php'">View All</button>
            </div>
          </div>
        </div>


        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize"> Video Ads Settings </p>
 
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                      <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='someconfig/admin/video-reward-ads.php'">View All</button>
            </div>
          </div>
        </div>

        
        <div style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize"> Scratch To Win Settings</p>
 
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                      <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='someconfig/admin/scratch-win.php'">View All</button>
            </div>
          </div>
        </div>

        
       
        <div  style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Video Ads For All Activity</p>
 
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                      <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='someconfig/admin/ads-for-all-activity.php'">View All</button>
            </div>
          </div>
        </div>

 
  
         
        <div  style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize"> Interstitial Ads For All Activity</p>
 
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
             <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='someconfig/admin/all-activity-interstitial-ads.php'">View All</button>
            </div>
          </div>
        </div>

    
           
        <div  style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize"> Ads Id Control</p>
 
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                      <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='someconfig/admin/adsid-control.php'">View All</button>
            </div>
          </div>
        </div>


 

 
            
        <div  style="margin-bottom: 29px !important;" class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">settings</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize"> Fraud & Prevention </p>
 
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                      <button class="btn btn-primary btn-sm" style="margin-top:10px;" onclick="document.location='someconfig/admin/fraud_prevention.php'">View All</button>
            </div>
          </div>
        </div>

 
 
  
  
  
   
      <div class="row mb-4">
        <div style="width: 100%; margin-right: 10px;" class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Total Users</h6>
                
                </div>
              
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
             
             
               <!-- Small boxes (Stat box) -->
        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Points</th>
              <th>Status</th>
              <th>Edit</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php  $sql = "SELECT * FROM users";
                  $res=mysqli_query($conn,$sql);
                  $i=1;
                  while($row=mysqli_fetch_array($res)){ ?>
                       <tr>
                         <td><?php echo $i; ?></td>
                          <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                             <td><?php echo $row['points']; ?></td>
                             
                             
                             
 <form action="admin_data_api.php" method="post" id="myform">
      <input type='hidden' name='user_b' value='<?php echo $row['id']; ?>'>
     
  <?php if ($row['status']=="0") {
      $id =$row['id'];
    echo "
    <input type='hidden' name='status' value='1'>
    <td><Button type='submit' class='btn btn-primary btn-block'>Active</Button></td>";
  }else {
      echo "
    <input type='hidden' name='status' value='0'>
    <td><Button type='submit' style='background: red;' class='btn btn-primary btn-block'>Blocked</Button></td>";
    
  } ?>
  
   </form>

       

   


  <th scope="col">
  <div class="action_btns d-flex">
  <a href="user-profile.php?i=<?php echo $row['username']; ?>" class="btn btn-primary btn-block"> <i class="far fa-edit"></i> </a>
  <a href="user-track.php?i=<?php echo $row['username']; ?>" class="btn btn-primary btn-block "><i style="    color: white!important;" class="fas fa-chart-line text-info" aria-hidden="true"></i> </a>
  <!--<a href="#" class="action_btn mr_10"> <i class="fa-solid fa-ban"></i> </a>-->
 <!-- <a href="#" class="action_btn"> <i class="fas fa-trash"></i> </a>-->
  </div>
  </th>
  
  
  
                            <td>
                          
                              <a href="deldata.php?del=user&id=<?php echo $row['id']; ?>">
                                <button class="btn btn-danger sml">Delete</button></a>

                            </td>
   
                            
                            
                       </tr>






 




              <?php $i=$i+1; }
             ?>
          </tbody>
        </table>
             
              </div>
            </div>
          </div>
        </div>
         


      
      </div>
 
 


 
   
   
  
<?php include 'footer.php' ; ?>