<?php include 'header.php' ; ?>
<?php include 'connect.php' ; ?>




<?php
if (isset($_GET['i']))
{
  $id = $_GET['i'];
  
  

  $sql = "SELECT * FROM reward_list WHERE id =".$id;
  $result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $user_sql = "SELECT * FROM users WHERE id = ".$row['u_id'];
  $user = mysqli_query($link, $user_sql);
  $user_row = mysqli_fetch_assoc($user);

  $user_r = "SELECT * FROM reward_list WHERE u_id = ".$row['u_id'];
  $user_r = mysqli_query($link, $user_r);
  $total_r = mysqli_num_rows($user_r);
 } else {
   header("Location: /");
 }

}else {
   header("Location: /");
}
 ?>




<style type="text/css">
  img.im {
    width: 22%;
}
.bt{
  margin-bottom: 16px;
}
  .container-fluid{
      margin-right: 30px;
    margin-left: 30px;
    width: fit-content!important;
  
  }
  .card{
border-radius: 20px!important}
  .content-wrapper{
  min-height: 433px;
    background: white;
    text-align: left;
    margin-left: 0px!important;
  }
  body{
      background: #f1f4f8;
  }
  .next{
  position: relative;
    color: white;
    text-decoration: none;
    background-color: #6610f2;
    border: 1px solid #dddfeb;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 81px;
    padding: 9px;
    border-radius: 10px;
   margin-left: 33px;
     padding-left: 48px!important;
    padding-right: 48px!important;
  }
  .paginate_button {
        padding: 10px;
    margin: 5px;
    border-radius: 6px;
    position: relative;
    text-decoration: none;
    border: 1px solid #dddfeb;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    z-index: 3;
    border-color: #4e73df;
  }
  .previous{
        margin-right: 21px;
    position: relative;
    color: white;
    text-decoration: none;
    background-color: #6610f2;
    border: 1px solid #dddfeb;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 81px;
    padding: 9px;
    border-radius: 10px;
    padding-right: 21px;
  }
  
</style>
 


<div class="container-fluid">
            
                <div class="card shadow">
                     
                    	
                    <div class="card-body">
                        
                     


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
             <h1 class="m-0">Review Payment Request</h1>
      
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
 
 
 
 
   <form action="admin_data_api.php" method="post" id="myform">
      <input type='hidden' name='user_b' value='<?php echo $user_row['id']; ?>'>
      <input type='hidden' name='r' value='<?php echo $user_row['id']; ?>'>
     
  <?php if ($user_row['status']=="0") {
      $id =$user_row['id'];
    echo "
    <input type='hidden' name='status' value='1'>
    <Button type='submit' style='background: red;border: none;' class='btn btn-success gg btn btn-primary btn-block'> Block User</Button>";
  }else {
      echo "
    <input type='hidden' name='status' value='0'>
    <Button type='submit' class='btn btn-success btn btn-primary btn-block'> Unblock</Button>";
    
  } ?>
  
   </form>
  

