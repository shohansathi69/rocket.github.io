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
    
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
 
 


<div class="main_content_iner ">
<div class="container-fluid p-0">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="white_card card_height_100 mb_30">

<div class="white_card_body">
<div class="QA_section">
<div class="white_box_tittle list_header" style=" display: flex; margin-top: 16px; align-items: center; justify-content: space-between;">
<h4>Payment Method</h4>
<div class="box_right d-flex lms_block">
<div class="add_button ml-10">
 

<a class="btn-success btn btn-block" type="button" href="paymentm-add.php"><i class="fas fa-plus" aria-hidden="true"></i> Add New Payment Method </a>
<div class="col-lg-6 text-right">
              <a class="btn-dark btn" onclick="history.back()"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back To Dashboard</a>
            </div>

</div>
</div>
</div>
<div class="QA_table mb_30">

<table class="table lms_table_active ">
<thead>
<tr>
<th scope="col">Image</th>
<th scope="col">Name</th>
<th scope="col">Amount</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>

 <!-- start here  -->


 <?php
 $sql = "SELECT * FROM reward";
 $offer = mysqli_query($link, $sql);
  while($offer_row = mysqli_fetch_assoc($offer)) {
   

 ?>
 <tr>
 <th scope="row"><img src="<?php echo $offer_row['image']; ?>" alt="" style="width: 80px;"></th>
 <td> <?php echo $offer_row['name']; ?></td>

 <td style="font-weight: bold;"> <?php echo $offer_row['coins']." Coins = ".$offer_row['symbol'].$offer_row['amount'] ?> </td>

 <th scope="col">
 <div class="action_btns d-flex">
     
     <a href="paymentm-list.php?i=<?php echo $offer_row['id']; ?>" class="btn btn-primary btn-block mr_10"> <i class="fa-solid fa-list-ol"></i> </a>



 <form action="admin_data_api.php" method="post">
   <input type="hidden" name="clm_name" value="reward">
   <input type="hidden" name="r_id" value="<?php echo $offer_row['id']; ?>">
   <input type="hidden" name="url" value="paymentm.php">
   <input type="hidden" name="delt">
 <button style="border: none;" type="submit" class="btn btn-primary btn-block"> <i class="fas fa-trash"></i> </button>
 </form>
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

