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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All User List</h1>
          </div><!-- /.col -->
      
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
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
    
    
               <!-- Small boxes (Stat box) -->
        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Points</th>
              <th>Total Referrals</th>
              <th>Username</th>
              <th>User Country</th>
              <th>	Current Date Time</th>
              <th>  Device Id</th>
            
              
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
                            <td><?php echo $row['total_ref']; ?></td>
                             
                             <td><?php echo $row['username']; ?></td>
                             <td><?php echo $row['UserCountry']; ?></td>
                             <td><?php echo $row['date_registered']; ?></td>
                             <td><?php echo $row['device']; ?></td>
                             
                             
                             
                             
                             
                             
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

