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
  
  div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em;
    display: inline-block;
    width: auto;
    background: burlywood;
}
  
</style>
 


<div class="container-fluid">
            
                <div class="card shadow">
                     
                    	
                    <div class="card-body">
                        
                     


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
 

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
 
 
 


<div class="main_content_iner " style="min-height:0;margin-bottom: 0px;">
  <div class="card">
    <div class="card-header">
      <div class="row align-items-center">
        <div class="col-8">
          <h3 class="mb-0">Add Payment Method Amount</h3>
        </div>
        <div class="col-4 text-right">
          <button type="submit" form="myform" class="btn-success btn btn-block btn btn-sm btn-primary" > Add Add New Payment Amount  </button></div>
      </div>
    </div>
    <div class="card-body">
      <form action="admin_data_api.php" method="post" id="myform" enctype="multipart/form-data">

        <h6 class="heading-small text-muted mb-4">Payment information</h6>
        <div class="pl-lg-4">
          <div class="row">

            <div class="col-lg-12">
              <div class="common_input mb_15">
                <label class="form-control-label" for="input-email">Point</label>
                <input style="background: lavender;" type="number" name="coins" class="form-control" placeholder="Set Point for Amount" value="">
              </div>
            </div>



             <div class="col-lg-12">
              <div class="common_input mb_15">
                <label class="form-control-label" for="input-email">Payment Amount</label>
                <input style="background: lavender;" type="number" name="amount" class="form-control" placeholder="Sample Amount 100" value="">
                <input style="background: lavender;" type="hidden" name="r_item" value="<?php echo $_GET['i']; ?>">
              </div>
            </div>

          </div>

        </div>

      </form>
    </div>
  </div>
</div>

<!--redeem item list-->

<div class="main_content_iner ">
<div class="container-fluid p-0">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="white_card card_height_100 mb_30">

<div class="white_card_body">
<div class="QA_section">

<div class="QA_table mb_30">

<table class="table lms_table_active ">
<thead>
<tr>

<th scope="col">#</th>
<th scope="col">Coin</th>
<th scope="col">Amount</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>

 <!-- start here  -->


 <?php
 if(!isset($_GET['i']))
 {
    header('Location: index.php');
    exit;
 }
 $id = $_GET['i'];
 $sql = "SELECT * FROM reward_amounts WHERE r_id = '$id'";
 $offer = mysqli_query($link, $sql);
  while($offer_row = mysqli_fetch_assoc($offer)) {
      $count++;
      
 ?>
 <tr>
 <td> <?php echo "".$count; ?></td>
 
  <td>  <?php echo $offer_row['coins']; ?></td>

 <td style="font-weight: bold;"><?php echo $offer_row['amount']; ?></td>

 <th scope="col">
 <div class="action_btns d-flex">

 <a href="edit-redeem-item.php?i=<?php echo $offer_row['id']; ?>" class="action_btn mr_10"> <i class="far fa-edit"></i></a>

 <form action="admin_data_api.php" method="post">
   <input type="hidden" name="clm_name" value="reward_amounts">
   <input type="hidden" name="r_id" value="<?php echo $offer_row['id']; ?>">
   <input type="hidden" name="url" value="redeem.php">
   <input type="hidden" name="delt">
 <button style="border: none;" type="submit" class="action_btn"> <i class="fas fa-trash"></i> </button>
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

