<?php include 'header.php' ; ?>
<?php include 'connect.php' ; ?>



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
             <h1 class="m-0">All User List</h1>
      
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
 
 
 

<div class="main_content_iner ">
<div class="container-fluid p-0">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="white_card card_height_100 mb_30">
<div class="white_card_header">
<div class="box_header m-0">

</div>
</div>
<div class="white_card_body">
<div class="QA_section">
<div class="white_box_tittle list_header" style="display: flex;">
<h4>Redeem Requests</h4>
<div class="box_right d-flex lms_block">


</div>
</div>
<div class="QA_table mb_30">

<table class="table lms_table_active ">
<thead>
<tr>
<th scope="col">Method</th>
<th scope="col">Name</th>
<th scope="col">Amount</th>
<th scope="col">Points</th>
<th scope="col">Date</th>
<th scope="col">Status</th>
<th scope="col">Track</th>


</tr>
</thead>
<tbody>

 <!-- start here  -->

 <?php
 $sql = "SELECT * FROM reward_list ORDER BY id DESC";
 $offer = mysqli_query($link, $sql);
  while($offer_row = mysqli_fetch_assoc($offer)) {
  $status = $offer_row['status'];
  $user_sql = "SELECT * FROM users WHERE id = ".$offer_row['u_id'];
  $user = mysqli_query($link, $user_sql);
  $user_row = mysqli_fetch_assoc($user);
 ?>
 <tr>
<td> <?php echo $offer_row['package_name']; ?></td>
 <th scope="row"> <a href="#" class="question_content"> <?php echo $user_row['username']; ?></a></th>
 <td> <?php echo $offer_row['symbol'].$offer_row['amount']; ?></td>
 <td> <?php echo $offer_row['coins_used']; ?></td>
 <td> <?php echo $offer_row['date']; ?></td>

 <?php
if ($status=="0") {
  echo '<td><a style="background:#ffae00;" href="#" class="btn btn-primary btn-block">Pending</a></td>';
}else if ($status=="1") {
  echo '<td><a style="background:green" href="#" class="btn btn-primary btn-block">Aprroved</a></td>';
}
else if ($status=="3")
{
    echo '<td><a style="background:green" href="#" class="btn btn-primary btn-block">Completed</a></td>';
}
else {
  echo '<td><a style="background:red" href="#" class="btn btn-primary btn-block">Rejected</a></td>';
}
  ?>

 <th scope="col">
 <div class="action_btns d-flex">
 <a style="background: red;" href="review-payment-request.php?i=<?php echo $offer_row['id']; ?>" class="action_btn mr_10 btn-primary"> <i style="    color: white!important;" class="fas fa-chart-line text-info" aria-hidden="true"></i> </a>
 </div>
 </th>
 
 
 
 
 
 </tr>
 <?php
 }
 ?>



<!-- end here  -->
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div class="col-12">
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

