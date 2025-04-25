<?php include 'header.php' ; ?>
<?php include 'connect.php' ; ?>

<?php
if (isset($_GET['i']))
{
  $id = $_GET['i'];

  $sql = "SELECT * FROM users WHERE username = '$id'";
  $result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
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
  
    <!-- /.content-header -->

    <!-- Main content -->
   
      <div class="container-fluid">
       <!--  <button type="button" class="btn btn-primary bt" data-toggle="modal" data-target="#exampleModal">
  Add New Image
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="add_all_img.php" method="post" enctype="multipart/form-data">
         <div class="inp">
           <input type="hidden" name="type" value="product">
           <input type="text" name="name" placeholder="product name">
           <input type="file" name="img" >
         </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
         </form>
      </div>
    </div>
  </div>
</div> -->
    
   
   
<section style="    padding-left: 0!important;" class="action-box row mb-2">

 

<div class="main_content_iner ">
<div class="container-fluid p-0">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="white_card card_height_100 mb_30">
<div class="white_card_header" style="margin-bottom: -40px;">
<div class="box_header m-0">
<div class="main-title">
<h3 class="m-0">User Activity</h3>
</div>
</div>
</div>
<div class="white_card_body">
<div class="QA_section">
<div class="white_box_tittle list_header">

<div class="box_right d-flex lms_block">

<div class="add_button ml-10">
    
</div>
</div>
</div>
<div class="QA_table mb_30">

<table class="table lms_table_active ">
<thead>
<tr>
<th scope="col">Name</th>
<th scope="col">Points</th>
<th scope="col">Earned From</th>
<th scope="col">Date</th>
<th scope="col">Time</th>
</tr>
</thead>
<tbody>

 <!-- start here  -->


 <?php
 if (isset($_GET['i'])) {
   $u = $_GET['i'];
 $sql = "SELECT * FROM tracker WHERE username = '$u' ORDER BY id DESC";
 $result = mysqli_query($link, $sql);
 if ($result) {
   
 }else {
     echo mysqli_error($link);
 }
 while($row = mysqli_fetch_assoc($result)) {
  ?>
  <tr>
  <th scope="row"> <a href="#" class="question_content"> <?php echo $row['username']; ?></a></th>
  <td> <?php echo $row['points']; ?></td>
  <td> <?php echo $row['type']; ?></td>
  <td> <?php echo $row['date']; ?></td>
<td> <?php echo $row['time']; ?></td>

  </tr>
<?php
}
}else {
  header("Location: redeem.php");
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


</section>
   
    
    
    
    
        
        
      </div><!-- /.container-fluid -->
 
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