<?php
if(!$row['status']=="3"){ 
    $id = $row['id'];
    $user = $user_row['username'];
echo "
<div style='text-align: center;display: flex;gap: 4px;' >
<form action='admin_data_api.php' method='post'>
  <input type='hidden' name='view_id' value='$id'>
  <input type='hidden' name='view_action' value='1'>

<button type='submit' class='btn btn-success mb-3'><i class='fa-solid fa-check'></i> Approve</button>
</form>

<form action='admin_data_api.php' method='post'>
  <input type='hidden' name='view_id' value='$id'>
  <input type='hidden' name='view_action' value='2'>

<button type='submit' class='btn btn-danger mb-3'><i class='fa-solid fa-xmark'></i> Reject</button>
</form>
<form>
<a href='tracker.php?i=$user' class='btn btn-secondary mb-3'><i class='fa-solid fa-eye'></i> Track</a>
</form>
</div>
";}else if($row['status']=="1")
{
    $idd = $row['id'];
    echo "<form action='admin_data_api.php' method='post'>
  <input type='hidden' name='view_id' value='$idd'>
  <input type='hidden' name='view_action' value='3'>

<button type='submit' class='btn btn-success mb-3'><i class='fa-solid fa-check'></i> Complete now</button>
</form>";
}
?>


<div class="main_content_iner ">
<div class="container-fluid p-0">
<div class="row justify-content-center">

  <div class="col-xl-12">
  <div class="white_card card_height_100 mb_30">
  <div class="white_card_header">
  <div class="box_header m-0">
  <div class="main-title">
 
  </div>
  </div>
  </div>
  <div class="white_card_body">
  <div class="Activity_timeline">
  <ul>
  <li>
  <div class="activity_bell"></div>
  <div class="timeLine_inner d-flex align-items-center">
  <div class="activity_wrap" style="display: flex; flex-direction: row;">
  <h6>Username:&nbsp;&nbsp;</h6>
  <h6><?php echo $user_row['username']; ?></h6>
  </div>
  </div>
  </li>

  <li>
  <div class="activity_bell"></div>
  <div class="timeLine_inner d-flex align-items-center">
  <div class="activity_wrap" style="display: flex; flex-direction: row;">
  <h6>Points Used:&nbsp;&nbsp;</h6>
  <h6><?php echo $row['coins_used']; ?></h6>
  </div>
  </div>
  </li>

  <li>
  <div class="activity_bell"></div>
  <div class="timeLine_inner d-flex align-items-center">
  <div class="activity_wrap" style="display: flex; flex-direction: row;">
  <h6>Amount:&nbsp;&nbsp;</h6>
  <h6><?php echo $row['symbol'].$row['amount']; ?></h6>
  </div>
  </div>
  </li>

  <li>
  <div class="activity_bell"></div>
  <div class="timeLine_inner d-flex align-items-center">
  <div class="activity_wrap" style="display: flex; flex-direction: row;">
  <h6>Payment Address:&nbsp;&nbsp;</h6>
  <h6><?php echo $row['p_details']; ?></h6>
  </div>
  </div>
  </li>

  <li>
  <div class="activity_bell"></div>
  <div class="timeLine_inner d-flex align-items-center">
  <div class="activity_wrap" style="display: flex; flex-direction: row;">
  <h6>Payment Method:&nbsp;&nbsp;</h6>
  <h6><?php echo $row['package_name']; ?></h6>
  </div>
  </div>
  </li>

  <li>
  <div class="activity_bell"></div>
  <div class="timeLine_inner d-flex align-items-center">
  <div class="activity_wrap" style="display: flex; flex-direction: row;">
  <h6>Date:&nbsp;&nbsp;</h6>
  <h6><?php echo $row['date']; ?></h6>
  </div>
  </div>
  </li>

  <li>
  <div class="activity_bell"></div>
  <div class="timeLine_inner d-flex align-items-center">
  <div class="activity_wrap" style="display: flex; flex-direction: row;">
  <h6>Total Redeem:&nbsp;&nbsp;</h6>
  <h6><?php echo $total_r; ?></h6>
  </div>
  </div>
  </li>

  <li>
  <div class="activity_bell"></div>
  <div class="timeLine_inner d-flex align-items-center">
  <div class="activity_wrap" style="display: flex; flex-direction: row;">
  <h6>Status:&nbsp;&nbsp;</h6>
  <?php if ($row['status']=="0") {
    echo '<a href="#" class="badge_active3" style="background:#ffae00;color:white;">Pending</a>';
  }elseif ($row['status']=="1") {
    echo '<a href="#"  class="badge_active" >Approved</a>';
  }
  elseif ($row['status']=="3") {
    echo '<a href="#"  class="badge_active" >Completed</a>';
  }
  else {
      echo '<a href="#"  class="badge_active3" >Rejected</a>';
  } ?>




  </div>
  </div>
  </li>
  
  
  
    <li>
  <div class="activity_bell"></div>
  <div class="timeLine_inner d-flex align-items-center">
  <div class="activity_wrap" style="display: flex; flex-direction: row;">
  <h6><?php echo $user_row['username']; ?>:&nbsp;&nbsp;</h6>
  

   
  </div>
  </div>
  </li>
  
  <style>
      .gg{
          margin-top: 1px;
    line-height: 13px;
    font-size: 12px;
    text-transform: uppercase;
      }
  </style>

  </ul>

<br>
<br>



  </div>
  </div>
  </div>
  </div>

</div>
</div>
</div>

 

    
        
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->









                         </div>
                    </div>
                
            </div>

 
      
 <?php include 'footer.php' ; ?>

